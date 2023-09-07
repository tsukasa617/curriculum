<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Models\Auth as ModelAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\User;
use App\Models\Trader;
use Illuminate\Support\Facades\Crypt;

//論理削除
use Illuminate\Database\Eloquent\SoftDeletes;

class Matter extends Model
{
    //論理削除
    use SoftDeletes;
    protected $dates = ['deleted_at','created_at'];

    protected $guarded = array('id');

    //ログインIDと権限をsessionに保存
    public function auth(){
        if(session()->put('authoritys') == null){
            $authority = ModelAuth::where('id', Auth::user()->auth_id)->select('authority')->get();
            $authority = json_decode($authority,true);
            foreach($authority as $a){
                foreach($a as $authoritys){}
            }
            session()->put(['user_login'=> Auth::user()->login, 'authoritys' => $authoritys]);
        }
    }

    //法人顧客カラム
    public function column(){
        $traders = Trader::select('id','trader_name');
        $matters = Model::select(
            //NO
            'matters.id',
            //重要マーク
            'matters.important',
            //注意マーク
            'matters.caution',
            //連結日
            'matters.submit_date',
            //流入経路
            'advertisings.advertising_name',
            //ID
            'matters.member',
            //グループ
            'matters.group_name',
            //会社名
            'matters.contractor',
            //住所
            'matters.address',
            //物件名
            'matters.buildingname',
            //建物種別
            'matters.property_information',
            //連絡方法
            'matters.contact_method',
            //築年数
            'matters.building_age',
            //保険契約者名
            'matters.insurance_policyholder',
            //保険会社
            'matters.insurance_company',
            //台風名
            'matters.typhoon_name',
            //風速
            'matters.wind_speed',
            //風災
            'matters.wind_disaster',
            //震災
            'matters.earthquake_disaster',
            //ステータス ID
            'matters.matter_status_id',
            //ステータス 名前
            'matter_statuses.status_name',
            //ステータス 番号
            'matter_statuses.status_number',
            //備考
            'matters.note',
            //入金予測時期
            'matters.payment_predict_date',
            //入金期待値
            'matters.payment_expecte',
            //図面
            'matters.drawing',
            //合意書（例:10/01）
            'matters.agreement_date',
            //保険証券
            'matters.insurance_policy',
            //商談日
            'matters.scheduled_survey_date',
            //依頼日
            'matters.request_date',
            //現調日（例:10/01）
            'matters.survey_date',
            //現調担当
            'matters.survey_staff',
            //工事コンサル	＊調査会社非表示
            'matters.construction_consultant',
            //事故報告（例:10/01）
            'matters.accident_date',
            //保険申請日
            'matters.insurance_policy_date',
            //請求用紙到着（民間）
            'matters.billing_receipt_date',
            //写真UP（例:10/01）
            'matters.picture_date',
            //報告書完成日
            'matters.report_completed_date',
            //見積書完成日
            'matters.quotation_completed_date',
            //発送日
            'matters.submit_sending_date',
            //発送先(保険会社/お客様)
            'matters.document_submit_to',
            //鑑定日
            'matters.judge_date',
            //認定日（例:10/01）
            'matters.certification_date',
            //顧客請求書送付（例:10/01）
            'matters.customer_invoice_date',
            //請求日
            'matters.bill_issue_date',
            //入金日（例:10/01）
            'matters.payment_date',
            //アクション日付
            'matters.action_date',
            //アクション内容
            'matters.action_note',
            //アクションログ
            'matters.action_log',
            //営業担当
            'matters.sales_staff',
            //案件窓口
            'matters.contact_matter',
            //見積額
            'matters.quotation_money',
            //認定額
            'matters.certification_money',
            //見積額の認定率(%)
            'matters.quotation_money_probability',
            //手数料  ＊調査会社非表示
            'matters.fee',
            //入金額
            'matters.payment_money',

            //取次店 ID
            'matters.trader_id',
            //取次店 名前
            'traders.trader_name',
            //紹介率1
            'matters.referral_rate',
            //取次店支払額1
            'matters.trader_payment_money_1',
            //取次店２ ID
            'matters.agency_store_2',
            //取次店２ 名前
            'agency_store_2.trader_name as agency_store_2_name',
            //紹介率2
            'matters.referral_rate_2',
            //取次店支払額2
            'matters.trader_payment_money_2',
            //取次店３ ID
            'matters.agency_store_3',
            //取次店3 名前
            'agency_store_3.trader_name as agency_store_3_name',
            //紹介率3
            'matters.referral_rate_3',
            //取次店支払額3
            'matters.trader_payment_money_3',
            //紹介率合計
            'matters.referral_rate_total',
            //取次店支払額
            'matters.trader_payment_money',
            //調査会社
            'surveies.survey_name',
            //調査会社手数料
            'matters.survey_referral',
            //調査会社支払額
            'matters.survey_payment_money',
            //利益額
            'matters.profit_money',
            //保険証券画像
            'matter_insurance_policies.image_path as insurance_policies_image_path',
            //保険証券画像タイトル
            'matter_insurance_policies.image_title as insurance_policies_image_title',
            //合意書画像
            'matter_agreements.image_path as agreements_image_path',
            //合意書画像タイトル
            'matter_agreements.image_title as agreements_image_title',
            //報告書画像
            'matter_reports.image_path as reports_image_path',
            //報告書画像タイトル
            'matter_reports.image_title as reports_image_title',
            //見積書画像
            'matter_quotations.image_path as quotations_image_path',
            //見積書画像タイトル
            'matter_quotations.image_title as quotations_image_title',
            //認定書画像
            'matter_certifications.image_path as certifications_image_path',
            //認定書画像タイトル
            'matter_certifications.image_title as certifications_image_title',
            //請求書画像
            'matter_bill_issues.image_path as bill_issues_image_path',
            //請求書画像タイトル
            'matter_bill_issues.image_title as bill_issues_image_title',
            //図面画像
            'matter_drawings.image_path as drawings_image_path',
            //図面画像タイトル *編集
            'matter_drawings.image_title as drawings_image_title'
            )
            ->join('advertisings', 'matters.advertising_id', '=', 'advertisings.id')
            ->join('surveies', 'matters.survey_id', '=', 'surveies.id')
            ->join('matter_insurance_policies', 'matters.matter_insurance_policy_id', '=', 'matter_insurance_policies.id')
            ->join('matter_drawings', 'matters.matter_drawing_id', '=', 'matter_drawings.id')
            ->join('matter_agreements', 'matters.matter_agreement_id', '=', 'matter_agreements.id')
            ->join('matter_reports', 'matters.matter_report_id', '=', 'matter_reports.id')
            ->join('matter_quotations', 'matters.matter_quotation_id', '=', 'matter_quotations.id')
            ->join('matter_certifications', 'matters.matter_certification_id', '=', 'matter_certifications.id')
            ->join('matter_bill_issues', 'matters.matter_bill_issue_id', '=', 'matter_bill_issues.id')
            ->join('matter_statuses', 'matters.matter_status_id', '=', 'matter_statuses.id')
            ->join('traders', 'matters.trader_id', '=', 'traders.id')
            ->joinSub($traders,'agency_store_2', function($join) {$join->on('matters.agency_store_2', '=', 'agency_store_2.id');})
            ->joinSub($traders,'agency_store_3', function($join) {$join->on('matters.agency_store_3', '=', 'agency_store_3.id');});
            return $matters;
    }

    //複数条件検索
    public function scopeSerach($matter_status_id,$action_date,$action_note,$note) {
        $any_serach = new Matter;
        $any_serach = $any_serach->column();
        // ステータス絞り込み
        if (!empty($matter_status_id)) {
            $some_serach = $any_serach->where(function($any_serach) use($matter_status_id) {
                $any_serach->where('matter_status_id', $matter_status_id);
            });
        }
        // アクション日付絞り込み
        if (!empty($action_date)) {
            $some_serach = $any_serach->where(function ($any_serach) use ($action_date) {
                $any_serach->where('action_date', 'like', '%' . $action_date . '%');
            });
        }
        // アクション内容絞り込み
        if (!empty($action_note)) {
            $some_serach = $any_serach->where(function ($any_serach) use ($action_note) {
                $any_serach->where('action_note', 'like', '%' . $action_note . '%');
            });
        }
        // 備考絞り込み
        if (!empty($note)) {
            $some_serach = $any_serach->where(function ($any_serach) use ($note) {
                $any_serach->where('note', 'like', '%' . $note . '%');
            });
        }

        // 全て入力がなければそのまま返す
        if (empty($matter_status_id) && 
            empty($action_date) &&
            empty($action_note) &&
            empty($note)){
                $some_serach = $any_serach;
        }
        
        $some_serach = $some_serach->paginate(100);
        return $some_serach;
    }

    //並び替え
    public function sort($request,$matters,$sort) {
        $matter_data = Crypt::decryptString($request->matter_data);
        $matter_data = json_decode($matter_data, true);

        //並び替えの前に複数条件検索を行なっていた場合、配列を調整する。
        if(isset($matter_data['data'])){
            $matter_data = $matter_data['data'];
        }
        

        foreach($matter_data as $key => $value){
            $sort_keys[$key] = $value[$request->column];
        }
        array_multisort($sort_keys, $sort, $matter_data);

        $num = count($matter_data);
        
        for($i = 0; $i < $num; $i++){
            $matters[$i] = $matter_data[$i];
        }
            
        if($num < count($matters)){
            for($int = $num; $num < count($matters); $int++){
                unset($matters[$int]);
            }
        }
    }

    //新規登録バリデーション
    public function create_validation($request) {
        $request->validate([
            'member' => ['required','regex:/^[0-9]+$/i',Rule::unique('matters')],
            'contractor' => 'required',
            'address' => 'required|max:255',
            'contact_method' => 'required',
            'quotation_money' => ['required','regex:/^[0-9]+$/i'],
            'certification_money' => ['required','regex:/^[0-9]+$/i'],
            'fee' => ['required','regex:/^[0-9]+$/i'],
            'referral_rate' => ['required','regex:/^[0-9]+$/i'],
            'referral_rate_2' => ['required','regex:/^[0-9]+$/i'],
            'referral_rate_3' => ['required','regex:/^[0-9]+$/i'],
            'survey_referral' => ['required','regex:/^[0-9]+$/i']
        ]);
    }

    //編集バリデーション
    public function edit_validation($request_id,$request) {

        $member = Model::find($request_id);

        $request->validate([
            'member' => ['required','regex:/^[0-9]+$/i',Rule::unique('matters')->ignore($member)],
            'contractor' => 'required',
            'address' => 'required|max:255',
            'contact_method' => 'required',
            'quotation_money' => 'regex:/^[0-9]+$/i',
            'certification_money' => 'regex:/^[0-9]+$/i',
            'fee' => 'regex:/^[0-9]+$/i',
            'referral_rate' => 'regex:/^[0-9]+$/i',
            'referral_rate_2' => 'regex:/^[0-9]+$/i',
            'referral_rate_3' => 'regex:/^[0-9]+$/i',
            'survey_referral' => 'regex:/^[0-9]+$/i',
        ]);
    }

    //画像パス
    public function document_path($culum,$request){
        if($request[$culum.'_import'] == "0" || $request[$culum.'_import'] == null){
            $read_path = $request['before_'.$culum];
            return $read_path;
        }else{
            $request->validate([
                $culum.'_import' => 'file|mimes:jpeg,png,jpg,bmb|max:2048',
            ]);
            $imagefile = $request->file($culum.'_import');
            //画像を保存するパスは"public/image/xxx.jpg"
            $imagepath = $imagefile->store('public/image');
            //商品一覧画面から画像を読み込むときのパスはstorage/image/xxx.jpg"
            $read_path = str_replace('public/', 'storage/', $imagepath);
            return $read_path;
        };
    }

    //画像保存
    public function document_exist($matters,$table,$form,$culum){
        if($matters['matter_'.$culum.'_id'] == '1'){
            $img = new $table;
            $img['image_title'] = $form[$culum . '_title'];
            $img['image_path'] = $form[$culum . '_read_path'];
            $img->save();
        }else{
            $img = $table::where('id', $matters['matter_' . $culum . '_id'])->first();
            $img['image_title'] = $form[$culum . '_title'];
            $img['image_path'] = $form[$culum . '_read_path'];
            $img->save();
        }
    }

    //法人案件顧客ログ
    public function log_all($number,$name,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '法人案件顧客リスト、ID：%d、会社名：%sを%sしました。';
        $logs->log = sprintf($format,$number,$name,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //法人案件顧客進捗報告更新ログ
    public function log_change_status($id,$before_number,$before_status,$after_number,$after_status){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = 'id,%d,法人案件ステータス、%d：%sを%d：%sに更新しました。';
        $logs->log = sprintf($format,$id,$before_number,$before_status,$after_number,$after_status);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //法人案件顧客ステータスログ
    public function log_status($number,$name,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '法人ST編集、番号：%d、ステータス名：%sを%sしました。';
        $logs->log = sprintf($format,$number,$name,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //法人案件顧客流入経路ログ
    public function log_advertising($number,$name,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '法人案件顧客流入経路、番号：%d、ステータス名：%sを%sしました。';
        $logs->log = sprintf($format,$number,$name,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //法人案件顧客チェックボックスログ
    public function log_check_box($number_json,$name_json,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '法人案件顧客リスト、%s、%s、を%sしました。';
        $logs->log = sprintf($format,$number_json,$name_json,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //法人案件顧客エクスポート・インポートログ
    public function log_port($action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '法人案件顧客リスト、を%sしました。';
        $logs->log = sprintf($format,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //csv_import headの名前
    public function head_name(){
        $head =[
            '流入経路',
            'ID',
            'グループ名',
            '会社名',
            '契約者名',
            '住所',
            '建物名',
            '建物種別',
            '連絡先',
            '築年数',
            '保険会社',
            'ステータス',
            'アクション日付',
            'アクション内容',
            '備考',
            '入金予測時期',
            '入金期待値',
            '営業担当',
            '調査会社',
            '現調担当',
            '依頼日',
            '現調予定日',
            '現調日',
            '合意書',
            '事故報告日',
            '保険申請日',
            '認定日',
            '請求日',
            '入金日',
            '見積額',
            '認定額',
            '見積額の認定率（％）',
            '請求手数料（％）',
            '入金額',
            '調査会社手数料（％）',
            '調査会社支払額',
            '取次店1',
            '紹介率1',
            '取次店支払額1',
            '取次店2',
            '紹介率2',
            '取次店支払額2',
            '取次店3',
            '紹介率3',
            '取次店支払額3',
            '紹介率合計',
            '取次店支払額',
            '利益額',
        ];
        return $head;
    }

    // ストリームに対して1行ごと書き出し
    public function stream($matter, $agency_store_2_name, $agency_store_3_name){
        $stream_culum = [
            $matter->advertising_name,
            $matter->member,
            $matter->group_name,
            $matter->contractor,
            $matter->insurance_policyholder,
            $matter->address,
            $matter->buildingname,
            $matter->property_information,
            $matter->contact_method,
            $matter->building_age,
            $matter->insurance_company,
            $matter->status_number . ':' . $matter->status_name,
            $matter->action_date,
            $matter->action_note,
            $matter->note,
            $matter->payment_predict_date,
            $matter->payment_expecte,
            $matter->sales_staff,
            $matter->survey_name,
            $matter->survey_staff,
            $matter->request_date,
            $matter->scheduled_survey_date,
            $matter->survey_date,
            $matter->agreement_date,
            $matter->accident_date,
            $matter->insurance_policy_date,
            $matter->certification_date,
            $matter->bill_issue_date,
            $matter->payment_date,
            $matter->quotation_money,
            $matter->certification_money,
            $matter->quotation_money_probability,
            $matter->fee,
            $matter->payment_money,
            $matter->survey_referral,
            $matter->survey_payment_money,
            $matter->trader_id . ':' . $matter->trader_name,
            $matter->referral_rate,
            $matter->trader_payment_money_1,
            $matter->agency_store_2 . ':' . $agency_store_2_name,
            $matter->referral_rate_2,
            $matter->trader_payment_money_2,
            $matter->agency_store_3 . ':' . $agency_store_3_name,
            $matter->referral_rate_3,
            $matter->trader_payment_money_3,
            $matter->referral_rate_total,
            $matter->trader_payment_money,
            $matter->profit_money,
        ];
        return $stream_culum;
    }
}
