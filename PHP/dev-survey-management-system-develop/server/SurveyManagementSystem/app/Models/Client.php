<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Models\Auth as ModelAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\Trader;
use App\Models\Log;
use App\Models\User;

//論理削除
use Illuminate\Database\Eloquent\SoftDeletes;
//暗号化
use Illuminate\Support\Facades\Crypt;

class Client extends Model
{
    //論理削除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

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

    //顧客カラム
    public function column(){
        $clients = Model::select(
            //NO
            'clients.id',
            //重要マーク
            'clients.important',
            //注意マーク
            'clients.caution',
            // 連結日
            'clients.submit_date',
            //流入経路
            'clients.advertising',
            //ID
            'clients.member',
            //氏名
            'clients.contractor',
            //住所
            'clients.address',
            //物件名
            'clients.buildingname',
            //契約者連絡先
            'clients.contractor_contact',
            //メールアドレス
            'clients.mail_address',
            //火災保険の加入状況
            'clients.fire_insurance_flg',
            //保険会社
            'clients.insurance_company',
            //築年数
            'clients.building_age',
            //地震 有/無   ＊裏カラム
            'clients.earthquake_flg',
            //ステータス ID
            'clients.client_status_id',
            //ステータス 名前
            'client_statuses.status_name',
            //ステータス 番号
            'client_statuses.status_number',
            // アクション日付
            'clients.action_date',
            // アクション内容
            'clients.action_note',
            //備考
            'clients.note',
            // 入金予測時期
            'clients.payment_predict_date',
            //入金期待値
            'clients.payment_expecte',
            //営業担当
            'clients.sales_staff',
            //調査会社
            'surveies.survey_name',
            //現調担当
            'clients.survey_staff',
            //依頼日
            'clients.request_date',
            //"現調予定日"
            'clients.scheduled_survey_date',
            //"現調日"
            'clients.survey_date',
            //"合意書"
            'clients.agreement_date',
            //"事故報告日"
            'clients.accident_date',
            //保険申請日
            'clients.insurance_policy_date',
            //"認定日"
            'clients.certification_date',
            //"清算(請求書発行)"
            'clients.bill_issue_date',
            //"入金日"
            'clients.payment_date',
            //クオカード送付
            'clients.quo_card_date',
            //見積額
            'clients.quotation_money',
            //認定額
            'clients.certification_money',
            //認定額の認定率
            'clients.certification_money_probability',
            //請求手数料（％）
            'clients.client_fee',
            //入金額
            'clients.payment_money',
            //調査会社手数料（％）
            'clients.survey_referral',
            //調査会社支払額
            'clients.survey_payment_money',
            //取次店手数料（％）
            'clients.trader_referral',
            //取次店支払額
            'clients.trader_payment_money',
            //利益額
            'clients.profit_money',
            //保険証券データ
            'client_insurance_policies.image_path as insurance_policies_image_path',
            //保険証券データタイトル
            'client_insurance_policies.image_title as insurance_policies_image_title',
            //合意書データ
            'client_agreements.image_path as agreements_image_path',
            //合意書データタイトル
            'client_agreements.image_title as agreements_image_title',
            //報告書データ
            'client_reports.image_path as reports_image_path',
            //報告書データタイトル *編集
            'client_reports.image_title as reports_image_title',
            //見積書データ
            'client_quotations.image_path as quotations_image_path',
            //見積書データタイトル 
            'client_quotations.image_title as quotations_image_title',
            //認定書データ
            'client_certifications.image_path as certifications_image_path',
            //認定書データタイトル 
            'client_certifications.image_title as certifications_image_title',
            //その他データ
            'client_drawings.image_path as drawings_image_path',
            //その他データタイトル *編集
            'client_drawings.image_title as drawings_image_title'
        )
        ->join('surveies', 'clients.survey_id', '=', 'surveies.id')
        ->join('client_insurance_policies', 'clients.client_insurance_policy_id', '=', 'client_insurance_policies.id')
        ->join('client_drawings', 'clients.client_drawing_id', '=', 'client_drawings.id')
        ->join('client_statuses', 'clients.client_status_id', '=', 'client_statuses.id')
        ->join('client_agreements', 'clients.client_agreement_id', '=', 'client_agreements.id')
        ->join('client_reports', 'clients.client_report_id', '=', 'client_reports.id')
        ->join('client_quotations', 'clients.client_quotation_id', '=', 'client_quotations.id')
        ->join('client_certifications', 'clients.client_certification_id', '=', 'client_certifications.id');

        return $clients;
    }

    //電話番号の-場所
    public static function phone($input, $strict = false) {
        $groups = array(
            5 =>
            array (
                '01564' => 1,
                '01558' => 1,
                '01586' => 1,
                '01587' => 1,
                '01634' => 1,
                '01632' => 1,
                '01547' => 1,
                '05769' => 1,
                '04992' => 1,
                '04994' => 1,
                '01456' => 1,
                '01457' => 1,
                '01466' => 1,
                '01635' => 1,
                '09496' => 1,
                '08477' => 1,
                '08512' => 1,
                '08396' => 1,
                '08388' => 1,
                '08387' => 1,
                '08514' => 1,
                '07468' => 1,
                '01655' => 1,
                '01648' => 1,
                '01656' => 1,
                '01658' => 1,
                '05979' => 1,
                '04996' => 1,
                '01654' => 1,
                '01372' => 1,
                '01374' => 1,
                '09969' => 1,
                '09802' => 1,
                '09912' => 1,
                '09913' => 1,
                '01398' => 1,
                '01377' => 1,
                '01267' => 1,
                '04998' => 1,
                '01397' => 1,
                '01392' => 1,
            ),
            4 =>
            array (
                '0768' => 2,
                '0770' => 2,
                '0772' => 2,
                '0774' => 2,
                '0773' => 2,
                '0767' => 2,
                '0771' => 2,
                '0765' => 2,
                '0748' => 2,
                '0747' => 2,
                '0746' => 2,
                '0826' => 2,
                '0749' => 2,
                '0776' => 2,
                '0763' => 2,
                '0761' => 2,
                '0766' => 2,
                '0778' => 2,
                '0824' => 2,
                '0797' => 2,
                '0796' => 2,
                '0555' => 2,
                '0823' => 2,
                '0798' => 2,
                '0554' => 2,
                '0820' => 2,
                '0795' => 2,
                '0556' => 2,
                '0791' => 2,
                '0790' => 2,
                '0779' => 2,
                '0558' => 2,
                '0745' => 2,
                '0794' => 2,
                '0557' => 2,
                '0799' => 2,
                '0738' => 2,
                '0567' => 2,
                '0568' => 2,
                '0585' => 2,
                '0586' => 2,
                '0566' => 2,
                '0564' => 2,
                '0565' => 2,
                '0587' => 2,
                '0584' => 2,
                '0581' => 2,
                '0572' => 2,
                '0574' => 2,
                '0573' => 2,
                '0575' => 2,
                '0576' => 2,
                '0578' => 2,
                '0577' => 2,
                '0569' => 2,
                '0594' => 2,
                '0827' => 2,
                '0736' => 2,
                '0735' => 2,
                '0725' => 2,
                '0737' => 2,
                '0739' => 2,
                '0743' => 2,
                '0742' => 2,
                '0740' => 2,
                '0721' => 2,
                '0599' => 2,
                '0561' => 2,
                '0562' => 2,
                '0563' => 2,
                '0595' => 2,
                '0596' => 2,
                '0598' => 2,
                '0597' => 2,
                '0744' => 2,
                '0852' => 2,
                '0956' => 2,
                '0955' => 2,
                '0954' => 2,
                '0952' => 2,
                '0957' => 2,
                '0959' => 2,
                '0966' => 2,
                '0965' => 2,
                '0964' => 2,
                '0950' => 2,
                '0949' => 2,
                '0942' => 2,
                '0940' => 2,
                '0930' => 2,
                '0943' => 2,
                '0944' => 2,
                '0948' => 2,
                '0947' => 2,
                '0946' => 2,
                '0967' => 2,
                '0968' => 2,
                '0987' => 2,
                '0986' => 2,
                '0985' => 2,
                '0984' => 2,
                '0993' => 2,
                '0994' => 2,
                '0997' => 2,
                '0996' => 2,
                '0995' => 2,
                '0983' => 2,
                '0982' => 2,
                '0973' => 2,
                '0972' => 2,
                '0969' => 2,
                '0974' => 2,
                '0977' => 2,
                '0980' => 2,
                '0979' => 2,
                '0978' => 2,
                '0920' => 2,
                '0898' => 2,
                '0855' => 2,
                '0854' => 2,
                '0853' => 2,
                '0553' => 2,
                '0856' => 2,
                '0857' => 2,
                '0863' => 2,
                '0859' => 2,
                '0858' => 2,
                '0848' => 2,
                '0847' => 2,
                '0835' => 2,
                '0834' => 2,
                '0833' => 2,
                '0836' => 2,
                '0837' => 2,
                '0846' => 2,
                '0845' => 2,
                '0838' => 2,
                '0865' => 2,
                '0866' => 2,
                '0892' => 2,
                '0889' => 2,
                '0887' => 2,
                '0893' => 2,
                '0894' => 2,
                '0897' => 2,
                '0896' => 2,
                '0895' => 2,
                '0885' => 2,
                '0884' => 2,
                '0869' => 2,
                '0868' => 2,
                '0867' => 2,
                '0875' => 2,
                '0877' => 2,
                '0883' => 2,
                '0880' => 2,
                '0879' => 2,
                '0829' => 2,
                '0550' => 2,
                '0228' => 2,
                '0226' => 2,
                '0225' => 2,
                '0224' => 2,
                '0229' => 2,
                '0233' => 2,
                '0237' => 2,
                '0235' => 2,
                '0234' => 2,
                '0223' => 2,
                '0220' => 2,
                '0192' => 2,
                '0191' => 2,
                '0187' => 2,
                '0193' => 2,
                '0194' => 2,
                '0198' => 2,
                '0197' => 2,
                '0195' => 2,
                '0238' => 2,
                '0240' => 2,
                '0260' => 2,
                '0259' => 2,
                '0258' => 2,
                '0257' => 2,
                '0261' => 2,
                '0263' => 2,
                '0266' => 2,
                '0265' => 2,
                '0264' => 2,
                '0256' => 2,
                '0255' => 2,
                '0243' => 2,
                '0242' => 2,
                '0241' => 2,
                '0244' => 2,
                '0246' => 2,
                '0254' => 2,
                '0248' => 2,
                '0247' => 2,
                '0186' => 2,
                '0185' => 2,
                '0144' => 2,
                '0143' => 2,
                '0142' => 2,
                '0139' => 2,
                '0145' => 2,
                '0146' => 2,
                '0154' => 2,
                '0153' => 2,
                '0152' => 2,
                '0138' => 2,
                '0137' => 2,
                '0125' => 2,
                '0124' => 2,
                '0123' => 2,
                '0126' => 2,
                '0133' => 2,
                '0136' => 2,
                '0135' => 2,
                '0134' => 2,
                '0155' => 2,
                '0156' => 2,
                '0176' => 2,
                '0175' => 2,
                '0174' => 2,
                '0178' => 2,
                '0179' => 2,
                '0184' => 2,
                '0183' => 2,
                '0182' => 2,
                '0173' => 2,
                '0172' => 2,
                '0162' => 2,
                '0158' => 2,
                '0157' => 2,
                '0163' => 2,
                '0164' => 2,
                '0167' => 2,
                '0166' => 2,
                '0165' => 2,
                '0267' => 2,
                '0250' => 2,
                '0533' => 2,
                '0422' => 2,
                '0532' => 2,
                '0531' => 2,
                '0436' => 2,
                '0428' => 2,
                '0536' => 2,
                '0299' => 2,
                '0294' => 2,
                '0293' => 2,
                '0475' => 2,
                '0295' => 2,
                '0297' => 2,
                '0296' => 2,
                '0495' => 2,
                '0438' => 2,
                '0466' => 2,
                '0465' => 2,
                '0467' => 2,
                '0478' => 2,
                '0476' => 2,
                '0470' => 2,
                '0463' => 2,
                '0479' => 2,
                '0493' => 2,
                '0494' => 2,
                '0439' => 2,
                '0268' => 2,
                '0480' => 2,
                '0460' => 2,
                '0538' => 2,
                '0537' => 2,
                '0539' => 2,
                '0279' => 2,
                '0548' => 2,
                '0280' => 2,
                '0282' => 2,
                '0278' => 2,
                '0277' => 2,
                '0269' => 2,
                '0270' => 2,
                '0274' => 2,
                '0276' => 2,
                '0283' => 2,
                '0551' => 2,
                '0289' => 2,
                '0287' => 2,
                '0547' => 2,
                '0288' => 2,
                '0544' => 2,
                '0545' => 2,
                '0284' => 2,
                '0291' => 2,
                '0285' => 2,
                '0120' => 3,
                '0570' => 3,
                '0800' => 3,
                '0990' => 3,
            ),
            3 =>
            array (
                '099' => 3,
                '054' => 3,
                '058' => 3,
                '098' => 3,
                '095' => 3,
                '097' => 3,
                '052' => 3,
                '053' => 3,
                '011' => 3,
                '096' => 3,
                '049' => 3,
                '015' => 3,
                '048' => 3,
                '072' => 3,
                '084' => 3,
                '028' => 3,
                '024' => 3,
                '076' => 3,
                '023' => 3,
                '047' => 3,
                '029' => 3,
                '075' => 3,
                '025' => 3,
                '055' => 3,
                '026' => 3,
                '079' => 3,
                '082' => 3,
                '027' => 3,
                '078' => 3,
                '077' => 3,
                '083' => 3,
                '022' => 3,
                '086' => 3,
                '089' => 3,
                '045' => 3,
                '044' => 3,
                '092' => 3,
                '046' => 3,
                '017' => 3,
                '093' => 3,
                '059' => 3,
                '073' => 3,
                '019' => 3,
                '087' => 3,
                '042' => 3,
                '018' => 3,
                '043' => 3,
                '088' => 3,
                '050' => 4,
            ),
            2 =>
            array (
                '04' => 4,
                '03' => 4,
                '06' => 4,
            ),
        );
        $groups[3] +=
            $strict ?
            array(
                '020' => 3,
                '070' => 3,
                '080' => 3,
                '090' => 3,
            ) :
            array(
                '020' => 4,
                '070' => 4,
                '080' => 4,
                '090' => 4,
            )
        ;
        $number = preg_replace('/[^\d]++/', '', $input);
        foreach ($groups as $len => $group) {
            $area = substr($number, 0, $len);
            if (isset($group[$area])) {
                $formatted = implode('-', array(
                    $area,
                    substr($number, $len, $group[$area]),
                    substr($number, $len + $group[$area])
                ));
                return strrchr($formatted, '-') !== '-' ? $formatted : $input;
            }
        }
        $pattern = '/\A(00(?:[013-8]|2\d|91[02-9])\d)(\d++)\z/';
        if (preg_match($pattern, $number, $matches)) {
            return $matches[1] . '-' . $matches[2];
        }
        return $input;
    }

    //where and条件式
    public function trader_and_where($client_contractor, $client_address, $client_contractor_contact, $client_trader_id){
        $traders = Trader::all();
        //名前、住所、電話番号が取次店にあるかを確認し、無ければ登録
        $trader_id = $traders->where('trader_name', $client_contractor);
        if($trader_id->isNotEmpty()) {
            $trader_id = $trader_id->where('trader_address', $client_address);
        }
        if($trader_id->isNotEmpty()) {
            $trader_id = $trader_id->where('trader_phone', $client_contractor_contact);
        }
        if ($trader_id->isEmpty()) {
            $trader = new Trader;
            $trader['trader_name'] = $client_contractor;
            $trader['trader_address'] = $client_address;
            $trader['trader_phone'] = $client_contractor_contact;
            if($client_trader_id){
                $trader['introducer'] = $client_trader_id;
            }else{
                $trader['introducer'] = null;
            }
            $trader->save();
            $client_trader_id = $trader['id'];
        }
        $trader_id = $trader_id->first();

        return ['trader_id' => $trader_id, 'client_trader_id' => $client_trader_id];
    }

    //リグラント営業検索
    public function rigurant_Serach($user_login,$search) {
        $search_sales = User::where('login', $user_login)->select('username')->first();
        $search_username = $search_sales['username'];
        $method = new Client;
        $client_column = $method->column();

        //リグラント営業かつカラムの検索
        $clients = $client_column->where(function($client_column) use($search_username){
            $client_column->where('clients.sales_staff', $search_username);
        });
        $clients = $client_column->where(function($client_column) use($search){
            $client_column->where('important', 'LIKE', '%' . $search .'%')
            ->orwhere('caution','LIKE','%'.$search.'%')
            ->orwhere('sales_staff','LIKE','%'.$search.'%')
            ->orwhere('advertising','LIKE','%'.$search.'%')
            ->orwhere('survey_name','LIKE','%'.$search.'%')
            ->orwhere('member','LIKE','%'.$search.'%')
            ->orwhere('contractor','LIKE','%'.$search.'%')
            ->orwhere('clients.address','LIKE','%'.$search.'%')
            ->orwhere('clients.mail_address','LIKE','%'.$search.'%')
            ->orwhere('clients.fire_insurance_flg','LIKE','%'.$search.'%')
            ->orwhere('status_name','LIKE','%'.$search.'%')
            ->orwhere('action_date','LIKE','%'.$search.'%');
        });
        return ['search_username' => $search_username,'clients' => $clients];
    }

    //調査会社検索
    public function survey_Serach($user_login,$search) {
        $search_survey = User::where('login', $user_login)->select('survey_id')->first();
        $search_survey_id = $search_survey['survey_id'];
        $method = new Client;
        $client_column = $method->column();

        //調査会社かつカラムの検索
        $clients = $client_column->where(function($client_column) use($search_survey_id){
            $client_column->where('surveies.id',$search_survey_id);
        });
        $clients = $client_column->where(function($client_column) use($search){
            $client_column->where('important', 'LIKE', '%' . $search . '%')
            ->orwhere('caution','LIKE','%'.$search.'%')
            ->orwhere('submit_date','LIKE','%'.$search.'%')
            ->orwhere('member','LIKE','%'.$search.'%')
            ->orwhere('contractor','LIKE','%'.$search.'%')
            ->orwhere('contractor_contact','LIKE','%'.$search.'%')
            ->orwhere('clients.address','LIKE','%'.$search.'%')
            ->orwhere('clients.mail_address','LIKE','%'.$search.'%')
            ->orwhere('clients.fire_insurance_flg','LIKE','%'.$search.'%')
            ->orwhere('survey_date','LIKE','%'.$search.'%')
            ->orwhere('survey_referral','LIKE','%'.$search.'%');
        });
        return $clients;
    }

    //全画面検索
    public function all_Serach($search) {
        $method = new Client;
        $clients = $method->column()
        ->where('important', 'LIKE', '%' . $search . '%')
        ->orwhere('caution','LIKE','%'.$search.'%')
        ->orwhere('submit_date','LIKE','%'.$search.'%')
        ->orwhere('advertising','LIKE','%'.$search.'%')
        ->orwhere('member','LIKE','%'.$search.'%')
        ->orwhere('contractor','LIKE','%'.$search.'%')
        ->orwhere('clients.address','LIKE','%'.$search.'%')
        ->orwhere('contractor_contact','LIKE','%'.$search.'%')
        ->orwhere('building_age','LIKE','%'.$search.'%')
        ->orwhere('clients.mail_address','LIKE','%'.$search.'%')
        ->orwhere('clients.fire_insurance_flg','LIKE','%'.$search.'%')
        ->orwhere('insurance_company','LIKE','%'.$search.'%')
        ->orwhere('earthquake_flg','LIKE','%'.$search.'%')
        ->orwhere('status_name','LIKE','%'.$search.'%')
        ->orwhere('action_date','LIKE','%'.$search.'%')
        ->orwhere('action_note','LIKE','%'.$search.'%')
        ->orwhere('note','LIKE','%'.$search.'%')
        ->orwhere('payment_predict_date','LIKE','%'.$search.'%')
        ->orwhere('payment_expecte','LIKE','%'.$search.'%')
        ->orwhere('sales_staff','LIKE','%'.$search.'%')
        ->orwhere('survey_name','LIKE','%'.$search.'%')
        ->orwhere('survey_staff','LIKE','%'.$search.'%')
        ->orwhere('request_date','LIKE','%'.$search.'%')
        ->orwhere('scheduled_survey_date','LIKE','%'.$search.'%')
        ->orwhere('survey_date','LIKE','%'.$search.'%')
        ->orwhere('agreement_date','LIKE','%'.$search.'%')
        ->orwhere('accident_date','LIKE','%'.$search.'%')
        ->orwhere('insurance_policy_date','LIKE','%'.$search.'%')
        ->orwhere('certification_date','LIKE','%'.$search.'%')
        ->orwhere('bill_issue_date','LIKE','%'.$search.'%')
        ->orwhere('payment_date','LIKE','%'.$search.'%')
        ->orwhere('quo_card_date','LIKE','%'.$search.'%')
        ->orwhere('quotation_money','LIKE','%'.$search.'%')
        ->orwhere('certification_money','LIKE','%'.$search.'%')
        ->orwhere('certification_money_probability','LIKE','%'.$search.'%')
        ->orwhere('client_fee','LIKE','%'.$search.'%')
        ->orwhere('payment_money','LIKE','%'.$search.'%')
        ->orwhere('survey_referral','LIKE','%'.$search.'%')
        ->orwhere('survey_payment_money','LIKE','%'.$search.'%')
        ->orwhere('trader_referral','LIKE','%'.$search.'%')
        ->orwhere('trader_payment_money','LIKE','%'.$search.'%')
        ->orwhere('profit_money','LIKE','%'.$search.'%')
        ->orwhere('client_insurance_policies.image_title','LIKE','%'.$search.'%')
        ->orwhere('client_agreements.image_title','LIKE','%'.$search.'%')
        ->orwhere('client_reports.image_title','LIKE','%'.$search.'%')
        ->orwhere('client_quotations.image_title','LIKE','%'.$search.'%')
        ->orwhere('client_certifications.image_title','LIKE','%'.$search.'%')
        ->orwhere('client_drawings.image_title','LIKE','%'.$search.'%');
        return $clients;
    }

    //複数条件検索
    public function scopeSerach($client_status_id,$action_date,$action_note,$note) {
        $any_serach = new Client;
        $any_serach = $any_serach->column();
        // ステータス絞り込み
        if (!empty($client_status_id)) {
            $some_serach = $any_serach->where(function($any_serach) use($client_status_id) {
                $any_serach->where('client_status_id', $client_status_id);
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
        if (empty($client_status_id) && 
            empty($action_date) &&
            empty($action_note) &&
            empty($note)){
                $some_serach = $any_serach;
        }
        

        $some_serach = $some_serach->paginate(100);
        return $some_serach;
    }

    //並び替え
    public function sort($request,$clients,$sort) {
        $client_data = Crypt::decryptString($request->client_data);
        $client_data = json_decode($client_data, true);

        //並び替えの前に複数条件検索を行なっていた場合、配列を調整する。
        if(isset($client_data['data'])){
            $client_data = $client_data['data'];
        }

    
        foreach($client_data as $key => $value){
            $sort_keys[$key] = $value[$request->column];
        }
        array_multisort($sort_keys, $sort, $client_data);

        $num = count($client_data);
        
        for($i = 0; $i < $num; $i++){
            $clients[$i] = $client_data[$i];
        }
            
        if($num < count($clients)){
            for($int = $num; $num < count($clients); $int++){
                unset($clients[$int]);
            }
        }
    }

    //新規登録バリデーション
    public function create_validation($request) {
        $request->validate([
            'member' => ['required','max:10','regex:/^[0-9]+$/u',Rule::unique('clients')],
            'contractor' => ['required','max:255'],
            'address' => ['required','max:255'],
            'contractor_contact' => ['required','max:13','regex:/^[0-9]+$/u',Rule::unique('clients')],
            'quotation_money' => ['required','regex:/^[0-9]+$/u'],
            'certification_money' => ['required','regex:/^[0-9]+$/u'],
            'client_fee' => ['required','numeric'],
            'survey_referral' => ['required','numeric'],
            'trader_referral' => ['required','numeric'],
        ]);
    }

    //編集バリデーション
    public function edit_validation($request_id,$request) {

        $client = Model::find($request_id);

        $request->validate([
            'member' => ['required','max:10','regex:/^[0-9]+$/u',Rule::unique('clients')->ignore($client)],
            'contractor' => ['required','max:255'],
            'address' => ['required','max:255'],
            'contractor_contact' => ['required','max:13','regex:/^[0-9]+$/u',Rule::unique('clients')->ignore($client)],
            'quotation_money' => ['required','regex:/^[0-9]+$/u'],
            'certification_money' => ['required','regex:/^[0-9]+$/u'],
            'client_fee' => ['required','numeric'],
            'survey_referral' => ['required','numeric'],
            'trader_referral' => ['required','numeric'],
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
    public function document_exist($clients,$table,$form,$culum){
        if($clients['client_' . $culum . '_id'] == 1){
            $img = new $table;
            $img['image_title'] = $form[$culum . '_title'];
            $img['image_path'] = $form[$culum . '_read_path'];
            $img->save();
        }else{
            $img = $table::where('id', $clients['client_' . $culum . '_id'])->first();
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
        $format = '顧客リスト、ID：%d、氏名：%sを%sしました。';
        $logs->log = sprintf($format,$number,$name,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //個人顧客現状ST更新ログ
    public function log_change_status($id,$before_number,$before_status,$after_number,$after_status){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = 'id,%d,個人案件ステータス、%d：%sを%d：%sに更新しました。';
        $logs->log = sprintf($format,$id,$before_number,$before_status,$after_number,$after_status);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //個人顧客ステータスログ
    public function log_status($number,$name,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '個人ST編集、番号：%d、ステータス名：%sを%sしました。';
        $logs->log = sprintf($format,$number,$name,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //法人案件顧客チェックボックスログ
    public function log_check_box($number_json,$name_json,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '顧客リスト、%s、%s、を%sしました。';
        $logs->log = sprintf($format,$number_json,$name_json,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //法人案件顧客エクスポート・インポートログ
    public function log_port($action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '顧客リスト、を%sしました。';
        $logs->log = sprintf($format,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //csv_import headの名前
    public function head_name(){
        $head =[
            '連結日',
            '流入経路',
            'ID',
            '氏名',
            '住所',
            '物件名',
            '連絡先',
            'メールアドレス',
            '火災保険(1:加入 0:未加入)',
            '保険会社',
            '築年数',
            '地震 有/無',
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
            'クオカード送付日',
            '見積額',
            '認定額',
            '見積額の認定率（％）',
            '請求手数料（％）',
            '入金額',
            '調査会社手数料（％）',
            '調査会社支払額',
            '取次店手数料（％）',
            '取次店支払額',
            '利益額',
        ];
        return $head;
    }

    // ストリームに対して1行ごと書き出し
    public function stream($client){
        $stream_culum = [
            $client->submit_date,
            $client->advertising,
            $client->member,
            $client->contractor,
            $client->address,
            $client->buildingname,
            $client->contractor_contact,
            $client->mail_address,
            $client->fire_insurance_flg,
            $client->insurance_company,
            $client->building_age,
            $client->earthquake_flg,
            $client->status_number . ':' . $client->status_name,
            $client->action_date,
            $client->action_note,
            $client->note,
            $client->payment_predict_date,
            $client->payment_expecte,
            $client->sales_staff,
            $client->survey_name,
            $client->survey_staff,
            $client->request_date,
            $client->scheduled_survey_date,
            $client->survey_date,
            $client->agreement_date,
            $client->accident_date,
            $client->insurance_policy_date,
            $client->certification_date,
            $client->bill_issue_date,
            $client->payment_date,
            $client->quo_card_date,
            $client->quotation_money,
            $client->certification_money,
            $client->certification_money_probability,
            $client->client_fee,
            $client->payment_money,
            $client->survey_referral,
            $client->survey_payment_money,
            $client->trader_referral,
            $client->trader_payment_money,
            $client->profit_money,
        ];
        return $stream_culum;
    }

    //LP用都道府県データ
    public function prefecture(){
        $prefecture = [
            '北海道',
            '青森県',
            '岩手県',
            '宮城県',
            '秋田県',
            '山形県',
            '福島県',
            '茨城県',
            '栃木県',
            '群馬県',
            '埼玉県',
            '千葉県',
            '東京都',
            '神奈川県',
            '新潟県',
            '富山県',
            '石川県',
            '福井県',
            '山梨県',
            '長野県',
            '岐阜県',
            '静岡県',
            '愛知県',
            '三重県',
            '滋賀県',
            '京都府',
            '大阪府',
            '兵庫県',
            '奈良県',
            '和歌山県',
            '鳥取県',
            '島根県',
            '岡山県',
            '広島県',
            '山口県',
            '徳島県',
            '香川県',
            '愛媛県',
            '高知県',
            '福岡県',
            '佐賀県',
            '長崎県',
            '熊本県',
            '大分県',
            '宮崎県',
            '鹿児島県',
            '沖縄県'
        ];
        return $prefecture;
    }


    //調査会社おすすめ順
    public static function survey_recomend($request) {
        $surveies = Surveie::all();
        // 市区町村・地名・番地に分ける
        preg_match("/(.*?[市区町村])(\D*)([0-9])/u", $request->city, $city);
        // 火災保険加入していない場合
        if($request->fire_insurance == '0'){
            foreach($surveies as $key => $survey){
                $survey_add[$survey['survey_name']] = ['id' => $survey['id'],'address' => $survey['survey_address']];
                //都道府県,市町村に分ける
                preg_match("/(.*?[都道府県])(.*?[市区町村])(\D*)([0-9])/u", $survey['survey_address'], $address);
                $survey_recom[$key][0] = $survey['survey_name'];
                if($address[1] == $request->prefecture){
                    $survey_recom[$key][1] = $survey['survey_name'];
                    if($address[2] == $city[1]){
                        $survey_recom[$key][2] = $survey['survey_name']; 
                        if($address[3] == $city[2]){
                            $survey_recom[$key][3] = $survey['survey_name']; 
                            if($address[4] == $city[3]){
                                $survey_recom[$key][4] = $survey['survey_name']; 
                            }
                        }
                    }
                }else{
                    //都道府県が合致しないとき
                    $survey_recom[$key][0] = $survey['survey_name'];
                }
            }
        }else{ 
            // 火災保険加入している場合
            foreach($surveies as $key => $survey){
                $survey_add[$survey['survey_name']] = ['id' => $survey['id'],'address' => $survey['survey_address']];
                preg_match("/(.*?[都道府県])(.*?[市区町村])(\D*)([0-9])/u", $survey['survey_address'], $address);
                $survey_recom[$key][0] = $survey['survey_name'];
                if($address[1] == $request->prefecture){
                    $survey_recom[$key][1] = $survey['survey_name'];                    
                    if($address[2] == $city[1]){
                        $survey_recom[$key][2] = $survey['survey_name']; 
                        if($address[3] == $city[2]){
                            $survey_recom[$key][3] = $survey['survey_name']; 
                            if($address[4] == $city[3]){
                                $survey_recom[$key][4] = $survey['survey_name']; 
                            }
                        }
                    }
                }else{
                    //都道府県が合致しないとき
                    $survey_recom[$key][0] = $survey['survey_name'];
                }
            }
        }

        array_multisort($survey_recom, SORT_DESC); //降順に配列数で並び替える
        for($i=0; $i < 3; $i++){
            $survey_recoms[] = $survey_recom[$i][0];
        }

        return ['survey_recoms' => $survey_recoms, 'survey_add' => $survey_add];
    }

    //clientsテーブルの書き込みに必要な値をセットする
    public function lps_add_setup($lps){
        $lps['submit_date'] = date('Y-m-d');
        $lps['trader_id'] = '1';
        $lps['trader_referral'] = '0';
        $lps['trader_payment_money'] = '0';
        $lps['quotation_money'] = '0';
        $lps['certification_money'] = '0';
        $lps['certification_money_probability'] = '0';
        $lps['client_fee'] = '0';
        $lps['payment_money'] = '0';
        $lps['survey_referral'] = '0';
        $lps['survey_payment_money'] = '0';
        $lps['profit_money'] = '0';
        $lps['important'] = '☆';
        $lps['caution'] = '△';
        $lps['advertising'] = '申し込みページ';
        $lps['user_id'] = '1';
        $lps['client_status_id'] = '1';
        $lps['payment_expecte'] = '0%';
        $lps['client_drawing_id'] = '1';
        $lps['client_agreement_id'] = '1';
        $lps['client_insurance_policy_id'] = '1';
        $lps['client_report_id'] = '1';
        $lps['client_quotation_id'] = '1';
        $lps['client_certification_id'] = '1';
        $lps['client_bill_issue_id'] = '1';

        return $lps;
    }
    

    //LP用バリデーション
    public function lp_create_validation($request) {
        $request->validate([
            'contractor' => 'required',
            'prefecture' => 'required',
            'city' => ['required', 'regex:/.*?[市区町村]\D*[0-9]/u'],
            'fire_insurance_flg' => 'required',
            'contractor_contact' => ['required','max:13','regex:/^[0-9]+$/i',Rule::unique('clients')],
            'mail_address' => ['required','max:100',Rule::unique('clients')]
        ]);        
    }

}
