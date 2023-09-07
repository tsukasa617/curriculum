<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Trader;
use App\Models\Client;
use App\Models\Matter;
use App\Models\User;
use App\Models\Trader_contract_conclusion;
use App\Models\Client_statuse;
use App\Models\Matter_statuse;
use DateTime;
use App\Models\Reward;
use App\Mail\MailSend;

use Symfony\Component\HttpFoundation\StreamedResponse;
use SplFileObject;

class TraderController extends Controller
{
    //取次店一覧画面
    public function all() {

        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();

        $traders = $method->column()->paginate(100);

        //紹介者
        $introducers = Trader::select('id', 'trader_name')->get();
        $introducer_name = [];
        foreach($introducers as $introducer){
            $introducer_name[$introducer['id']] = $introducer['trader_name'];
        }

            //電話番号-入れる
            foreach($traders as $trader){
                $trader['trader_phone'] = $method->phone($trader['trader_phone']);
                $trader['trader_phone_2'] = $method->phone($trader['trader_phone_2']);
            }

        return view('trader/trader_all',['traders' => $traders, 'introducer_name' => $introducer_name]);
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
            $traders = '';
            $traders = Trader::find($val['id']);
            $trader_id[] = ['No' => $traders['id']];
            $trader_trader_name[] = ['取次店' => $traders['trader_name']];
            $data = $traders->delete();
        }

        //操作ログ
        $method = new Trader;

        $trader_id = json_encode($trader_id,JSON_UNESCAPED_UNICODE);
        $trader_trader_name = json_encode($trader_trader_name,JSON_UNESCAPED_UNICODE);

        $method->log_check_box($trader_id,$trader_trader_name,'削除');

        return response()->json($data);
    }


    public function create() {

        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();

        $traders = Trader::select('id','trader_name')->get();

        return view('trader/trader_create', ['traders' => $traders]);
    }

    public function create_check(Request $request) {

        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();

        if($request->trader_phone_2 == null){
            $request['trader_phone_2'] = 0;
        }
        if($request->bank_acount_number == null){
            $request['bank_acount_number'] = '000000';
        }

        //バリデーション
        $request->validate([
            'trader_phone'=>['unique:traders'],
        ]);

        $method->validation($request);

        $traders = $request->all();

        if($traders['introducer'] == '0'){
            $introducer_name = [];
            $introducer_name['trader_name'] = '紹介者無し';
        }else{
            $introducer_name = Trader::find($traders['introducer']);
        }

        //電話番号を-で区切る
        $trader_phone = $method->phone($request['trader_phone']);
        $trader_phone_2 = $method->phone($request['trader_phone_2']);

        return view('trader/trader_create_check', ['traders' => $traders, 'introducer_name' => $introducer_name, 'trader_phone' => $trader_phone, 'trader_phone_2' => $trader_phone_2]);
    }

    public function add(Request $request) {
        try {
            $traders = new Trader;
            $trader_contract_conclusion = new Trader_contract_conclusion;
            $trader_contract_conclusion_form = [ 'image_title' => '契約書', 'image_path' => 'NULL' ];
            $trader_contract_conclusion->fill($trader_contract_conclusion_form);
            $trader_contract_conclusion->save();

            //バリデーション
            $request->validate([
                'trader_phone'=>['unique:traders'],
            ]);
            $traders->validation($request);

            $trader_form = $request->all();
            unset($trader_form['_token']);
            $trader_contract_conclusion_id = Trader_contract_conclusion::orderby('id','desc')->select('id')->first();
            $trader_form['trader_contract_conclusion_id'] = $trader_contract_conclusion_id['id'];

            $traders->fill($trader_form);
            $traders->save();

            $id = Trader::orderby('id','desc')->select('id')->first();

            //操作ログ
            $traders->log_all((int)$id['id'],$trader_form['trader_name'],'新規登録');
            
            return redirect('trader/all')->with('success_message', '登録に成功しました。');
        } catch (\Exception $e) {
            return redirect('trader/all')->with('error_message', '登録に失敗しました。再度お試しください。');
        }
    }

    public function detail(Request $request) {
        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();

        $traders = Trader::find($request->id);
        $req = $method->detail_request($request);

        $client_payment_money = $req['client_payment_money'];
        $matter_payment_money_1 = $req['matter_payment_money_1'];
        $matter_payment_money_2 = $req['matter_payment_money_2'];
        $matter_payment_money_3 = $req['matter_payment_money_3'];

        $matters = Matter::select(DB::raw('DATE_FORMAT(payment_date,"%Y%m") AS date'),'trader_id','agency_store_2','agency_store_3','payment_money','referral_rate','referral_rate_2','referral_rate_3')
        ->where('trader_id',$request->id)
        ->orwhere('agency_store_2',$request->id)
        ->orwhere('agency_store_3',$request->id)
        ->orderby('date', 'desc')
        ->get()
        ->groupBy('date')
        ->first();

        $payment_money = 0;

        $day = new DateTime();
        $day = $day->format('Ym');
        $payment_month = (int)substr($day, 4);
        if($payment_month == 12){
            $payment_month = 1;
        }else{
            $payment_month = $payment_month + 1;
        }

        if(isset($matters)){
            foreach($matters as $matter){
                if($matter['date'] == $day){
                    switch($request->id){
                        case $matter['trader_id']:
                            $payment_money += (int)$matter['payment_money'] * (int)$matter['referral_rate'] / 100;
                            break;
                        case $matter['agency_store_2']:
                            $payment_money += (int)$matter['payment_money'] * (int)$matter['referral_rate_2'] / 100;
                            break;
                        case $matter['agency_store_3']:
                            $payment_money += (int)$matter['payment_money'] * (int)$matter['referral_rate_3'] / 100;
                            break;
                        default:
                            break;
                    }
                }
            }
        }

        return view('trader/trader_detail',['traders' => $traders, 'client_payment_money' => $client_payment_money, 'matter_payment_money_1' => $matter_payment_money_1, 'matter_payment_money_2' => $matter_payment_money_2, 'matter_payment_money_3' => $matter_payment_money_3,'payment_month' => $payment_month, 'payment_money' => $payment_money]);
    }

    //編集
    public function edit(Request $request) {

        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();

        $traders = Trader::find($request->id);
        $trader_contract_conclusion = Trader_contract_conclusion::where('id', $traders['trader_contract_conclusion_id'])->select('image_title','image_path')->first();

        //紹介者
        $introducers = Trader::select('id', 'trader_name')->get();
        $introducer_name = [];
        foreach($introducers as $introducer){
            $introducer_name[$introducer['id']] = $introducer['trader_name'];
        }

        return view('trader/trader_edit',['traders' => $traders, 'trader_contract_conclusion' => $trader_contract_conclusion, 'introducers' => $introducers, 'introducer_name' => $introducer_name]);
    }

    public function edit_check(Request $request) {

        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();

        if($request->trader_phone_2 == null){
            $request['trader_phone_2'] = 0;
        }
        if($request->bank_acount_number == null){
            $request['bank_acount_number'] = '000000';
        }

        $auths = session()->get('authoritys');
        foreach($auths as $auth){
            if($auth == "全画面"){
                //バリデーション
                $method->validation($request);

                $traders = $request->all();

                if($traders['introducer'] == '0'){
                    $introducer_name = [];
                    $introducer_name['trader_name'] = '紹介者無し';
                }else{
                    $introducer_name = Trader::find($traders['introducer']);
                }

                if($request->image_path == "0" || $request->image_path == null){
                    $image_path = $request->before_image_path;
                }else{
                    $request->validate([
                        'image_path'=>'file|mimes:jpeg,png,jpg,bmb,pdf|max:2048',
                    ]);
                    $imagefile = $request->file('image_path');
                    $imagefilename = $imagefile->getClientOriginalName();


                    //画像を保存するパスは"public/image/xxx.jpg"
                    $imagepath = $imagefile->storeAs('public/image',$imagefilename);
                    //商品一覧画面から画像を読み込むときのパスはstorage/image/xxx.jpg"
                    $image_path = str_replace('public/', 'storage/', $imagepath);
                };

                return view('trader/trader_edit_check',['traders' => $traders, 'introducer_name' => $introducer_name, 'image_path' => $image_path]);
            }
        }

        $request->validate([
            'trader_name'=>'required',
        ]);

        $traders = $request->all();

        return view('trader/trader_edit_check',['traders' => $traders]);
    }

    //編集登録
    public function update(Request $request) {

        try {
            $trader = Trader::find($request->id);
            $trader_name = $trader['trader_name'];
            $trader_phone = $trader['trader_phone'];
            $trader_contract_conclusion_id = $trader['trader_contract_conclusion_id'];
    
            if($request->trader_name !== $trader_name){
                $request->validate([
                    'trader_name'=>['required','max:100','unique:traders'],
                ]);
            }

            if($request->trader_phone !== $trader_phone){
                $request->validate([
                    'trader_phone'=>['unique:traders'],
                ]);
            }

            //バリデーション
            $method = new Trader;
            $method->validation($request);

            $trader_form = $request->all();
            unset($trader_form['_token']);

            $trader->fill($trader_form);
            $trader->save();

            //画像パス保存
            Trader_contract_conclusion::where('id',$trader_contract_conclusion_id)->update(['image_path' => $request->image_path]);
            Trader_contract_conclusion::where('id',$trader_contract_conclusion_id)->update(['image_title' => $request->image_title]);

            //操作ログ
            $method = new Trader;
            $method->log_all((int)$trader_form['id'],$trader_form['trader_name'],'編集');

            return redirect('trader/all')->with('success_message', '更新に成功しました');
        } catch (\Exception $e) {
            return redirect()->action('TraderController@edit', ['id' => $request->id])->with('error_message', '更新に失敗しました。再度お試しください。');
        }
    }

    //削除
    public function delete(Request $request) {
        $traders = Trader::find($request->id);

        //操作ログ
        $method = new Trader;
        $method->log_all((int)$traders['id'],$traders['trader_name'],'削除');

        $traders->delete();

        return redirect('trader/all')->with('success_message', '削除に成功しました。');
    }
    
    /*
    //担当案件
    public function Responsible(Request $request) {

        $trader = $request->id;
    
        $matters = Matter::where('trader',$trader)->get();

        if($matters->isEmpty()){
            return redirect('trader/all');
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
            'survey_corps.corp_name')
            ->where('matters.trader',$trader)
            ->join('statuses', 'matters.status', '=', 'statuses.id')
            ->leftJoin('traders','matters.trader','=','traders.id')
            ->leftjoin('survey_corps','matters.survey','=','survey_corps.id')
            ->orderBy('matters.id','ASC')
            ->paginate(100);
        
        $status = Status::all();

        $corp_name = SurveyCorp::all();

        $trader_name = Trader::all();

        return view('matter/matter_all',['matters' => $matters, 'corp_name' => $corp_name, 'trader_name' => $trader_name]);
    }
    */

    //キーワード検索
    public function filter_search(Request $request) {
        $search = $request->search;

        $method = new Trader;
        //ログインIDと権限をsessionに保存
        $method->auth();

        $authoritys = session()->get('authoritys');

        $user_login = session()->get('user_login');

        foreach($authoritys as $authorities){
            if($authorities == "調査会社"){
                $search_survey = User::where('login', $user_login)->select('survey_id')->first();
                $search_survey_id = $search_survey['survey_id'];
                $trader_column = $method->column();

                //調査会社かつカラムの検索


                $traders = $trader_column->where(function($trader_column) use($search){
                    $trader_column->where('introducer', 'LIKE', '%'.$search.'%')
                    ->orWhere('trader_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('affiliated_company', 'LIKE', '%'.$search.'%')
                    ->orWhere('position', 'LIKE', '%'.$search.'%');
                });

                $traders = $traders->orderBy('traders.id', 'ASC')->paginate(100);

                if($traders->isEmpty()){
                    return redirect()->action('TraderController@all')->with('error_message', '検索された項目は存在しませんでした。');
                }

                return view('trader/trader_all',['traders' => $traders]);
            }elseif($authorities == "全画面") {
                $traders = $method->column()
                ->where('introducer', 'LIKE', '%'.$search.'%')
                ->orWhere('trader_name', 'LIKE', '%'.$search.'%')
                ->orWhere('trader_email', 'LIKE', '%'.$search.'%')
                ->orWhere('affiliated_company', 'LIKE', '%'.$search.'%')
                ->orWhere('position', 'LIKE', '%'.$search.'%')
                ->orWhere('affiliated_company', 'LIKE', '%'.$search.'%')
                ->orWhere('trader_zipcode', 'LIKE', '%'.$search.'%')
                ->orWhere('trader_address', 'LIKE', '%'.$search.'%')
                ->orWhere('trader_phone', 'LIKE', '%'.$search.'%')
                ->orWhere('trader_phone_2', 'LIKE', '%'.$search.'%')
                ->orWhere('contract_sending_date', 'LIKE', '%'.$search.'%')
                ->orWhere('contract_conclusion_date', 'LIKE', '%'.$search.'%')
                ->orWhere('main_project', 'LIKE', '%'.$search.'%')
                ->orWhere('image_title', 'LIKE', '%'.$search.'%')
                ->orWhere('trader_note', 'LIKE', '%'.$search.'%')
                ->paginate(100);

                if($traders->isEmpty()){
                    return redirect()->action('TraderController@all')->with('error_message', '検索された項目は存在しませんでした。');
                }

                return view('trader/trader_all',['traders' => $traders]);
            }
        }

        return redirect()->action('TraderController@all')->with('error_message', '検索された項目は存在しませんでした。');
    }

    public function export_csv(Request $request){

        //操作ログ
        $method = new Trader;
        $method->log_port('エクスポート');

        return response()->streamDownload(
            function () {
                // 出力バッファをopen
                $stream = fopen('php://output', 'w');
                // 文字コードをShift-JISに変換
                stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');
                // ヘッダー
                fputcsv($stream, [
                    'No',
                    '紹介者',
                    'VIP',
                    '取次店',
                    '法人・個人',
                    'メールアドレス',
                    '所属企業',
                    '役職',
                    '郵便番号',
                    '住所',
                    '電話番号',
                    '電話番号2',
                    '金融機関',
                    '支店名',
                    '口座種類',
                    '口座番号',
                    '口座名義',
                    '契約書送付日',
                    '契約書締結日',
                    '秘密保持契約書データ送付日',
                    '主な案件',
                    '備考',
                ]);
                // データ
                foreach (Trader::cursor() as $trader) {
                    if($trader->vip == '0'){
                        $trader->vip = '-';
                    }else{
                        $trader->vip = '〇';
                    }
                    if($trader->business_form == '0'){
                        $trader->business_form = '法人';
                    }else{
                        $trader->business_form = '個人';
                    }
                    if($trader->bank_acount_kinds == '0'){
                        $trader->bank_acount_kinds = '普通';
                    }else{
                        $trader->bank_acount_kinds = '当座';
                    }
                    fputcsv($stream, [
                        $trader->id,
                        $trader->introducer,
                        $trader->vip,
                        $trader->trader_name,
                        $trader->business_form,
                        $trader->trader_email,
                        $trader->affiliated_company,
                        $trader->position,
                        $trader->trader_zipcode,
                        $trader->trader_address,
                        $trader->trader_phone,
                        $trader->trader_phone_2,
                        $trader->financial_institution,
                        $trader->financial_branch,
                        $trader->bank_acount_kinds,
                        $trader->bank_acount_number,
                        $trader->bank_acount_name,
                        $trader->contract_sending_date,
                        $trader->contract_conclusion_date,
                        $trader->secret_contract_date,
                        $trader->main_project,
                        $trader->trader_note
                    ]);
                }
                fclose($stream);
            },
            '法人案件取次店一覧.csv',
            [
                'Content-Type' => 'text/csv'
            ]
        );
    }

    public function csv_import(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();
        return view('trader/csv_import');
    }

    public function csv_import_check(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();

        //アップロードしたファイルを取得
        //csv_file はビューの inputタグのname属性
        $uploaded_file = $request->file('csv_file');

        // アップロードしたファイルの絶対パスを取得
        $file_path = $request->file('csv_file')->path($uploaded_file);

        //SplFileObjectを生成
        $file = new SplFileObject($file_path);

          //SplFileObject::READ_CSV が最速らしい
        $file -> setFlags(SplFileObject::READ_CSV);

        $row_count = 1;
        $i = 0;
        foreach ($file as $data) {

            if(count($data) > 22){
                return redirect('trader/csv_import')->with('message', '項目数が合っていません');
            }

            if ($row_count > 1) {
                $data = mb_convert_encoding($data, 'UTF-8', 'SJIS');        //文字コードをSJISに変換
                
                $values[$i]['id'] = $data[0];
                $values[$i]['introducer'] = $data[1];
                $values[$i]['vip'] = $data[2];
                $values[$i]['trader_name'] = $data[3];
                $values[$i]['business_form'] = $data[4];
                $values[$i]['trader_email'] = $data[5];
                $values[$i]['affiliated_company'] = $data[6];
                $values[$i]['position'] = $data[7];
                $values[$i]['trader_zipcode'] = $data[8];
                $values[$i]['trader_address'] = $data[9];
                $values[$i]['trader_phone'] = $data[10];
                $values[$i]['trader_phone_2'] = $data[11];
                $values[$i]['financial_institution'] = $data[12];
                $values[$i]['financial_branch'] = $data[13];
                $values[$i]['bank_acount_kinds'] = $data[14];
                $values[$i]['bank_acount_number'] = $data[15];
                $values[$i]['bank_acount_name'] = $data[16];
                $values[$i]['contract_sending_date'] = $data[17];
                $values[$i]['contract_conclusion_date'] = $data[18];
                $values[$i]['secret_contract_date'] = $data[19];
                $values[$i]['main_project'] = $data[20];
                $values[$i]['trader_note'] = $data[21];
            }
            $row_count++;
            $i++;
        }
        return view('trader/csv_import_check',['values' => $values]);
    }
    public function csv_import_add(Request $request)
    {
        try{

        $datas = $request->all();
        unset($datas['_token']);
        $i=0;

        foreach ($datas as $key => $data) {

            for($i; $i<count($data); $i++){

                $traders = new Trader;

                $traders['introducer'] = $data[$i]['introducer'];
                if($data[$i]['vip_flg'] == 'vip'){
                    $traders['vip_flg'] = 1;
                }else{
                    $traders['vip_flg'] = 0;
                }
                $traders['trader_name'] = $data[$i]['trader_name'];
                if($data[$i]['business_form'] == '法人'){
                    $traders['business_form'] = 0;
                }else{
                    $traders['business_form'] = 1;
                }
                $traders['trader_email'] = $data[$i]['trader_email'];
                $traders['affiliated_company'] = $data[$i]['affiliated_company'];
                $traders['position'] = $data[$i]['position'];
                $traders['trader_zipcode'] = $data[$i]['trader_zipcode'];
                $traders['trader_address'] = $data[$i]['trader_address'];
                $traders['trader_phone'] = $data[$i]['trader_phone'];
                $traders['trader_phone_2'] = $data[$i]['trader_phone_2'];
                $traders['financial_institution'] = $data[$i]['financial_institution'];
                $traders['financial_branch'] = $data[$i]['financial_branch'];
                if($data[$i]['bank_acount_kinds'] == '普通'){
                    $traders['bank_acount_kinds'] = 0;
                }else{
                    $traders['bank_acount_kinds'] = 1;
                }
                $traders['bank_acount_number'] = $data[$i]['bank_acount_number'];
                $traders['bank_acount_name'] = $data[$i]['bank_acount_name'];
                $traders['contract_sending_date'] = $data[$i]['contract_sending_date'];
                $traders['secret_contract_date'] = $data[$i]['secret_contract_date'];
                $traders['main_project'] = $data[$i]['main_project'];
                $traders['main_project'] = $data[$i]['main_project'];
                $traders['trader_note'] = $data[$i]['trader_note'];
                $traders['trader_contract_conclusion_id'] = 1 ;

                //$traders = $request->all();
                $traders->save();
            }
        }
        //操作ログ
        $method = new Trader;
        $method->log_port('インポート');
        return redirect('trader/csv_import')->with('message', 'インポートに成功しました。');

        }catch(\Exception $e){
            return redirect('trader/csv_import')->with('error_message', '登録に失敗しました。IDが重複しています。');
        }
    }

    //報酬・明細一覧
    public function reward(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();

        $client_status = Client_statuse::all();
        $matter_status = Matter_statuse::all();

        $trader_reward = $method->column_reward();
        $clients = $trader_reward['clients'];
        $matters = $trader_reward['matters'];

        $columns = $matters->union($clients)->orderby('payment_date', 'ASC')->paginate(100);

        foreach($columns as $column){
            if(!is_numeric($column['agency_store_2'])){
                unset($column['matter_id']);
                unset($column['matter_status_id']);
                unset($column['agency_store_2']);
                unset($column['agency_store_2_name']);
                unset($column['agency_store_3']);
                unset($column['agency_store_3_name']);
            }else{
                unset($column['client_id']);
                unset($column['client_status_id']);
            }
        }
        $trader_rewards = $columns;

        return view('trader/trader_reward', ['client_status' => $client_status, 'matter_status' => $matter_status, 'trader_rewards' => $trader_rewards]);
    }

    //報酬・明細一覧 キーワード検索
    public function search_reward(Request $request)
    {
        $search = $request->search;

        //ログインIDと権限をsessionに保存
        $method = new Trader;
        $method->auth();

        $client_status = Client_statuse::all();
        $matter_status = Matter_statuse::all();

        $trader_rewards = $method->search_reward($search);

        if(empty($trader_rewards) || $trader_rewards->isEmpty()){
            return redirect()->action('TraderController@reward')->with('error_message', '検索された項目は存在しませんでした。');
        }

        return view('trader/trader_reward', ['client_status' => $client_status, 'matter_status' => $matter_status, 'trader_rewards' => $trader_rewards]);
    }

    //チェックボックス削除
    public function reward_check_delete($client_value, $matter_value) {
        sleep(1);

        $client_id = explode(",",$client_value);
        $matter_id = explode(",",$matter_value);

        $client_box = [];
        if($client_id[0] != '0'){
            $client_count = count($client_id);
            for($i = 0; $i < $client_count; $i++){
                $client_box[] = array('client_id' => $client_id[$i]);
            }
        }
        $matter_box = [];
        if($matter_id[0] != '0'){
            $matter_count = count($matter_id);
            for($i = 0; $i < $matter_count; $i++){
                $matter_box[] = array('matter_id' => $matter_id[$i]);
            }
        }

        foreach($client_box as $client_val){
            if(array_key_exists('client_id', $client_val)){
                $clients = '';
                $clients = Client::find($client_val['client_id']);
                $client_member[] = ['ID' => $clients['member']];
                $client_contractor[] = ['氏名' => $clients['contractor']];
                $data = $clients->delete();
                //報酬・詳細一覧から削除
                $reward_client_id = Reward::where('client_id',$client_val['client_id'])->first();
                $reward_client_id['client_id'] = null;
                $reward_client_id->save();
            }
        }

        foreach($matter_box as $matter_val){
            if(array_key_exists('matter_id', $matter_val)){
                $matters = '';
                $matters = Matter::find($matter_val['matter_id']);
                $matter_member[] = ['ID' => $matters['member']];
                $matter_contractor[] = ['会社名' => $matters['contractor']];
                $data = $matters->delete();
                //報酬・詳細一覧から削除
                $reward_matter_id = Reward::where('matter_id',$matter_val['matter_id'])->first();
                $reward_matter_id['matter_id'] = null;
                $reward_matter_id->save();
            }
        }

        //操作ログ
        $method = new Trader;
        if($client_id[0] != '0'){
            $client_member = json_encode($client_member,JSON_UNESCAPED_UNICODE);
            $client_contractor = json_encode($client_contractor,JSON_UNESCAPED_UNICODE);

            $method->log_reward_check_box('個人案件',$client_member,$client_contractor,'削除');
        }
        if($matter_id[0] != '0'){
            $matter_member = json_encode($matter_member,JSON_UNESCAPED_UNICODE);
            $matter_contractor = json_encode($matter_contractor,JSON_UNESCAPED_UNICODE);

            $method->log_reward_check_box('法人案件',$matter_member,$matter_contractor,'削除');
        }

        return response()->json($data);
    }

    //チェックボックス・プルダウン更新
    public function reward_check_edit($client_value,$matter_value,$client_status_name,$matter_status_name) {
        sleep(1);

        $client_id = explode(",",$client_value);
        $matter_id = explode(",",$matter_value);
        $client_status_id = explode(",",$client_status_name);
        $matter_status_id = explode(",",$matter_status_name);

        $client_box = [];
        if($client_id[0] != '0'){
            $count =count($client_id);
            for($i = 0; $i < $count; $i++){
                $client_box[] = array('client_id' => $client_id[$i], 'client_status_id' => $client_status_id[$i]);
            }
        }
        $matter_box = [];
        if($matter_id[0] != '0'){
            $count =count($matter_id);
            for($i = 0; $i < $count; $i++){
                $matter_box[] = array('matter_id' => $matter_id[$i], 'matter_status_id' => $matter_status_id[$i]);
            }
        }

        $method = new Trader;
        foreach($client_box as $client_val){
            if(array_key_exists('client_id', $client_val) && array_key_exists('client_status_id', $client_val)){
                $clients = '';
                $clients = Client::find($client_val['client_id']);
                $client_member[] = ['ID' => $clients['member']];
                $client_contractor[] = ['氏名' => $clients['contractor']];
                //ステータス変更ログ
                $clients['client_status_add'] = date('Y-m-d');
                $status_before = Client_statuse::find($clients['client_status_id']);
                $status_after = Client_statuse::find($client_val['client_status_id']);
                $method->log_change_status($client_val['client_id'],$status_before['status_number'],'個人案件ステータス',$status_before['status_name'],$status_after['status_number'],$status_after['status_name']);
                //ステータス変更メール
                $first_client = Trader::find($clients['trader_id']);
                $forms = [];
                $forms = ['first_client' => $first_client['trader_name'], 'matter' => $first_client['main_project'], 'status_after' => $status_after['status_number'].'：'.$status_after['status_name'], 'status_before' => $status_before['status_number'].'：'.$status_before['status_name'], 'first_mail' => $first_client['trader_email']];
                $mail = new MailSend;
                $mail->client($forms);

                $clients['client_status_id'] = $client_val['client_status_id'];
                $data = $clients->save();
            }
        }
        foreach($matter_box as $matter_val){
            if(array_key_exists('matter_id', $matter_val) && array_key_exists('matter_status_id', $matter_val)){
                $matters = '';
                $matters = Matter::find($matter_val['matter_id']);
                $matter_member[] = ['ID' => $matters['member']];
                $matter_contractor[] = ['会社名' => $matters['contractor']];
                //ステータス変更ログ
                $matters['matter_status_add'] = date('Y-m-d');
                $status_before = Matter_statuse::find($matters['matter_status_id']);
                $status_after = Matter_statuse::find($matter_val['matter_status_id']);
                $method->log_change_status($matter_val['matter_id'],$status_before['status_number'],'法人案件ステータス',$status_before['status_name'],$status_after['status_number'],$status_after['status_name']);
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

                $matters['matter_status_id'] = $matter_val['matter_status_id'];
                $data = $matters->save();
            }
        }

        //操作ログ
        $method = new Trader;
        if($client_id[0] != '0'){
            $client_member = json_encode($client_member,JSON_UNESCAPED_UNICODE);
            $client_contractor = json_encode($client_contractor,JSON_UNESCAPED_UNICODE);

            $method->log_reward_check_box('個人案件',$client_member,$client_contractor,'変更');
        }
        if($matter_id[0] != '0'){
            $matter_member = json_encode($matter_member,JSON_UNESCAPED_UNICODE);
            $matter_contractor = json_encode($matter_contractor,JSON_UNESCAPED_UNICODE);

            $method->log_reward_check_box('法人案件',$matter_member,$matter_contractor,'変更');
        }

        return response()->json($data);
    }
}