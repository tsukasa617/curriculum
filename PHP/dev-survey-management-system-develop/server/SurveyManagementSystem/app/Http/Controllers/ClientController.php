<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use App\Models\Surveie;
use App\Models\Trader;
use App\Models\Client_statuse;
use App\Models\Client_agreement;
use App\Models\Client_certification;
use App\Models\Client_drawing;
use App\Models\Client_insurance_policie;
use App\Models\Client_quotation;
use App\Models\Client_report;
use App\Models\Reward;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Mail\MailSend;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function all(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Client;
        $method->auth();

        //jsonに変えて暗号化
        $client_data = json_encode($method->column()->get(), JSON_UNESCAPED_UNICODE);
        $client_data = Crypt::encryptString($client_data);

        $status_name = Client_statuse::all();

        //ステータス変更されていなければ、カラムを黄色に変更
        $dt_now = new Carbon(date('Y-m-d'));
        foreach (Client::cursor() as $client){
            if($client->client_status_add){
                if($client->caution == '▲'){
                    $client->caution = '△';
                    $client->save();
                }
                if($client->survey_date){
                    $dt_status_log = new Carbon($client->client_status_add);
                    $comparison_now = $dt_now->gt($client->survey_date);
                    $middle_log = $dt_status_log->between($client->submit_date, $client->survey_date);
                    if($client->caution == '△' && $middle_log == true && $comparison_now == true){
                        $client->caution = '▲';
                        $client->save();
                    }
                }
            }else{
                $elapsed_now = $dt_now->diffInDays($client->submit_date);
                if($client->caution == '△' && $elapsed_now >= 5){
                    $client->caution = '▲';
                    $client->save();
                }
            }
        }

        $authoritys = session()->get('authoritys');

        $user_login = session()->get('user_login');

        foreach($authoritys as $authorities){
            if($authorities == "リグラント営業"){
                $search_sales = User::where('login', $user_login)->select('username')->first();
                $clients = $method->column()->where('clients.sales_staff','LIKE','%'.$search_sales['username'].'%');

                //jsonに変えて暗号化
                $client_data = json_encode($clients->get(), JSON_UNESCAPED_UNICODE);
                $client_data = Crypt::encryptString($client_data);

                $clients = $clients->orderBy('clients.id','ASC')->paginate(100);

                return view('client/client_all', ['clients' => $clients, 'client_data' => $client_data, 'status_name' => $status_name]);
            }elseif($authorities == "調査会社"){
                $search_survey = User::where('login', $user_login)->select('survey_id')->first();
                $clients = $method->column()->where('surveies.id','LIKE','%'.$search_survey['survey_id'].'%');

                //jsonに変えて暗号化
                $client_data = json_encode($clients->get(), JSON_UNESCAPED_UNICODE);
                $client_data = Crypt::encryptString($client_data);

                $clients = $clients->orderBy('clients.id','ASC')->paginate(100);

                 //電話番号-入れる
                 foreach($clients as $client){
                    $client['contractor_contact'] = $method->phone($client['contractor_contact']);
                }

                return view('client/client_all', ['clients' => $clients, 'client_data' => $client_data, 'status_name' => $status_name]);
            }elseif($authorities == "全画面"){
                $clients = $method->column();
                //jsonに変えて暗号化
                $client_data = json_encode($clients->get(), JSON_UNESCAPED_UNICODE);
                $client_data = Crypt::encryptString($client_data);

                $clients = $clients->orderBy('clients.id','ASC')->paginate(100);
                
                //電話番号-入れる
                foreach($clients as $client){
                    $client['contractor_contact'] = $method->phone($client['contractor_contact']);
                }
                return view('client/client_all',['clients' => $clients, 'client_data' => $client_data, 'status_name' => $status_name]);
            }
        }
        return view('front_admin');
    }

    //キーワード検索
    public function filter_search(Request $request)
    {
        $search = $request->search;

        $method = new Client;

        //ログインIDと権限をsessionに保存
        $method->auth();

        //jsonに変えて暗号化
        $client_data = json_decode($request->client_data, true);
        $client_data = Crypt::encryptString($client_data);
        
        $status_name = client_statuse::all();

        $authoritys = session()->get('authoritys');

        $user_login = session()->get('user_login');

        foreach($authoritys as $authorities){
            if($authorities == "リグラント営業"){
                $result = $method->rigurant_Serach($user_login,$search);
                $clients = $result['clients'];

                if($clients->isEmpty()){
                    return redirect()->action('ClientController@all')->with('error_message', '検索された項目は存在しませんでした。');
                }

                //jsonに変えて暗号化
                $client_data = json_encode($clients->get(), JSON_UNESCAPED_UNICODE);
                $client_data = Crypt::encryptString($client_data);

                $clients = $clients->orderBy('clients.id', 'ASC')->paginate(100);

                if($request->sort == '複数検索'){
                    $search_username = $result['search_username'];
                    $clients = $method->scopeSerach($request->client_status_id, $request->action_date, $request->action_note, $request->note);
                    $clients = $clients->where(function($clients) use($search_username){
                        $clients->where('clients.sales_staff', $search_username);
                    });
                    if($clients->isEmpty()){
                        return redirect()->action('ClientController@all')->with('error_message', '検索された項目は存在しませんでした。');
                    }

                    //jsonに変えて暗号化
                    $client_data = json_encode($clients, JSON_UNESCAPED_UNICODE);
                    $client_data = Crypt::encryptString($client_data);

                    return view('client/client_all', ['clients' => $clients, 'client_data' => $client_data, 'status_name' => $status_name]);
                }elseif($request->sort == '昇順'){
                    $method->sort($request,$clients,SORT_ASC);
        
                    return view('client/client_all', ['clients' => $clients, 'client_data' =>$request->client_data, 'status_name' => $status_name]);
                }elseif($request->sort == '降順'){
                    $method->sort($request,$clients,SORT_DESC);
        
                    return view('client/client_all', ['clients' => $clients, 'client_data' =>$request->client_data, 'status_name' => $status_name]);
                }

                return view('client/client_all', ['clients' => $clients, 'client_data' => $client_data, 'status_name' => $status_name]);
            }elseif($authorities == "調査会社"){
                $clients = $method->survey_Serach($user_login,$search);

                //jsonに変えて暗号化
                $client_data = json_encode($clients->get(), JSON_UNESCAPED_UNICODE);
                $client_data = Crypt::encryptString($client_data);
                
                $clients = $clients->orderBy('clients.id', 'ASC')->paginate(100);

                if($clients->isEmpty()){
                    return redirect()->action('ClientController@all')->with('error_message', '検索された項目は存在しませんでした。');
                }

                if($request->sort == '昇順'){
                    $method->sort($request,$clients,SORT_ASC);
        
                    return view('client/client_all', ['clients' => $clients, 'client_data' =>$request->client_data, 'status_name' => $status_name]);
                }elseif($request->sort == '降順'){
                    $method->sort($request,$clients,SORT_DESC);
        
                    return view('client/client_all', ['clients' => $clients, 'client_data' =>$request->client_data, 'status_name' => $status_name]);
                }

                return view('client/client_all', ['clients' => $clients, 'client_data' => $client_data, 'status_name' => $status_name]);
            }elseif($authorities == "全画面"){
                $clients = $method->all_Serach($search);

                //jsonに変えて暗号化
                $client_data = json_encode($clients->get(), JSON_UNESCAPED_UNICODE);
                $client_data = Crypt::encryptString($client_data);
                
                $clients = $clients->orderBy('clients.id', 'ASC')->paginate(100);

                if($clients->isEmpty()){
                    return redirect()->action('ClientController@all')->with('error_message', '検索された項目は存在しませんでした。');
                }

                if($request->sort == '複数検索'){
                    $clients = $method->scopeSerach($request->client_status_id, $request->action_date, $request->action_note, $request->note);

                    if($clients->isEmpty()){
                        return redirect()->action('ClientController@all')->with('error_message', '検索された項目は存在しませんでした。');
                    }

                    //jsonに変えて暗号化
                    $client_data = json_encode($clients, JSON_UNESCAPED_UNICODE);
                    $client_data = Crypt::encryptString($client_data);

                    return view('client/client_all', ['clients' => $clients, 'client_data' => $client_data, 'status_name' => $status_name]);
                }elseif($request->sort == '昇順'){
                    $method->sort($request,$clients,SORT_ASC);
        
                    return view('client/client_all', ['clients' => $clients, 'client_data' =>$request->client_data, 'status_name' => $status_name]);
                }elseif($request->sort == '降順'){
                    $method->sort($request,$clients,SORT_DESC);
        
                    return view('client/client_all', ['clients' => $clients, 'client_data' =>$request->client_data, 'status_name' => $status_name]);
                }

                return view('client/client_all', ['clients' => $clients, 'client_data' => $client_data, 'status_name' => $status_name]);
            }
        }

        return redirect()->action('ClientController@all')->with('error_message', '検索された項目は存在しませんでした。');
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
            $clients = '';
            $clients = Client::find($val['id']);
            $client_member[] = ['ID' => $clients['member']];
            $client_contractor[] = ['氏名' => $clients['contractor']];
            $data = $clients->delete();
        }

        //操作ログ
        $method = new Client;

        $client_member = json_encode($client_member,JSON_UNESCAPED_UNICODE);
        $client_contractor = json_encode($client_contractor,JSON_UNESCAPED_UNICODE);

        $method->log_check_box($client_member,$client_contractor,'削除');

        return response()->json($data);
    }

    //チェックボックス・プルダウン更新
    public function check_edit($value,$status_name,$important_value) {
        sleep(1);

        $method = new Client;

        $id = explode(",",$value);
        $status_id = explode(",",$status_name);
        $important_value = explode(",",$important_value);

        $count =count($id);
        for($i = 0; $i < $count; $i++){
            $box[] = array('id' => $id[$i], 'status_id' => $status_id[$i], 'important_value' => $important_value[$i]);
        }

        foreach($box as $val){
            $clients = '';
            $clients = Client::find($val['id']);
            $client_member[] = ['ID' => $clients['member']];
            $client_contractor[] = ['氏名' => $clients['contractor']];
            if($val['important_value'] == 0){
                $clients['important'] = '☆';
            }else{
                $clients['important'] = '★';
            }
            //ステータス変更ログ
            $client_status_id = $clients['client_status_id'];
            if($client_status_id != $val['status_id']){
                $clients['client_status_add'] = date('Y-m-d');
                $status_before = Client_statuse::find($client_status_id);
                $status_after = Client_statuse::find($val['status_id']);
                $method->log_change_status($val['id'],$status_before['status_number'],$status_before['status_name'],$status_after['status_number'],$status_after['status_name']);

                $first_client = Trader::find($clients['trader_id']);
                $forms = [];
                $forms = ['first_client' => $first_client['trader_name'], 'matter' => $first_client['main_project'], 'status_after' => $status_after['status_number'].'：'.$status_after['status_name'], 'status_before' => $status_before['status_number'].'：'.$status_before['status_name'], 'first_mail' => $first_client['trader_email']];
                $mail = new MailSend;
                $mail->client($forms);
            }
            $clients['client_status_id'] = $val['status_id'];
            $data = $clients->save();
        }

        //操作ログ
        $client_member = json_encode($client_member,JSON_UNESCAPED_UNICODE);
        $client_contractor = json_encode($client_contractor,JSON_UNESCAPED_UNICODE);

        $method->log_check_box($client_member,$client_contractor,'変更');

        return response()->json($data);
    }

    //顧客情報登録画面
    public function create()
    {
        //ログインIDと権限をsessionに保存
        $method = new Client;
        $method->auth();

        $status = Client_statuse::all();
        $surveie = Surveie::all();
        $trader = Trader::select('id','trader_name')->get();

        return view('client/client_create',["status" => $status, "surveie" => $surveie, "trader" => $trader]);
    }

    //顧客情報登録確認
    public function create_check(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Client;
        $method->auth();

        //新規登録バリデーション
        $method->create_validation($request);

        $clients = $request->all();
        //取次店名前取得
        $trader_name = '';
        if(is_numeric($clients['advertising'])){
            $trader_name = Trader::select('trader_name')->find($clients['advertising']);
        }
        //選択が空の時の対応
        if($clients['survey_name'] == ''){
            $survey_id = ['id' => 1];
        }else{
            $survey_id = Surveie::where('survey_name', $clients['survey_name'])->select('id')->first();
        };
        //選択が空の時の対応
        if($clients['status_name'] == ''){
            $client_status_id = Client_statuse::find(1);
        }else{
            $client_status_id = Client_statuse::where('status_name', $clients['status_name'])->first();
        };

        //入金額の計算
        $payment_money = (int)$clients['certification_money'] * (int)$clients['client_fee'] / 100;
        $payment_money = (int)floor($payment_money);

        if((int)$clients['quotation_money'] == 0){
            $certification_money_probability = 0;
        }else{
            //見積額の認定率
            $certification_money_probability = (int)$clients['certification_money'] / (int)$clients['quotation_money'] * 100;
            $certification_money_probability = (int)floor($certification_money_probability);
        }

        //取次店支払額
        $trader_payment_money = $payment_money * (int)$clients['trader_referral'] / 100;
        $trader_payment_money = (int)floor($trader_payment_money);

        //調査会社支払額
        $pay = $payment_money - $trader_payment_money;
        $survey_payment_money = $pay * (int)$clients['survey_referral'] / 100;
        $survey_payment_money = (int)floor($survey_payment_money);

        //利益額
        $profit_money = $payment_money - $trader_payment_money - $survey_payment_money;

        $method = new Client;
        //電話番号 - 入れる
        $contractor_contact = $method->phone($clients['contractor_contact']);

        //ログインID
        $user_login = session()->get('user_login');
        $user_id = User::where('login', $user_login)->select('id')->first();

        return view('client/client_create_check',['clients' => $clients, "trader_name" => $trader_name, "survey_id" => $survey_id, "client_status_id" => $client_status_id, "payment_money" => $payment_money, "certification_money_probability" => $certification_money_probability, "trader_payment_money" => $trader_payment_money, "survey_payment_money" => $survey_payment_money, "profit_money" => $profit_money, "contractor_contact" => $contractor_contact, 'user_id' => $user_id]);
    }

    //顧客情報登録処理
    public function create_add(Request $request)
    {
        try {
            $method = new Client;

            //新規登録バリデーション
            $method->create_validation($request);

            $form = $request->all();
            unset($form['_token']);

            $clients = new Client;
            $clients->fill($form);
            $clients['submit_date'] = date('Y-m-d');

            //新規登録の際、取次店に情報がなければ登録する
            $client_contractor = $clients['contractor'];
            $client_address = $clients['address'];
            $client_contractor_contact = $clients['contractor_contact'];
            //取次店名前取得
            $client_trader_id = '';
            if(is_numeric($clients['advertising'])){
                $client_trader_id = Trader::select('id')->find($clients['advertising']);
                $client_trader_id = $client_trader_id['id'];
            }
            $client_trader = $method->trader_and_where($client_contractor, $client_address, $client_contractor_contact, $client_trader_id);

            if($client_trader['trader_id']){
                $clients['trader_id'] = $client_trader['trader_id']['id'];
            }else{
                $clients['trader_id'] = $client_trader['client_trader_id'];
            }
            $clients->save();
            //報酬・詳細一覧に登録
            $reward = Reward::find($clients['id']);
            if($reward){
                $reward['client_id'] = $clients['id'];
                $reward->save();
            }else{
                $reward_new = new Reward;
                $reward_new['client_id'] = $clients['id'];
                $reward_new->save();
            }

            //操作ログ
            $method = new Client;
            $method->log_all((int)$form['member'],$form['contractor'],'新規登録');

            return redirect('client/all')->with('success_message', '登録に成功しました。');
        } catch (\Exception $e) {
            return redirect()->action('ClientController@create')->with('error_message', '顧客登録に失敗しました。再度お試しください。');
        }
    }

    //ステータス変更画面
    public function client_status_all(Request $request)
    {
        $method = new Client;

        //ログインIDと権限をsessionに保存
        $method->auth();

        $client_statuses = Client_statuse::all()->sortby('id');
        
        return view('client/client_status_all',['statuses' => $client_statuses]);
    }

    //ステータス新規登録
    public function client_status_add(Request $request)
    {
        $request->validate([
            'status_number'=> ['required', 'regex:/^[0-9]+$/i', 'unique:client_statuses'],
            'status_name'=> ['required', 'unique:client_statuses']
        ]);

        $form = $request->all();
        unset($form['_token']);
        
        $client_statuses = new Client_statuse;
        $client_statuses->fill($form);
        
        $client_statuses->save();

        //操作ログ
        $method = new Client;
        $method->log_status((int)$form['status_number'],$form['status_name'],'新規登録');

        return redirect('client/status_all')->with('message', '新規登録に成功しました。');
    }

    //ステータス変更
    public function client_status_update(Request $request)
    {
        $status = Client_statuse::where('id',$request->id)->first();

        $request->validate([
            'status_number'=> ['required', 'regex:/^[0-9]+$/i', Rule::unique('client_statuses')->ignore($status)],
            'status_name'=> ['required',Rule::unique('client_statuses')->ignore($status)],
        ]);

        $client_statuses = Client_statuse::find($request->id);

        $form = $request->all();
        unset($form['_token']);
        
        $client_statuses->fill($form);
        $client_statuses->save();

        //操作ログ
        $method = new Client;
        $method->log_status((int)$form['status_number'],$form['status_name'],'変更');

        return redirect('client/status_all')->with('message', '変更に成功しました。');
    }

    //ステータス削除
    public function client_status_delete(Request $request)
    {
        $statuses = Client_statuse::find($request->id);

        //操作ログ
        $method = new Client;
        $method->log_status((int)$statuses['status_number'],$statuses['status_name'],'削除');

        $statuses->delete();
        
        return redirect('client/status_all')->with('message', '削除に成功しました。');
    }

    //顧客情報詳細
    public function detail(Request $request)
    {
        $method = new Client;

        //ログインIDと権限をsessionに保存
        $method->auth();

        $clients = $method->column()
        ->find($request->id);

        unset($clients['_token']);

        //電話番号-入れる
        $clients["contractor_contact"] = $method->phone($clients["contractor_contact"]);

        return view('client/client_detail', ['clients' => $clients]);
    }

    //顧客情報編集画面
    public function edit(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Client;
        $method->auth();

        $clients = $method->column()
        ->addselect(
            //保険証券 ID
            'clients.client_insurance_policy_id',
            //合意書 ID
            'clients.client_agreement_id',
            //報告書 ID
            'clients.client_report_id',
            //見積書 ID
            'clients.client_quotation_id',
            //認定書 ID
            'clients.client_certification_id',
            //その他 ID
            'clients.client_drawing_id'
        )
        ->find($request->id);

        $survey_corps = Surveie::all();
        $status_name = Client_statuse::all();

        return view('client/client_edit', ['clients' => $clients,'survey_corps' => $survey_corps,'status_name' => $status_name]);
    }

    //顧客情報編集確認
    public function edit_check(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Client;
        $method->auth();

        //編集バリデーション
        $method->edit_validation($request->id,$request);

        //画像のパス
        $drawing_read_path = $method->document_path('drawing',$request);

        $agreement_read_path = $method->document_path('agreement',$request);

        $insurance_policy_read_path = $method->document_path('insurance_policy',$request);

        $report_read_path = $method->document_path('report',$request);

        $quotation_read_path = $method->document_path('quotation',$request);

        $certification_read_path = $method->document_path('certification',$request);

        $clients = $request->all();

        //電話番号 - 入れる
        $contractor_contact = $method->phone($clients['contractor_contact']);

        //入金額計算
        $payment_money = (int)$clients['certification_money'] * (int)$clients['client_fee'] / 100;
        $payment_money = floor($payment_money);

        if((int)$clients['quotation_money'] == 0){
            $certification_money_probability = 0;
        }else{
            //見積額の認定率
            $certification_money_probability = (int)$clients['certification_money'] / (int)$clients['quotation_money'] * 100;
            $certification_money_probability = (int)floor($certification_money_probability);
        }

        //取次店支払額
        $trader_payment_money = $payment_money * (int)$clients['trader_referral'] / 100;
        $trader_payment_money = (int)floor($trader_payment_money);

        //調査会社支払額
        $pay = $payment_money - $trader_payment_money;
        $survey_payment_money = $pay * (int)$clients['survey_referral'] / 100;
        $survey_payment_money = (int)floor($survey_payment_money);

        //利益額
        $profit_money = $payment_money - $trader_payment_money - $survey_payment_money;

        $survey_id = Surveie::where('survey_name', $clients['survey_name'])->select('id')->first();

        $status_id = Client_statuse::where('status_name',$clients['status_name'])->select('id', 'status_number')->first();

        return view('client/client_edit_check', ['clients' => $clients, "contractor_contact" => $contractor_contact, "payment_money" => $payment_money, "certification_money_probability" => $certification_money_probability, "trader_payment_money" => $trader_payment_money, "survey_payment_money" => $survey_payment_money, "profit_money" => $profit_money, "survey_id" => $survey_id, "status_id" => $status_id, 'insurance_policy_read_path' => $insurance_policy_read_path, 'drawing_read_path' => $drawing_read_path, 'agreement_read_path' => $agreement_read_path, 'report_read_path' => $report_read_path,  'quotation_read_path' => $quotation_read_path, 'certification_read_path' => $certification_read_path]);
    }

    //顧客情報編集処理
    public function update(Request $request)
    {
        try {
            $method = new Client;

            //編集バリデーション
            $method->edit_validation($request->id,$request);

            $clients = Client::find($request->id);

            $form = $request->all();
            unset($form['_token']);

            $method = new Client;

            //画像の有/無で保存方法を変える
            $method->document_exist($clients,'App\Models\Client_drawing',$form,'drawing');
            if($form['client_drawing_id'] == '1'){
                $id = Client_drawing::orderby('id', 'desc')->select('id')->first();
                $form['client_drawing_id'] = $id['id'];
            }

            $method->document_exist($clients,'App\Models\Client_agreement',$form,'agreement');
            if($form['client_agreement_id'] == '1'){
                $id = Client_agreement::orderby('id', 'desc')->select('id')->first();
                $form['client_agreement_id'] = $id['id'];
            }

            $method->document_exist($clients,'App\Models\Client_insurance_policie',$form,'insurance_policy');
            if($form['client_insurance_policy_id'] == '1'){
                $id = Client_insurance_policie::orderby('id', 'desc')->select('id')->first();
                $form['client_insurance_policy_id'] = $id['id'];
            }

            $method->document_exist($clients,'App\Models\Client_report',$form,'report');
            if($form['client_report_id'] == '1'){
                $id = Client_report::orderby('id', 'desc')->select('id')->first();
                $form['client_report_id'] = $id['id'];
            }

            $method->document_exist($clients,'App\Models\Client_quotation',$form,'quotation');
            if($form['client_quotation_id'] == '1'){
                $id = Client_quotation::orderby('id', 'desc')->select('id')->first();
                $form['client_quotation_id'] = $id['id'];
            }

            $method->document_exist($clients,'App\Models\Client_certification',$form,'certification');
            if($form['client_certification_id'] == '1'){
                $id = Client_certification::orderby('id', 'desc')->select('id')->first();
                $form['client_certification_id'] = $id['id'];
            }

            $clients_status = $clients['client_status_id'];
            $clients->fill($form);
            //ステータス変更ログ
            if($clients_status != $form['client_status_id']){
                $clients['client_status_add'] = date('Y-m-d');
            }
            $clients->save();

            //操作ログ
            $method->log_all((int)$form['member'],$form['contractor'],'編集');

            //ステータス変更でメールを送信
            if($clients_status != $form['client_status_id']){
                $status_before = Client_statuse::find($clients_status);
                $status_after = Client_statuse::find($form['client_status_id']);
                $method->log_change_status($request->id,$status_before['status_number'],$status_before['status_name'],$status_after['status_number'],$status_after['status_name']);

                $first_client = Trader::find($clients['trader_id']);

                return redirect()->action('MailSendController@status_send', ['form' => '個人','first_client' => $first_client['trader_name'], 'matter' => $first_client['main_project'], 'status_after' => $status_after['status_number'].'：'.$status_after['status_name'], 'status_before' => $status_before['status_number'].'：'.$status_before['status_name'], 'first_mail' => $first_client['trader_email']]);
            }

            return redirect('client/all')->with('success_message', '更新に成功しました。');
        } catch (\Exception $e) {
            return redirect()->action('ClientController@edit', ['id' => $request->id])->with('error_message', '更新に失敗しました。再度お試しください。');
        }
    }

    //顧客情報削除
    public function delete(Request $request)
    {
        try {
            $clients = Client::find($request->id);
            $clients->delete();

            return redirect('client/all')->with('success_message', '削除に成功しました。');
        } catch (\Exception $e) {
            $clients = Client::find($request->id);
            return redirect()->action('ClientController@edit', ['id' => $request->id])->with('error_message', '削除に失敗しました。再度お試しください。');
        }
    }

    /*顧客一覧→該当案件
    public function matter(Request $request)
    {

        $matters = Matter::all()->sortBy('id');

        if ($matters->isEmpty()) {
            $corp_name  = '';
            $trader_name = '';
            return view('client/client_matter', ['matters' => $matters, 'corp_name' => $corp_name, 'trader_name' => $trader_name]);
        }

        $matters = '';

        $matters = Matter::select(
            'matters.id',
            'matters.member_id',
            'matters.application_status',
            'matters.contractor',
            'matters.responder',
            'matters.contractor_contact',
            'matters.responder_contact',
            'matters.other_contact',
            'matters.email',
            'matters.zipcode',
            'matters.prefectures',
            'matters.city',
            'matters.town_area',
            'matters.buildingname_roomnumber',
            'statuses.status_name',
            'matters.survey',
            'matters.trader',
            'traders.trader_name',
            'survey_corps.corp_name'
        )
            ->where('contractor_contact', $request->contractor_contact)
            ->join('statuses', 'matters.status', '=', 'statuses.id')
            ->leftJoin('traders', 'matters.trader', '=', 'traders.id')
            ->leftjoin('survey_corps', 'matters.survey', '=', 'survey_corps.id')
            ->orderBy('matters.id', 'ASC')
            ->paginate(100);

        $status = Status::all();

        $corp_name = Surveie::all();

        $trader_name = Trader::all();

        return view('client/client_matter', ['matters' => $matters, 'corp_name' => $corp_name, 'trader_name' => $trader_name]);
    }
    */

    public function csv_import_view()
    {
        //ログインIDと権限をsessionに保存
        $method = new Client;
        $method->auth();

        return view('client/csv_import');
    }


    public function csv_import_check(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Client;
        $method->auth();

        $user_login = session()->get('user_login');
        $user_id = User::where('login', $user_login)->select('id')->first();

        $file_path = $request->file('csv')->path();            //CSV読み込み
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
            if(count($data) > 41){
                return redirect('client/csv_import')->with('message', '項目数が合っていません');
            }

            if ($row_count > 1) {
                $data = mb_convert_encoding($data,'UTF-8','SJIS');        //文字コードをUTF-8に変換
                $values[$i]['submit_date'] = date('Y-m-d');
                $values[$i]['advertising'] = $data[1];
                $values[$i]['member'] = $data[2];
                $values[$i]['contractor'] = $data[3];
                $values[$i]['address'] = $data[4];
                $values[$i]['buildingname'] = $data[5];
                $values[$i]['contractor_contact'] = $data[6];
                $values[$i]['mail_address'] = $data[7];
                $values[$i]['fire_insurance_flg'] = $data[8];
                $values[$i]['insurance_company'] = $data[9];
                $values[$i]['building_age'] = $data[10];
                $values[$i]['earthquake_flg'] = $data[11];
                $values[$i]['status_name'] = $data[12];
                $values[$i]['action_date'] = $data[13];
                $values[$i]['action_note'] = $data[14];
                $values[$i]['note'] = $data[15];
                $values[$i]['payment_predict_date'] = $data[16];
                $values[$i]['payment_expecte'] = $data[17];
                $values[$i]['sales_staff'] = $data[18];
                $values[$i]['survey_name'] = $data[19];
                $values[$i]['survey_staff'] = $data[20];
                $values[$i]['request_date'] = $data[21];
                $values[$i]['scheduled_survey_date'] = $data[22];
                $values[$i]['survey_date'] = $data[23];
                $values[$i]['agreement_date'] = $data[24];
                $values[$i]['accident_date'] = $data[25];
                $values[$i]['insurance_policy_date'] = $data[26];
                $values[$i]['certification_date'] = $data[27];
                $values[$i]['bill_issue_date'] = $data[28];
                $values[$i]['payment_date'] = $data[29];
                $values[$i]['quo_card_date'] = $data[30];
                $values[$i]['quotation_money'] = $data[31];
                $values[$i]['certification_money'] = $data[32];
                $values[$i]['certification_money_probability'] = $data[33];
                $values[$i]['client_fee'] = $data[34];
                $values[$i]['payment_money'] = $data[35];
                $values[$i]['survey_referral'] = $data[36];
                $values[$i]['survey_payment_money'] = $data[37];
                $values[$i]['trader_referral'] = $data[38];
                $values[$i]['trader_payment_money'] = $data[39];
                $values[$i]['profit_money'] = $data[40];
                //importした人のid
                $values[$i]['user_id'] = $user_id['id'];
            }
            $row_count++;
            $i++;
        }

        return view('client/csv_import_check', ['values' => $values]);
    }

    public function csv_import_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            //バリデーションルールの記入
            'values.*.survey_name' => ['required','exists:surveies,survey_name'],
            'values.*.member' => ['required', 'max:10', 'unique:clients,member'],
            'values.*.contractor' => ['required'],
            'values.*.address' => ['required'],
            'values.*.contractor_contact' => ['required', 'unique:traders,trader_phone']
        ]);

        if ($validator->fails()) {
            return redirect('client/csv_import')->withErrors($validator)->withInput();
            //エラー時の処理
        }

        $datas = $request->all();
        unset($datas['_token']);

        $survey = Surveie::all();
        $status = Client_statuse::select('id','status_name')->get();

        $i = 0;

        foreach ($datas as $key => $data) {
            for($i; $i<count($data); $i++){

                $clients = new Client;

                foreach($survey as $surveys){
                    if($surveys['survey_name'] == $data[$i]['survey_name']){
                        $survey_id = $surveys['id'];
                    }else{
                        $survey_id = '1';
                    }
                }

                foreach($status as $statuses){
                    if($statuses['status_name'] == $data[$i]['status_name']){
                        $status_id = $statuses['id'];
                    }else{
                        $status_id = '1';
                    }
                }

                $clients['important'] = '☆';
                $clients['caution'] = '△';
                $clients['submit_date'] = $data[$i]['submit_date'];
                $clients['advertising'] = $data[$i]['advertising'];
                $clients['member'] = $data[$i]['member'];
                $clients['contractor'] = $data[$i]['contractor'];
                $clients['address'] = $data[$i]['address'];
                $clients['buildingname'] = $data[$i]['buildingname'];
                $clients['contractor_contact'] = $data[$i]['contractor_contact'];
                $clients['mail_address'] = $data[$i]['mail_address'];
                $clients['fire_insurance_flg'] = $data[$i]['fire_insurance_flg'];
                $clients['insurance_company'] = $data[$i]['insurance_company'];
                $clients['building_age'] = $data[$i]['building_age'];
                if($data[$i]['earthquake_flg'] == '無'){
                    $clients['earthquake_flg'] = 0;
                }else{
                    $clients['earthquake_flg'] = 1;
                }
                $clients['client_status_id'] = $status_id;
                $clients['action_date'] = $data[$i]['action_date'];
                $clients['action_note'] = $data[$i]['action_note'];
                $clients['note'] = $data[$i]['note'];
                $clients['payment_predict_date'] = $data[$i]['payment_predict_date'];
                $clients['payment_expecte'] = $data[$i]['payment_expecte'];
                $clients['sales_staff'] = $data[$i]['sales_staff'];
                $clients['survey_id'] = $survey_id;
                $clients['survey_staff'] = $data[$i]['survey_staff'];
                $clients['request_date'] = $data[$i]['request_date'];
                $clients['scheduled_survey_date'] = $data[$i]['scheduled_survey_date'];
                $clients['survey_date'] = $data[$i]['survey_date'];
                $clients['agreement_date'] = $data[$i]['agreement_date'];
                $clients['accident_date'] = $data[$i]['accident_date'];
                $clients['insurance_policy_date'] = $data[$i]['insurance_policy_date'];
                $clients['certification_date'] = $data[$i]['certification_date'];
                $clients['bill_issue_date'] = $data[$i]['bill_issue_date'];
                $clients['payment_date'] = $data[$i]['payment_date'];
                $clients['quo_card_date'] = $data[$i]['quo_card_date'];
                $clients['quotation_money'] = $data[$i]['quotation_money'];
                $clients['certification_money'] = $data[$i]['certification_money'];
                $clients['certification_money_probability'] = $data[$i]['certification_money_probability'];
                $clients['client_fee'] = $data[$i]['client_fee'];
                $clients['payment_money'] = $data[$i]['payment_money'];
                $clients['survey_referral'] = $data[$i]['survey_referral'];
                $clients['survey_payment_money'] = $data[$i]['survey_payment_money'];
                $clients['trader_referral'] = $data[$i]['trader_referral'];
                $clients['trader_payment_money'] = $data[$i]['trader_payment_money'];
                $clients['profit_money'] = $data[$i]['profit_money'];
                //資料
                $clients['client_insurance_policy_id'] = 1;
                $clients['client_agreement_id'] = 1;
                $clients['client_report_id'] = 1;
                $clients['client_quotation_id'] = 1;
                $clients['client_certification_id'] = 1;
                $clients['client_drawing_id'] = 1;
                //importした人のid
                $clients['user_id'] = $data[$i]['user_id'];

                //新規登録の際、取次店に情報がなければ登録する
                $client_contractor = $clients['contractor'];
                $client_address = $clients['address'];
                $client_contractor_contact = $clients['contractor_contact'];
                $client_trader_id = '';
                $client_trader = $clients->trader_and_where($client_contractor, $client_address, $client_contractor_contact, $client_trader_id);
                if($client_trader['trader_id']){
                    $clients['trader_id'] = $client_trader['trader_id']['id'];
                }else{
                    $clients['trader_id'] = $client_trader['client_trader_id'];
                }

                $clients->save();   //clientsテーブルに保存
                //報酬・詳細一覧に登録
                $reward = Reward::find($clients['id']);
                if($reward){
                    $reward['client_id'] = $clients['id'];
                    $reward->save();
                }else{
                    $reward_new = new Reward;
                    $reward_new['client_id'] = $clients['id'];
                    $reward_new->save();
                }
            }
        }
        //操作ログ
        $method = new Client;
        $method->log_port('インポート');

        return redirect('client/csv_import')->with('message', 'インポートに成功しました。');
    }
    
    public function export_csv()
    {
        //操作ログ
        $method = new Client;
        $method->log_port('エクスポート');

        return response()->streamDownload(
            function () {
                // 出力バッファをopen
                $stream = fopen('php://output', 'w');
                // 文字コードをShift-JISに変換
                stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');
                $method = new Client;
                //ヘッダー要素
                $header = $method->head_name();
                // ヘッダー
                fputcsv($stream, $header);
                // データ
                foreach ($method->column()->cursor() as $client) {
                    if($client->earthquake_flg == '0'){
                        $client->earthquake_flg = '無';
                    }else{
                        $client->earthquake_flg = '有';
                    }
                    fputcsv($stream, $method->stream($client));
                }
                fclose($stream);
            },
            '個人顧客一覧.csv',
            [
                'Content-Type' => 'text/csv'
            ]
        );
    }
    
    //チェックボックス・プルダウン更新
    public function questionnaire_check_edit($value, $questionnaire_target)
    {
        $id = explode(",", $value);

        foreach ($id as $val) {

            $clients = '';

            $clients = Client::find($val);

            $clients->fill(['questionnaire' => $questionnaire_target]);

            $data = $clients->save();
        }
        return response()->json($data);
    }

}
