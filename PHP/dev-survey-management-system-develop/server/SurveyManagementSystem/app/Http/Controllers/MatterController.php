<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matter;
use App\Models\Advertising;
use App\Models\Matter_statuse;
use App\Models\Matter_agreement;
use App\Models\Matter_bill_issue;
use App\Models\Matter_certification;
use App\Models\Matter_drawing;
use App\Models\Matter_insurance_policie;
use App\Models\Matter_quotation;
use App\Models\Matter_report;
use App\Models\User;
use App\Models\Surveie;
use App\Models\Trader;
use App\Models\Reward;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as XlsxWriter;
use App\Mail\MailSend;
use Carbon\Carbon;

class MatterController extends Controller
{
    //全件表示・100件単位
    public function all() {
        $method = new Matter;
        //ログインIDと権限をsessionに保存
        $method->auth();

        //法人顧客カラム
        $matters = $method->column();

        $status_name = Matter_statuse::all();

        //調査日を過ぎてステータスが変更されてないものを黄色にする
        $dt_now = new Carbon(date('Y-m-d'));
        foreach (Matter::cursor() as $matter){
            if($matter->matter_status_add){
                if($matter->caution == '▲'){
                    $matter->caution = '△';
                    $matter->save();
                }
                if($matter->survey_date){
                    $dt_status_log = new Carbon($matter->matter_status_add);
                    $comparison_now = $dt_now->gt($matter->survey_date);
                    $middle_log = $dt_status_log->between($matter->submit_date, $matter->survey_date);
                    if($matter->caution == '△' && $middle_log == true && $comparison_now == true){
                        $matter->caution = '▲';
                        $matter->save();
                    }
                }
            }else{
                $elapsed_now = $dt_now->diffInDays($matter->submit_date);
                if($matter->caution == '△' && $elapsed_now >= 5){
                    $matter->caution = '▲';
                    $matter->save();
                }
            }
        }

        $authoritys = session()->get('authoritys');
        $user_login = session()->get('user_login');

        foreach($authoritys as $authorities){
            if($authorities == "リグラント営業"){
                $search_sales = User::where('login', $user_login)->select('username')->first();
                $matters = $matters->where('matters.sales_staff','LIKE','%'.$search_sales['username'].'%');

                //jsonに変えて暗号化
                $matter_data = json_encode($matters->get(), JSON_UNESCAPED_UNICODE);
                $matter_data = Crypt::encryptString($matter_data);

                $matters = $matters->orderBy('matters.id','ASC')->paginate(100);
                
                return view('matter/matter_all',['matters' => $matters, 'status_name' => $status_name, 'matter_data' => $matter_data]);
            }elseif($authorities == "調査会社"){
                $search = User::where('login', $user_login)->select('survey_id')->first();
                $matters = $matters->where('surveies.id',$search['survey_id']);

                //jsonに変えて暗号化
                $matter_data = json_encode($matters->get(), JSON_UNESCAPED_UNICODE);
                $matter_data = Crypt::encryptString($matter_data);

                $matters = $matters->orderBy('matters.id','ASC')->paginate(100);
                
                return view('matter/matter_all',['matters' => $matters, 'status_name' => $status_name, 'matter_data' => $matter_data]);
            }elseif($authorities == "全画面"){
                $matters = $method->column();

                //jsonに変えて暗号化
                $matter_data = json_encode($matters->get(), JSON_UNESCAPED_UNICODE);
                $matter_data = Crypt::encryptString($matter_data);

                $matters = $matters->orderBy('id', 'asc')->paginate(100);
                
                return view('matter/matter_all',['matters' => $matters, 'status_name' => $status_name, 'matter_data' => $matter_data]);
            }
        }
        return view('front_admin');
    }

    //詳細表示
    public function detail(Request $request) {
        
        $method = new Matter;

        //ログインIDと権限をsessionに保存
        $method->auth();

        //法人顧客カラム
        $matters = $method->column()->find($request->id);

        unset($matters['_token']);

        $status_name = Matter_statuse::all();
        $traders = Trader::select('id','trader_name')->get();

        return view('matter/matter_detail',['matters' => $matters,'statuses' => $status_name,'traders' => $traders]);
    }

    //案件登録画面
    public function create(Request $request) {

        $method = new Matter;

        //ログインIDと権限をsessionに保存
        $method->auth();

        $advertisings = Advertising::all();
        $matter_statuse = Matter_statuse::all();
        $trader = Trader::all();
        $surveie = Surveie::all();

        return view('matter/matter_create',['advertisings'=>$advertisings, 'matter_statuse'=>$matter_statuse, 'trader'=>$trader,'surveie'=>$surveie]);
    }

    //案件登録チェック
    public function create_check(Request $request) {

        $method = new Matter;

        //新規登録バリデーション
        $method->create_validation($request);

        $matters = $request->all();

        $advertising_id = Advertising::where('advertising_name', $matters['advertising_name'])->select('id')->first();

        if($matters['survey_name'] == ''){
            $survey_id = ['id' => 1];
        }else{
            $survey_id = Surveie::where('survey_name', $matters['survey_name'])->select('id')->first();
        };

        if($matters['status_name'] == ''){
            $matter_statuse_id = Matter_statuse::find(1);
        }else{
            $matter_statuse_id = Matter_statuse::where('status_name', $matters['status_name'])->first();
        };

        $trader = Trader::find($matters['trader_name']);
        $trader_id = $trader['id'];
        $trader_name = $trader['trader_name'];
        $agency_store_2 = Trader::find($trader['introducer']);
        $agency_store_2_id = $agency_store_2['id'];
        $agency_store_2_name = $agency_store_2['trader_name'];
        $agency_store_3 = Trader::find($agency_store_2['introducer']);
        $agency_store_3_id = $agency_store_3['id'];
        $agency_store_3_name = $agency_store_3['trader_name'];

        //入金額の計算
        $payment_money = (int)$matters['certification_money'] * (int)$matters['fee'] / 100;
        $payment_money = floor($payment_money);

        if((int)$matters['quotation_money'] == 0){
            $certification_money_probability = 0;
        }else{
            //見積額の認定率
            $certification_money_probability = (int)$matters['certification_money'] / (int)$matters['quotation_money'] * 100;
            $certification_money_probability = (int)floor($certification_money_probability);
        }

        //紹介率合計の計算
        $referral_rate_total = (int)$matters['referral_rate'] + (int)$matters['referral_rate_2'] + (int)$matters['referral_rate_3'];

        //取次店支払額
        $trader_payment_money = $payment_money * $referral_rate_total / 100;
        $trader_payment_money = (int)floor($trader_payment_money);

        //取次店支払額 1
        $trader_payment_money_1 = $payment_money * (int)$matters['referral_rate'] / 100;
        $trader_payment_money_1 = (int)floor($trader_payment_money_1);

        //取次店支払額 2
        $trader_payment_money_2 = $payment_money * (int)$matters['referral_rate_2'] / 100;
        $trader_payment_money_2 = (int)floor($trader_payment_money_2);

        //取次店支払額 3
        $trader_payment_money_3 = $payment_money * (int)$matters['referral_rate_3'] / 100;
        $trader_payment_money_3 = (int)floor($trader_payment_money_3);

        //調査会社支払額
        $pay = $payment_money - $trader_payment_money;
        $survey_payment_money = $pay * (int)$matters['survey_referral'] / 100;
        $survey_payment_money = (int)floor($survey_payment_money);

        //利益額
        $profit_money = $payment_money - $trader_payment_money - $survey_payment_money;

        //ログインIDと権限をsessionに保存
        $method->auth();

        $user_login = session()->get('user_login');
        $user_id = User::where('login', $user_login)->select('id')->first();

        return view('matter/matter_create_check',['matters' => $matters, 'advertising_id' => $advertising_id, 'survey_id' => $survey_id, 'matter_statuse_id' => $matter_statuse_id, 'trader_id' => $trader_id, 'trader_name' => $trader_name, 'agency_store_2_id' => $agency_store_2_id, 'agency_store_2_name' => $agency_store_2_name, 'agency_store_3_id' => $agency_store_3_id, 'agency_store_3_name' => $agency_store_3_name, 'payment_money' => $payment_money, 'referral_rate_total' => $referral_rate_total, "certification_money_probability" => $certification_money_probability, "trader_payment_money" => $trader_payment_money, "trader_payment_money_1" => $trader_payment_money_1, "trader_payment_money_2" => $trader_payment_money_2, "trader_payment_money_3" => $trader_payment_money_3, "survey_payment_money" => $survey_payment_money, "profit_money" => $profit_money, 'user_id' => $user_id]);
    }

    //案件登録
    public function create_add(Request $request) {
        try {
            $matters = new Matter;

            //新規登録バリデーション
            $matters->create_validation($request);
            
            $form = $request->all();
            unset($form['_token']);
            $matters->fill($form);
            $matter['submit_date'] = date('Y-m-d');
            $matters->save();
            //報酬・詳細一覧に登録
            $reward = Reward::find($matters['id']);
            if($reward){
                $reward['matter_id'] = $matters['id'];
                $reward->save();
            }else{
                $reward_new = new Reward;
                $reward_new['matter_id'] = $matters['id'];
                $reward_new->save();
            }

            //操作ログ
            $method = new Matter;
            $method->log_all((int)$form['member'],$form['contractor'],'新規登録');

            return redirect()->action('MatterController@all')->with('success_message', '新規登録に成功しました。');

        } catch (\Exception $e) {
            return redirect()->action('MatterController@create')->with('message', '登録に失敗しました。再度お試しください。');
        }
        
    }

    //ステータス変更画面
    public function matter_status_all(Request $request)
    {

        $method = new Matter;

        //ログインIDと権限をsessionに保存
        $method->auth();

        $matter_statuses = Matter_statuse::all()->sortby('id');
        
        return view('matter/matter_status_all',['statuses' => $matter_statuses]);
    }

    //ステータス新規登録
    public function matter_status_add(Request $request)
    {
        $request->validate([
            'status_number'=> ['required', 'regex:/^[0-9]+$/i', 'unique:matter_statuses'],
            'status_name'=> ['required', 'unique:matter_statuses']
        ]);

        $form = $request->all();
        unset($form['_token']);
        
        $matter_statuses = new Matter_statuse;
        $matter_statuses->fill($form);
        
        $matter_statuses->save();

        //操作ログ
        $method = new Matter;
        $method->log_status((int)$form['status_number'],$form['status_name'],'新規登録');

        return redirect('matter/status_all')->with('message', '新規登録に成功しました。');
    }

    //ステータス変更
    public function matter_status_update(Request $request)
    {
        $status = Matter_statuse::where('id',$request->id)->first();

        $request->validate([
            'status_number'=> ['required', 'regex:/^[0-9]+$/i', Rule::unique('matter_statuses')->ignore($status)],
            'status_name'=> ['required',Rule::unique('matter_statuses')->ignore($status)],
        ]);

        $matter_statuses = Matter_statuse::find($request->id);

        $form = $request->all();
        unset($form['_token']);

        $matter_statuses->fill($form);
        $matter_statuses->save();

        //操作ログ
        $method = new Matter;
        $method->log_status((int)$form['status_number'],$form['status_name'],'変更');

        return redirect('matter/status_all')->with('message', '変更に成功しました。');
    }

    //ステータス削除
    public function matter_status_delete(Request $request)
    {
        $statuses = Matter_statuse::find($request->id);

        //操作ログ
        $method = new Matter;
        $method->log_status((int)$statuses['status_number'],$statuses['status_name'],'削除');

        $statuses->delete();
        
        return redirect('matter/status_all')->with('message', '削除に成功しました。');
    }

    //流入経路変更画面
    public function matter_advertising_all(Request $request)
    {

        $method = new Matter;

        //ログインIDと権限をsessionに保存
        $method->auth();

        $matter_advertisings = Advertising::all()->sortby('id');
        
        return view('matter/matter_advertising_all',['advertisings' => $matter_advertisings]);
    }

    //流入経路新規登録
    public function matter_advertising_add(Request $request)
    {
        $request->validate([
            'advertising_name'=> ['required', 'unique:advertisings']
        ]);

        $form = $request->all();
        unset($form['_token']);
        
        $matter_advertisings = new Advertising;
        $matter_advertisings->fill($form);
        
        $matter_advertisings->save();

        $new_id = Advertising::orderby('id', 'desc')->select('id')->first();

        //操作ログ
        $method = new Matter;
        $method->log_advertising((int)$new_id['id'],$form['advertising_name'],'新規登録');

        return redirect('matter/advertising_all')->with('message', '新規登録に成功しました。');
    }

    //流入経路変更
    public function matter_advertising_update(Request $request)
    {
        $advertising = Advertising::where('id',$request->id)->first();

        $request->validate([
            'advertising_name'=> ['required',Rule::unique('advertisings')->ignore($advertising)],
        ]);

        $matter_advertisings = Advertising::find($request->id);

        $form = $request->all();
        unset($form['_token']);

        $matter_advertisings->fill($form);
        $matter_advertisings->save();

        //操作ログ
        $method = new Matter;
        $method->log_advertising((int)$form['id'],$form['advertising_name'],'変更');

        return redirect('matter/advertising_all')->with('message', '変更に成功しました。');
    }

    //流入経路削除
    public function matter_advertising_delete(Request $request)
    {
        $advertisings = Advertising::find($request->id);

        //操作ログ
        $method = new Matter;
        $method->log_advertising((int)$advertisings['id'],$advertisings['advertising_name'],'削除');

        $advertisings->delete();
        
        return redirect('matter/advertising_all')->with('message', '削除に成功しました。');
    }

    //案件情報削除
    public function delete(Request $request) {

        $matters = Matter::find($request->id);
        $matter_agreement = Matter_agreement::find($matters['matter_agreement_id']);
        $matter_bill_issue = Matter_bill_issue::find($matters['matter_bill_issue_id']);
        $matter_certification = Matter_certification::find($matters['matter_certification_id']);
        $matter_drawing = Matter_drawing::find($matters['matter_drawing_id']);
        $matter_insurance_policie = Matter_insurance_policie::find($matters['matter_insurance_policy_id']);
        $matter_quotation = Matter_quotation::find($matters['matter_quotation_id']);
        $matter_report = Matter_report::find($matters['matter_report_id']);

        //操作ログ
        $method = new Matter;
        $method->log_all((int)$matters['member'],$matters['contractor'],'削除');

        $matters->delete();
        $matter_agreement->delete();
        $matter_bill_issue->delete();
        $matter_certification->delete();
        $matter_drawing->delete();
        $matter_insurance_policie->delete();
        $matter_quotation->delete();
        $matter_report->delete();
        return redirect('matter/all')->with('success_message', '削除に成功しました。');
    }

    //案件編集
    public function edit(Request $request) {
        $method = new Matter;
        //ログインIDと権限をsessionに保存
        $method->auth();

        $matters = $method->column()
        ->addselect(
            //図面 ID
            'matters.matter_drawing_id',
            //合意書 ID
            'matters.matter_agreement_id',
            //保険証券 ID
            'matters.matter_insurance_policy_id',
            //報告書 ID
            'matters.matter_report_id',
            //見積書 ID
            'matters.matter_quotation_id',
            //認定書 ID
            'matters.matter_certification_id',
            //請求書 ID
            'matters.matter_bill_issue_id'
        )
        ->find($request->id);
        
        $advertising_name = Advertising::all();
        $survey_corps = Surveie::all();
        $status_name = Matter_statuse::all();
        $traders = Trader::select('id','trader_name')->get();
        $user_name = User::all();

        if($matters['quotation_money'] == null){
            $matters['quotation_money'] = 0;
        }
        if($matters['certification_money'] == null){
            $matters['certification_money'] = 0;
        }
        if($matters['fee'] == null){
            $matters['fee'] = 0;
        }
        if($matters['referral_rate'] == null){
            $matters['referral_rate'] = 0;
        }
        if($matters['referral_rate_2'] == null){
            $matters['referral_rate_2'] = 0;
        }
        if($matters['referral_rate_3'] == null){
            $matters['referral_rate_3'] = 0;
        }
        if($matters['survey_referral'] == null){
            $matters['survey_referral'] = 0;
        }
        if($matters['riguranto_fee'] == null){
            $matters['riguranto_fee'] = 0;
        }
        
        return view('matter/matter_edit',['matters' => $matters, 'advertising_name'=>$advertising_name, 'survey_corps'=>$survey_corps, 'status_name' => $status_name, 'traders' => $traders,'user_name' => $user_name]);
    }

    //案件編集チェック
    public function edit_check(Request $request) {
        
        $method = new Matter;

        //ログインIDと権限をsessionに保存
        $method->auth();

        //編集バリデーショ
        $method->edit_validation($request->id, $request);

        //画像のパス
        $drawing_read_path = $method->document_path('drawing',$request);

        $agreement_read_path = $method->document_path('agreement',$request);

        $insurance_policy_read_path = $method->document_path('insurance_policy',$request);

        $report_read_path = $method->document_path('report',$request);

        $quotation_read_path = $method->document_path('quotation',$request);

        $certification_read_path = $method->document_path('certification',$request);

        $bill_issue_read_path = $method->document_path('bill_issue',$request);

        $matters = $request->all();

        $advertising_id = Advertising::where('advertising_name', $matters['advertising_name'])->select('id')->first();
        $survey_id = Surveie::where('survey_name', $matters['survey_name'])->select('id')->first();
        $status_id = Matter_statuse::where('status_name',$matters['status_name'])->select('id','status_number')->first();

        $trader = Trader::find($matters['trader_id']);
        $trader_id = $trader['id'];
        $trader_name = $trader['trader_name'];
        $agency_store_2 = Trader::find($trader['introducer']);
        $agency_store_2_id = $agency_store_2['id'];
        $agency_store_2_name = $agency_store_2['trader_name'];
        $agency_store_3 = Trader::find($agency_store_2['introducer']);
        $agency_store_3_id = $agency_store_3['id'];
        $agency_store_3_name = $agency_store_3['trader_name'];

        //入金額の計算
        $payment_money = (int)$matters['certification_money'] * (int)$matters['fee'] / 100;
        $payment_money = floor($payment_money);

        if((int)$matters['quotation_money'] == 0){
            $certification_money_probability = 0;
        }else{
            //見積額の認定率
            $certification_money_probability = (int)$matters['certification_money'] / (int)$matters['quotation_money'] * 100;
            $certification_money_probability = (int)floor($certification_money_probability);
        }

        //紹介率合計の計算
        $referral_rate_total = (int)$matters['referral_rate'] + (int)$matters['referral_rate_2'] + (int)$matters['referral_rate_3'];

        //取次店支払額
        $trader_payment_money = $payment_money * $referral_rate_total / 100;
        $trader_payment_money = (int)floor($trader_payment_money);

        //取次店支払額 1
        $trader_payment_money_1 = $payment_money * (int)$matters['referral_rate'] / 100;
        $trader_payment_money_1 = (int)floor($trader_payment_money_1);

        //取次店支払額 2
        $trader_payment_money_2 = $payment_money * (int)$matters['referral_rate_2'] / 100;
        $trader_payment_money_2 = (int)floor($trader_payment_money_2);

        //取次店支払額 3
        $trader_payment_money_3 = $payment_money * (int)$matters['referral_rate_3'] / 100;
        $trader_payment_money_3 = (int)floor($trader_payment_money_3);

        //調査会社支払額
        $pay = $payment_money - $trader_payment_money;
        $survey_payment_money = $pay * (int)$matters['survey_referral'] / 100;
        $survey_payment_money = (int)floor($survey_payment_money);

        //利益額
        $profit_money = $payment_money - $trader_payment_money - $survey_payment_money;

        return view('matter/matter_edit_check',['matters' => $matters, 'insurance_policy_read_path' => $insurance_policy_read_path, 'drawing_read_path' => $drawing_read_path, 'agreement_read_path' => $agreement_read_path, 'report_read_path' => $report_read_path,  'quotation_read_path' => $quotation_read_path, 'certification_read_path' => $certification_read_path, 'bill_issue_read_path' =>  $bill_issue_read_path, 'advertising_id' => $advertising_id, 'survey_id' => $survey_id, 'status_id' => $status_id, 'trader_id' => $trader_id, 'trader_name' => $trader_name, 'agency_store_2_id' => $agency_store_2_id, 'agency_store_2_name' => $agency_store_2_name, 'agency_store_3_id' => $agency_store_3_id, 'agency_store_3_name' => $agency_store_3_name, 'payment_money' => $payment_money, 'referral_rate_total' => $referral_rate_total, "certification_money_probability" => $certification_money_probability, "trader_payment_money" => $trader_payment_money, "trader_payment_money_1" => $trader_payment_money_1, "trader_payment_money_2" => $trader_payment_money_2, "trader_payment_money_3" => $trader_payment_money_3, "survey_payment_money" => $survey_payment_money, "profit_money" => $profit_money]);
    }

    //案件情報アップデート
    public function update(Request $request) {
        try {
            $method = new Matter;

            $matters = Matter::find($request->id);

            //編集バリデーショ
            $method->edit_validation($request->id, $request);
            
            $form = $request->all();
            unset($form['_token']);

            //画像の有/無で保存方法を変える
            $method->document_exist($matters,'App\Models\Matter_drawing',$form,'drawing');
            if($form['matter_drawing_id'] == '1'){
                $id = Matter_drawing::orderby('id', 'desc')->select('id')->first();
                $form['matter_drawing_id'] = $id['id'];
            }
            
            $method->document_exist($matters,'App\Models\Matter_agreement',$form,'agreement');
            if($form['matter_agreement_id'] == '1'){
                $id = Matter_agreement::orderby('id', 'desc')->select('id')->first();
                $form['matter_agreement_id'] = $id['id'];
            }

            $method->document_exist($matters,'App\Models\Matter_insurance_policie',$form,'insurance_policy');
            if($form['matter_insurance_policy_id'] == '1'){
                $id = Matter_insurance_policie::orderby('id', 'desc')->select('id')->first();
                $form['matter_insurance_policy_id'] = $id['id'];
            }

            $method->document_exist($matters,'App\Models\Matter_report',$form,'report');
            if($form['matter_report_id'] == '1'){
                $id = Matter_report::orderby('id', 'desc')->select('id')->first();
                $form['matter_report_id'] = $id['id'];
            }

            $method->document_exist($matters,'App\Models\Matter_quotation',$form,'quotation');
            if($form['matter_quotation_id'] == '1'){
                $id = Matter_quotation::orderby('id', 'desc')->select('id')->first();
                $form['matter_quotation_id'] = $id['id'];
            }

            $method->document_exist($matters,'App\Models\Matter_certification',$form,'certification');
            if($form['matter_certification_id'] == '1'){
                $id = Matter_certification::orderby('id', 'desc')->select('id')->first();
                $form['matter_certification_id'] = $id['id'];
            }

            $matters_status_id = $matters['matter_status_id'];

            if($matters_status_id != $form['matter_status_id']){
                $matters['matter_status_add'] = date('Y-m-d');
            }
            $matters->fill($form);
            $matters->save();

            //操作ログ
            $method->log_all((int)$form['member'],$form['contractor'],'編集');

            //ステータス変更ログ & 変更メール
            if($matters_status_id != $form['matter_status_id']){
                $status_before = Matter_statuse::find($matters_status_id);
                $status_after = Matter_statuse::find($form['matter_status_id']);
                $method->log_change_status($request->id,$status_before['status_number'],$status_before['status_name'],$status_after['status_number'],$status_after['status_name']);

                $first_client = Trader::find($matters['trader_id']);
                $second_client = Trader::find($matters['agency_store_2']);
                $third_client = Trader::find($matters['agency_store_3']);

                return redirect()->action('MailSendController@status_send', ['form' => '法人','first_client' => $first_client['trader_name'], 'second_client' => $second_client['trader_name'],'third_client' => $third_client['trader_name'], 'matter' => $first_client['main_project'], 'status_after' => $status_after['status_number'].'：'.$status_after['status_name'], 'status_before' => $status_before['status_number'].'：'.$status_before['status_name'], 'first_mail' => $first_client['trader_email'], 'second_mail' => $second_client['trader_email'], 'third_mail' => $third_client['trader_email']]);
            }

            return redirect('matter/all')->with('success_message', '更新に成功しました。');

        } catch (\Exception $e) {
            return redirect()->action('MatterController@edit', ['id' => $request->id])->with('error_message', '更新に失敗しました。再度お試しください。');
        }
    }

    //キーワード検索
    public function filter_search(Request $request) {

        $search = $request->search;

        $method = new Matter;

        //ログインIDと権限をsessionに保存
        $method->auth();

        //jsonに変えて暗号化
        $matter_data = json_decode($request->matter_data, true);
        $matter_data = Crypt::encryptString($matter_data);

        $traders = Trader::all();
        $status_name = Matter_statuse::all();

        $authoritys = session()->get('authoritys');

        $user_login = session()->get('user_login');

        foreach($authoritys as $authorities){
            if($authorities == "リグラント営業"){
                $search_sales = User::where('login', $user_login)->select('username')->first();
                $search_username = $search_sales['username'];
                $matter_column = $method->column();

                //リグラント営業かつカラムの検索
                $matters = $matter_column->where(function($matter_column) use($search_username){
                    $matter_column->where('matters.sales_staff', $search_username);
                });
                $matters = $matter_column->where(function($matter_column) use($search){
                    $matter_column->where('important', 'LIKE', '%' . $search .'%')
                    ->orwhere('caution','LIKE','%'.$search.'%')
                    ->orwhere('sales_staff','LIKE','%'.$search.'%')
                    ->orwhere('advertising','LIKE','%'.$search.'%')
                    ->orwhere('survey_name','LIKE','%'.$search.'%')
                    ->orwhere('member','LIKE','%'.$search.'%')
                    ->orwhere('group_name','LIKE','%'.$search.'%')
                    ->orwhere('contractor','LIKE','%'.$search.'%')
                    ->orwhere('property_information','LIKE','%'.$search.'%')
                    ->orwhere('insurance_policyholder','LIKE','%'.$search.'%')
                    ->orwhere('buildingname','LIKE','%'.$search.'%')
                    ->orwhere('matters.address','LIKE','%'.$search.'%')
                    ->orwhere('status_name','LIKE','%'.$search.'%')
                    ->orwhere('action_date','LIKE','%'.$search.'%');
                });

                if($matters->isEmpty()){
                    return redirect()->action('MatterController@all')->with('error_message', '検索された項目は存在しませんでした。');
                }

                //jsonに変えて暗号化
                $matter_data = json_encode($matters->get(), JSON_UNESCAPED_UNICODE);
                $matter_data = Crypt::encryptString($matter_data);

                $matters = $matters->orderBy('matters.id', 'ASC')->paginate(100);

                if($request->sort == '複数検索'){
                    $matters = $method->scopeSerach($request->matter_status_id, $request->action_date, $request->action_note, $request->note);
                    $matters = $matters->where(function($matters) use($search_username){
                        $matters->where('matters.sales_staff', $search_username);
                    });
                    if($matters->isEmpty()){
                        return redirect()->action('MatterController@all')->with('error_message', '検索された項目は存在しませんでした。');
                    }

                    //jsonに変えて暗号化
                    $matter_data = json_encode($matters, JSON_UNESCAPED_UNICODE);
                    $matter_data = Crypt::encryptString($matter_data);

                    return view('matter/matter_all', ['matters' => $matters, 'matter_data' => $matter_data, 'traders' => $traders, 'status_name' => $status_name]);
                }elseif($request->sort == '昇順'){
                    $method->sort($request,$matters,SORT_ASC);
        
                    return view('matter/matter_all', ['matters' => $matters, 'matter_data' =>$request->matter_data, 'traders' => $traders, 'status_name' => $status_name]);
                }elseif($request->sort == '降順'){
                    $method->sort($request,$matters,SORT_DESC);
        
                    return view('matter/matter_all', ['matters' => $matters, 'matter_data' =>$request->matter_data, 'traders' => $traders, 'status_name' => $status_name]);
                }

                return view('matter/matter_all', ['matters' => $matters, 'matter_data' => $matter_data, 'traders' => $traders, 'status_name' => $status_name]);
            }elseif($authorities == "調査会社"){
                $search_survey = User::where('login', $user_login)->select('survey_id')->first();
                $search_survey_id = $search_survey['survey_id'];
                $matter_column = $method->column();

                //調査会社かつカラムの検索
                $matters = $matter_column->where(function($matter_column) use($search_survey_id){
                    $matter_column->where('surveies.id',$search_survey_id);
                });

                $matters = $matter_column->where(function($matter_column) use($search){
                    $matter_column->where('important', 'LIKE', '%' . $search .'%')
                    ->orwhere('caution','LIKE','%'.$search.'%')
                    ->orwhere('member','LIKE','%'.$search.'%')
                    ->orwhere('group_name','LIKE','%'.$search.'%')
                    ->orwhere('contractor','LIKE','%'.$search.'%')
                    ->orwhere('property_information','LIKE','%'.$search.'%')
                    ->orwhere('insurance_policyholder','LIKE','%'.$search.'%')
                    ->orwhere('buildingname','LIKE','%'.$search.'%')
                    ->orwhere('matters.address','LIKE','%'.$search.'%')
                    ->orwhere('contact_method','LIKE','%'.$search.'%')
                    ->orwhere('survey_date','LIKE','%'.$search.'%')
                    ->orwhere('survey_referral','LIKE','%'.$search.'%');
                });

                //jsonに変えて暗号化
                $matter_data = json_encode($matters->get(), JSON_UNESCAPED_UNICODE);
                $matter_data = Crypt::encryptString($matter_data);
                
                $matters = $matters->orderBy('matters.id', 'ASC')->paginate(100);

                if($matters->isEmpty()){
                    return redirect()->action('MatterController@all')->with('error_message', '検索された項目は存在しませんでした。');
                }

                if($request->sort == '昇順'){
                    $method->sort($request,$matters,SORT_ASC);
        
                    return view('matter/matter_all', ['matters' => $matters, 'matter_data' =>$request->matter_data, 'traders' => $traders, 'status_name' => $status_name]);
                }elseif($request->sort == '降順'){
                    $method->sort($request,$matters,SORT_DESC);
        
                    return view('matter/matter_all', ['matters' => $matters, 'matter_data' =>$request->matter_data, 'traders' => $traders, 'status_name' => $status_name]);
                }
        
                return view('matter/matter_all',['matters' => $matters, 'matter_data' =>$matter_data, 'traders' => $traders, 'status_name' => $status_name]);
            }elseif($authorities == "全画面"){
                $matters = $method->column()
                ->where('important', 'LIKE', '%' . $search . '%')
                ->orwhere('caution','LIKE','%'.$search.'%')
                ->orwhere('submit_date','LIKE','%'.$search.'%')
                ->orwhere('advertising_name','LIKE','%'.$search.'%')
                ->orwhere('member','LIKE','%'.$search.'%')
                ->orwhere('group_name','LIKE','%'.$search.'%')
                ->orwhere('contractor','LIKE','%'.$search.'%')
                ->orwhere('property_information','LIKE','%'.$search.'%')
                ->orwhere('insurance_policyholder','LIKE','%'.$search.'%')
                ->orwhere('buildingname','LIKE','%'.$search.'%')
                ->orwhere('matters.address','LIKE','%'.$search.'%')
                ->orwhere('contact_method','LIKE','%'.$search.'%')
                ->orwhere('building_age','LIKE','%'.$search.'%')
                ->orwhere('insurance_company','LIKE','%'.$search.'%')
                ->orwhere('status_name','LIKE','%'.$search.'%')
                ->orwhere('note','LIKE','%'.$search.'%')
                ->orwhere('drawing','LIKE','%'.$search.'%')
                ->orwhere('agreement_date','LIKE','%'.$search.'%')
                ->orwhere('insurance_policy','LIKE','%'.$search.'%')
                ->orwhere('scheduled_survey_date','LIKE','%'.$search.'%')
                ->orwhere('request_date','LIKE','%'.$search.'%')
                ->orwhere('survey_date','LIKE','%'.$search.'%')
                ->orwhere('survey_staff','LIKE','%'.$search.'%')
                ->orwhere('construction_consultant','LIKE','%'.$search.'%')
                ->orwhere('action_date','LIKE','%'.$search.'%')
                ->orwhere('action_note','LIKE','%'.$search.'%')
                ->orwhere('payment_predict_date','LIKE','%'.$search.'%')
                ->orwhere('payment_expecte','LIKE','%'.$search.'%')
                ->orwhere('survey_name','LIKE','%'.$search.'%')
                ->orwhere('accident_date','LIKE','%'.$search.'%')
                ->orwhere('insurance_policy_date','LIKE','%'.$search.'%')
                ->orwhere('billing_receipt_date','LIKE','%'.$search.'%')
                ->orwhere('certification_date','LIKE','%'.$search.'%')
                ->orwhere('bill_issue_date','LIKE','%'.$search.'%')
                ->orwhere('quotation_money_probability','LIKE','%'.$search.'%')
                ->orwhere('payment_date','LIKE','%'.$search.'%')
                ->orwhere('traders.trader_name','LIKE','%'.$search.'%')
                ->orwhere('agency_store_2.trader_name','LIKE','%'.$search.'%')
                ->orwhere('agency_store_3.trader_name','LIKE','%'.$search.'%')
                ->orwhere('sales_staff','LIKE','%'.$search.'%')
                ->orwhere('matter_drawings.image_title','LIKE','%'.$search.'%')
                ->orwhere('matter_agreements.image_title','LIKE','%'.$search.'%')
                ->orwhere('matter_insurance_policies.image_title','LIKE','%'.$search.'%')
                ->orwhere('matter_reports.image_title','LIKE','%'.$search.'%')
                ->orwhere('quotation_completed_date','LIKE','%'.$search.'%')
                ->orwhere('matter_quotations.image_title','LIKE','%'.$search.'%')
                ->orwhere('matter_certifications.image_title','LIKE','%'.$search.'%');

                //jsonに変えて暗号化
                $matter_data = json_encode($matters->get(), JSON_UNESCAPED_UNICODE);
                $matter_data = Crypt::encryptString($matter_data);
                
                $matters = $matters->orderBy('matters.id', 'ASC')->paginate(100);

                if($matters->isEmpty()){
                    return redirect()->action('MatterController@all')->with('error_message', '検索された項目は存在しませんでした。');
                }

                if($request->sort == '複数検索'){
                    $matters = $method->scopeSerach($request->matter_status_id, $request->action_date, $request->action_note, $request->note);

                    if($matters->isEmpty()){
                        return redirect()->action('MatterController@all')->with('error_message', '検索された項目は存在しませんでした。');
                    }

                    //jsonに変えて暗号化
                    $matter_data = json_encode($matters, JSON_UNESCAPED_UNICODE);
                    $matter_data = Crypt::encryptString($matter_data);

                    return view('matter/matter_all', ['matters' => $matters, 'matter_data' => $matter_data, 'traders' => $traders, 'status_name' => $status_name]);
                }elseif($request->sort == '昇順'){
                    $method->sort($request,$matters,SORT_ASC);
        
                    return view('matter/matter_all', ['matters' => $matters, 'matter_data' =>$request->matter_data, 'traders' => $traders, 'status_name' => $status_name]);
                }elseif($request->sort == '降順'){
                    $method->sort($request,$matters,SORT_DESC);
        
                    return view('matter/matter_all', ['matters' => $matters, 'matter_data' =>$request->matter_data, 'traders' => $traders, 'status_name' => $status_name]);
                }
        
                return view('matter/matter_all',['matters' => $matters, 'matter_data' =>$matter_data, 'traders' => $traders, 'status_name' => $status_name]);
            }
        }

        return redirect()->action('MatterController@all')->with('error_message', '検索された項目は存在しませんでした。');
    }
    
    //チェックボックス削除
    public function check_delete($value) {
        sleep(1);

        $id = explode(",",$value);

        $count =count($id);
        for($i = 0; $i < $count; $i++){
            $box[] = array('id' => $id[$i]);
        }

        foreach($box as $val){
            $matters = '';
            $matters = Matter::find($val['id']);
            $matter_member[] = ['ID' => $matters['member']];
            $matter_contractor[] = ['会社名' => $matters['contractor']];
            $data = $matters->delete();
        }

        //操作ログ
        $method = new Matter;

        $matter_member = json_encode($matter_member,JSON_UNESCAPED_UNICODE);
        $matter_contractor = json_encode($matter_contractor,JSON_UNESCAPED_UNICODE);

        $method->log_check_box($matter_member,$matter_contractor,'削除');

        return response()->json($data);
    }

    //チェックボックス・プルダウン更新
    public function check_edit($value,$status_name,$important_value) {
        sleep(1);

        $method = new Matter;

        $id = explode(",",$value);
        $status_id = explode(",",$status_name);
        $important_value = explode(",",$important_value);

        $count =count($id);
        for($i = 0; $i < $count; $i++){
            $box[] = array('id' => $id[$i], 'status_id' => $status_id[$i], 'important_value' => $important_value[$i]);
        }

        foreach($box as $val){
            $matters = '';
            $matters = Matter::find($val['id']);
            $matter_member[] = ['ID' => $matters['member']];
            $matter_contractor[] = ['会社名' => $matters['contractor']];
            if($val['important_value'] == 0){
                $matters['important'] = '☆';
            }else{
                $matters['important'] = '★';
            }
            //ステータス変更ログ
            $matter_status_id = $matters['matter_status_id'];
            if($matter_status_id != $val['status_id']){
                $matters['matter_status_add'] = date('Y-m-d');
                $status_before = Matter_statuse::find($matter_status_id);
                $status_after = Matter_statuse::find($val['status_id']);
                $method->log_change_status($val['id'],$status_before['status_number'],$status_before['status_name'],$status_after['status_number'],$status_after['status_name']);

                //ステータス変更でメールを送信
                $first_client = Trader::find($matters['trader_id']);
                $second_client = Trader::find($matters['agency_store_2']);
                $third_client = Trader::find($matters['agency_store_3']);

                $forms = [];
                $forms = ['first_client' => $first_client['trader_name'], 'second_client' => $second_client['trader_name'],'third_client' => $third_client['trader_name'], 'matter' => $first_client['main_project'], 'status_after' => $status_after['status_number'].'：'.$status_after['status_name'], 'status_before' => $status_before['status_number'].'：'.$status_before['status_name'], 'first_mail' => $first_client['trader_email'], 'second_mail' => $second_client['trader_email'], 'third_mail' => $third_client['trader_email']];
                $mail = new MailSend;
                $mail->matter_first($forms);
                if($forms['second_client']){
                    $mail->matter_second($forms);
                }
                if($forms['third_client']){
                    $mail->matter_third($forms);
                }
            }
            $matters['matter_status_id'] = $val['status_id'];
            $data = $matters->save();
        }

        //操作ログ
        $matter_member = json_encode($matter_member,JSON_UNESCAPED_UNICODE);
        $matter_contractor = json_encode($matter_contractor,JSON_UNESCAPED_UNICODE);

        $method->log_check_box($matter_member,$matter_contractor,'変更');

        return response()->json($data);
    }

    /*
    //請求書ダウンロード
    public function invoiceDownload(Request $request) {
    
        //案件のIDの取得
        $matter = Matter::find($request->id);

        //請求書テンプレートの保管場所の指定
        $filePath = storage_path('../storage/app/public/001_invoice_template.xlsx'); //storage_path => ('app/public')
        
        $reader = new XlsxReader();
        $spreadsheet = $reader->load($filePath);

        $worksheet = $spreadsheet->getSheetByName('請求書');//シート名の指定

        
        // ※請求書のテンプレートのセルが変わったら第一引数のセル番号を変更することを忘れずに。
        
        $worksheet->setCellValue('A3', $matter->insurance_company);   //御中
        $worksheet->setCellValue('D4', $matter->pic);                 //ご担当
        $worksheet->setCellValue('C6', 'テスト');                     //件名
        $worksheet->setCellValue('B18', '調査会社 手数料');            //摘要
        $worksheet->setCellValue('J18', '1');                         //数量
        if($matter->work_reward_amount){
            $worksheet->setCellValue('L18', $matter->work_reward_amount); //単価
        }else{
            $worksheet->setCellValue('L18', 0); //単価
        }
    
        //摘要の数によりここで反復処理を追加？

        //ファイル名の指定
        $fileName = "請求書_" . date('yymd') . ".xlsx";

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;');
        header("Content-Disposition: attachment; filename=\"{$fileName}\"");
        header('Cache-Control: max-age=0');

        $writer = new XlsxWriter($spreadsheet);
        $writer->save('php://output');

        exit;
    }
    */

    public function export_csv() {

        //操作ログ
        $method = new Matter;
        $method->log_port('エクスポート');
        
        return response()->streamDownload(
            function () {
                // 出力バッファをopen
                $stream = fopen('php://output', 'w');
                // 文字コードをShift-JISに変換
                stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');
                $method = new Matter;
                //ヘッダー要素
                $header = $method->head_name();
                // ヘッダー
                fputcsv($stream, $header);
                // データ
                $traders = Trader::select('id', 'trader_name')->get();
                foreach($traders as $trader){
                    $trader_id[$trader['id']] = $trader['trader_name'];
                }
                foreach ($method->column()->cursor() as $matter) {
                    if($matter->drawing == '0'){
                        $matter->drawing = '-';
                    }else{
                        $matter->drawing = '〇';
                    }
                    if($matter->agreement == '0'){
                        $matter->agreement = '-';
                    }else{
                        $matter->agreement = '〇';
                    }
                    if($matter->insurance_policy == '0'){
                        $matter->insurance_policy = '-';
                    }else{
                        $matter->insurance_policy = '〇';
                    }
                    $agency_store_2_name = $trader_id[$matter->agency_store_2];
                    $agency_store_3_name = $trader_id[$matter->agency_store_3];

                    fputcsv($stream, $method->stream($matter, $agency_store_2_name, $agency_store_3_name));
                }
                fclose($stream);
            },
            '法人案件一覧.csv',
            [
                'Content-Type' => 'text/csv'
            ]
        );
    }

    public function csv_import_view()
    {
        $method = new Matter;

        //ログインIDと権限をsessionに保存
        $method->auth();

        return view('matter/csv_import');
    }


    public function csv_import_check(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Matter;
        $method->auth();

        $user_login = session()->get('user_login');
        $user_id = User::where('login', $user_login)->select('id')->first();

        $file_path = $request->file('csv')->path();   //CSV読み込み
        $datas = new \SplFileObject($file_path);
        $datas->setFlags(
            \SplFileObject::READ_CSV |      // CSVとして行を読み込み
                \SplFileObject::READ_AHEAD |    // 先読み／巻き戻しで読み込み
                \SplFileObject::SKIP_EMPTY |    // 空行を読み飛ばす
                \SplFileObject::DROP_NEW_LINE   // 行末の改行を読み飛ばす
        );
        
        $row_count = 1;
        $i = 0;
        foreach ($datas as $data) {
            if(count($data) > 48){
                return redirect('matter/csv_import')->with('message', '項目数が合っていません');
            }

            if ($row_count > 1) {
                $data = mb_convert_encoding($data, 'UTF-8', 'SJIS');        //文字コードをSJISに変換
                
                $values[$i]['submit_date'] = date('Y-m-d');
                $values[$i]['advertising_name'] = $data[0];
                $values[$i]['member'] = $data[1];
                $values[$i]['group_name'] = $data[2];
                $values[$i]['contractor'] = $data[3];
                $values[$i]['insurance_policyholder'] = $data[4];
                $values[$i]['address'] = $data[5];
                $values[$i]['buildingname'] = $data[6];
                $values[$i]['property_information'] = $data[7];
                $values[$i]['contact_method'] = $data[8];
                $values[$i]['building_age'] = $data[9];
                $values[$i]['insurance_company'] = $data[10];
                $values[$i]['status_name'] = $data[11];
                $values[$i]['action_date'] = $data[12];
                $values[$i]['action_note'] = $data[13];
                $values[$i]['note'] = $data[14];
                $values[$i]['payment_predict_date'] = $data[15];
                $values[$i]['payment_expecte'] = $data[16];
                $values[$i]['sales_staff'] = $data[17];
                $values[$i]['survey_name'] = $data[18];
                $values[$i]['survey_staff'] = $data[19];
                $values[$i]['request_date'] = $data[20];
                $values[$i]['scheduled_survey_date'] = $data[21];
                $values[$i]['survey_date'] = $data[22];
                $values[$i]['agreement_date'] = $data[23];
                $values[$i]['accident_date'] = $data[24];
                $values[$i]['insurance_policy_date'] = $data[25];
                $values[$i]['certification_date'] = $data[26];
                $values[$i]['bill_issue_date'] = $data[27];
                $values[$i]['payment_date'] = $data[28];
                $values[$i]['quotation_money'] = $data[29];
                $values[$i]['certification_money'] = $data[30];
                $values[$i]['quotation_money_probability'] = $data[31];
                $values[$i]['fee'] = $data[32];
                $values[$i]['payment_money'] = $data[33];
                $values[$i]['survey_referral'] = $data[34];
                $values[$i]['survey_payment_money'] = $data[35];
                $values[$i]['trader_name'] = $data[36];
                $values[$i]['referral_rate'] = $data[37];
                $values[$i]['trader_payment_money_1'] = $data[38];
                $values[$i]['agency_store_2_name'] = $data[39];
                $values[$i]['referral_rate_2'] = $data[40];
                $values[$i]['trader_payment_money_2'] = $data[41];
                $values[$i]['agency_store_3_name'] = $data[42];
                $values[$i]['referral_rate_3'] = $data[43];
                $values[$i]['trader_payment_money_3'] = $data[44];
                $values[$i]['referral_rate_total'] = $data[45];
                $values[$i]['trader_payment_money'] = $data[46];
                $values[$i]['profit_money'] = $data[47];
                //importした人のid
                $values[$i]['user_id'] = $user_id['id'];
            }
            $row_count++;
            $i++;
        }
        return view('matter/csv_import_check', ['values' => $values]);
    }

    public function csv_import_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
                //バリデーションルールの記入
                'values.*.survey_name' => ['required','exists:surveies,survey_name'],
                'values.*.member' => ['required', 'max:10', 'unique:matters,member'],
                'values.*.contractor' => ['required'],
                'values.*.address' => ['required'],
                'values.*.contact_method' => ['required']
            ]);

        if ($validator->fails()) {
            return redirect('matter/csv_import')->withErrors($validator)->withInput();
            //エラー時の処理
        }

        $datas = $request->all();
        unset($datas['_token']);

        $advertising = Advertising::all();
        $survey = Surveie::all();
        $status = Matter_statuse::select('id','status_name')->get();
        $trader = Trader::select('id','trader_name')->get();

        $i = 0;
        foreach ($datas as $key => $data) {
            for($i; $i<count($data); $i++){

                $matters = new Matter;

                $advertising_id = '1';
                foreach($advertising as $advertisings){
                    if($advertisings['advertising_name'] == $data[$i]['advertising_name']){
                        $advertising_id = $advertisings['id'];
                    }
                }

                $survey_id = '1';
                foreach($survey as $surveys){
                    if($surveys['survey_name'] == $data[$i]['survey_name']){
                        $survey_id = $surveys['id'];
                    }
                }

                $status_id = '1';
                foreach($status as $statuses){
                    if($statuses['status_name'] == $data[$i]['status_name']){
                        $status_id = $statuses['id'];
                    }
                }
                
                $trader_id = '1';
                $agency_store_2 = '1';
                $agency_store_3 = '1';
                foreach($trader as $traders){
                    if($traders['trader_name'] == $data[$i]['trader_name']){
                        $trader_id = $traders['id'];
                    }
                    if($traders['trader_name'] == $data[$i]['agency_store_2_name']){
                        $agency_store_2 = $traders['id'];
                    }
                    if($traders['trader_name'] == $data[$i]['agency_store_3_name']){
                        $agency_store_3 = $traders['id'];
                    }
                }

                $matters['important'] = '☆';
                $matters['caution'] = '△';
                $clients['submit_date'] = $data[$i]['submit_date'];
                $matters['advertising_id'] = $advertising_id;
                $matters['member'] = $data[$i]['member'];
                $matters['group_name'] = $data[$i]['group_name'];
                $matters['contractor'] = $data[$i]['contractor'];
                $matters['insurance_policyholder'] = $data[$i]['insurance_policyholder'];
                $matters['address'] = $data[$i]['address'];
                $matters['buildingname'] = $data[$i]['buildingname'];
                $matters['property_information'] = $data[$i]['property_information'];
                $matters['contact_method'] = $data[$i]['contact_method'];
                $matters['building_age'] = $data[$i]['building_age'];
                $matters['insurance_company'] = $data[$i]['insurance_company'];
                $matters['matter_status_id'] = $status_id;
                $matters['action_date'] = $data[$i]['action_date'];
                $matters['action_note'] = $data[$i]['action_note'];
                $matters['note'] = $data[$i]['note'];
                $matters['payment_predict_date'] = $data[$i]['payment_predict_date'];
                $matters['payment_expecte'] = $data[$i]['payment_expecte'];
                $matters['sales_staff'] = $data[$i]['sales_staff'];
                $matters['survey_id'] = $survey_id;
                $matters['survey_staff'] = $data[$i]['survey_staff'];
                $matters['request_date'] = $data[$i]['request_date'];
                $matters['scheduled_survey_date'] = $data[$i]['scheduled_survey_date'];
                $matters['survey_date'] = $data[$i]['survey_date'];
                $matters['agreement_date'] = $data[$i]['agreement_date'];
                $matters['accident_date'] = $data[$i]['accident_date'];
                $matters['insurance_policy_date'] = $data[$i]['insurance_policy_date'];
                $matters['certification_date'] = $data[$i]['certification_date'];
                $matters['bill_issue_date'] = $data[$i]['bill_issue_date'];
                $matters['payment_date'] = $data[$i]['payment_date'];
                $matters['quotation_money'] = $data[$i]['quotation_money'];
                $matters['certification_money'] = $data[$i]['certification_money'];
                $matters['quotation_money_probability'] = $data[$i]['quotation_money_probability'];
                $matters['fee'] = $data[$i]['fee'];
                $matters['payment_money'] = $data[$i]['payment_money'];
                $matters['survey_referral'] = $data[$i]['survey_referral'];
                $matters['survey_payment_money'] = $data[$i]['survey_payment_money'];
                $matters['trader_id'] = $trader_id;
                $matters['referral_rate'] = $data[$i]['referral_rate'];
                $matters['trader_payment_money_1'] = $data[$i]['trader_payment_money_1'];
                $matters['agency_store_2'] = $agency_store_2;
                $matters['referral_rate_2'] = $data[$i]['referral_rate_2'];
                $matters['trader_payment_money_2'] = $data[$i]['trader_payment_money_2'];
                $matters['agency_store_3'] = $agency_store_3;
                $matters['referral_rate_3'] = $data[$i]['referral_rate_3'];
                $matters['trader_payment_money_3'] = $data[$i]['trader_payment_money_3'];
                $matters['referral_rate_total'] = $data[$i]['referral_rate_total'];
                $matters['trader_payment_money'] = $data[$i]['trader_payment_money'];
                $matters['profit_money'] = $data[$i]['profit_money'];
                //資料
                $matters['matter_insurance_policy_id'] = 1;
                $matters['matter_agreement_id'] = 1;
                $matters['matter_report_id'] = 1;
                $matters['matter_quotation_id'] = 1;
                $matters['matter_certification_id'] = 1;
                $matters['matter_bill_issue_id'] = 1;
                $matters['matter_drawing_id'] = 1;
                //importした人のid
                $matters['user_id'] = $data[$i]['user_id'];

                $matters->save();   //mattersテーブルに保存
                //報酬・詳細一覧に登録
                $reward = Reward::find($matters['id']);
                if($reward){
                    $reward['matter_id'] = $matters['id'];
                    $reward->save();
                }else{
                    $reward_new = new Reward;
                    $reward_new['matter_id'] = $matters['id'];
                    $reward_new->save();
                }
            }
        }
        //操作ログ
        $method = new Matter;
        $method->log_port('インポート');
        return redirect('matter/csv_import')->with('success_message', 'インポートに成功しました。');
    }

}
