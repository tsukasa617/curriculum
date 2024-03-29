<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Models\Auth as ModelAuth;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\User;
use App\Models\Reward;

//論理削除
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\UnionType;

class Trader extends Model
{
    //論理削除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = array('id');

    //ログインIDと権限をsessionに保存
    public function auth(){
        if(session()->get('authoritys') == null){
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
        $traders = Model::select(
            //No
            'traders.id',
            //紹介者  （追加）
            'traders.introducer',
            //VIP  （追加）
            'traders.vip_flg',
            //取次店
            'traders.trader_name',
            //法人・個人  （追加）
            'traders.business_form',
            //メールアドレス
            'traders.trader_email',
            //所属企業  （追加）
            'traders.affiliated_company',
            //役職  （追加）
            'traders.position',
            //郵便番号
            'traders.trader_zipcode',
            //住所
            'traders.trader_address',
            //電話番号
            'traders.trader_phone',
            //電話番号２  （追加）
            'traders.trader_phone_2',
            //金融機関  （追加）
            'traders.financial_institution',
            //支店名  （追加）
            'traders.financial_branch',
            //口座種類  （追加）
            'traders.bank_acount_kinds',
            //口座番号  （追加）
            'traders.bank_acount_number',
            //口座名義  （追加）
            'traders.bank_acount_name',
            //契約書送付日  （追加）
            'traders.contract_sending_date',
            //契約書締結日  （追加）
            'traders.contract_conclusion_date',
            //秘密保持契約書データ送付日  （追加）
            'traders.secret_contract_date',
            //契約画像id(追加)
            'traders.trader_contract_conclusion_id',
            //契約画像(追加)
            'trader_contract_conclusions.image_path',
            //契約画像タイトル(追加)
            'trader_contract_conclusions.image_title',
            //主な案件  （追加）
            'traders.main_project',
            //備考  （追加）
            'traders.trader_note')
            ->join('trader_contract_conclusions', 'traders.trader_contract_conclusion_id', '=', 'trader_contract_conclusions.id');
            return $traders;
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

    //バリデーション
    public function validation($request) {
        $request->validate([
            'trader_name'=>'required',
            'trader_email'=>'required|max:100',
            'affiliated_company'=>'required',
            'trader_zipcode'=>'required|max:7|regex:/^[0-9]+$/i',
            'trader_phone'=>'required|max:13|regex:/^[0-9]+$/i',
            'trader_phone_2'=>'max:13|regex:/^[0-9]+$/i',
            'bank_acount_number'=>'min:6|max:18|regex:/^[0-9]+$/i',
        ]);
    }

    //取次店ログ
    public function log_all($number,$name,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '法人案件取次店一覧、No：%d、取次店：%sを%sしました。';
        $logs->log = sprintf($format,$number,$name,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //法人案件顧客チェックボックスログ
    public function log_check_box($number_json,$name_json,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '法人案件取次店一覧、%s、%s、を%sしました。';
        $logs->log = sprintf($format,$number_json,$name_json,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //法人案件顧客エクスポート・インポートログ
    public function log_port($action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '法人案件取次店一覧、を%sしました。';
        $logs->log = sprintf($format,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //報酬・詳細一覧から支払額を見る
    public function detail_request($request){
        $client_payment_money = '';
        if(isset($request->client_id)){
            $client_payment_money = Client::select('trader_payment_money')->find($request->client_id);
            $client_payment_money = $client_payment_money['trader_payment_money'];
        }
        $matter_payment_money_1 = '';
        if(isset($request->matter_id)){
            $matter_payment_money_1 = Matter::select('trader_payment_money_1')->find($request->matter_id);
            $matter_payment_money_1 = $matter_payment_money_1['trader_payment_money_1'];
        }
        $matter_payment_money_2 = '';
        if(isset($request->matter_id_2)){
            $matter_payment_money_2 = Matter::select('trader_payment_money_2')->find($request->matter_id_2);
            $matter_payment_money_2 = $matter_payment_money_2['trader_payment_money_2'];
        }
        $matter_payment_money_3 = '';
        if(isset($request->matter_id_3)){
            $matter_payment_money_3 = Matter::select('trader_payment_money_3')->find($request->matter_id_3);
            $matter_payment_money_3 = $matter_payment_money_3['trader_payment_money_3'];
        }

        return ['client_payment_money' => $client_payment_money,'matter_payment_money_1' => $matter_payment_money_1,'matter_payment_money_2' => $matter_payment_money_2,'matter_payment_money_3' => $matter_payment_money_3];
    }

    //顧客報酬カラム
    public function column_reward(){
        $traders = Trader::select('id','trader_name');

        $clients = Reward::select(
            //個人 id
            'rewards.client_id',
            //法人 id
            'rewards.matter_id',
            //ステータス ID 個人
            'clients.client_status_id',
            //ステータス ID 個人
            'clients.client_status_id as matter_status_id',
            //ステータス 名前 個人
            'client_statuses.status_name',
            //ステータス 番号 個人
            'client_statuses.status_number',
            //入金日 個人
            'clients.payment_date',
            //ID 個人
            'clients.member',
            //氏名 個人
            'clients.contractor',
            //物件名 個人
            'clients.buildingname',
            //取次店 ID 個人
            'clients.trader_id',
            //取次店 名前 個人
            'traders.trader_name',
            //unionするための数合わせ
            'clients.payment_date as mattter_1',
            'clients.payment_date as mattter_2',
            'clients.payment_date as mattter_3',
            'clients.payment_date as mattter_4'
        )
        ->whereNotNull('client_id')
        ->where('clients.deleted_at', null)
        ->Join('clients', 'rewards.client_id', '=' , 'clients.id')
        ->Join('traders', 'clients.trader_id', '=' , 'traders.id')
        ->join('client_statuses', 'clients.client_status_id', '=', 'client_statuses.id');

        $matters = Reward::select(
            //個人 id
            'rewards.client_id',
            //法人 id
            'rewards.matter_id',
            //キー名を変更するため
            'matters.matter_status_id as client_status_id',
            //ステータス ID 法人
            'matters.matter_status_id',
            //ステータス 名前 法人
            'matter_statuses.status_name',
            //ステータス 番号 法人
            'matter_statuses.status_number',
            //入金日 法人
            'matters.payment_date',
            //ID 法人
            'matters.member',
            //会社名 法人
            'matters.contractor',
            //物件名 法人
            'matters.buildingname',
            //取次店 ID 法人
            'matters.trader_id',
            //取次店 名前 法人
            'traders.trader_name',
            //取次店２ ID 法人
            'matters.agency_store_2',
            //取次店２ ID 法人
            'agency_store_2.trader_name as agency_store_2_name',
            //取次店３ ID 法人
            'matters.agency_store_3',
            //取次店3 ID 法人
            'agency_store_3.trader_name as agency_store_3_name'
        )->whereNotNull('matter_id')
        ->where('matters.deleted_at', null)
        ->Join('matters', 'rewards.matter_id', '=' , 'matters.id')
        ->Join('traders', 'matters.trader_id', '=' , 'traders.id')
        ->joinSub($traders,'agency_store_2', function($join) {$join->on('matters.agency_store_2', '=', 'agency_store_2.id');})
        ->joinSub($traders,'agency_store_3', function($join) {$join->on('matters.agency_store_3', '=', 'agency_store_3.id');})
        ->join('matter_statuses', 'matters.matter_status_id', '=', 'matter_statuses.id');

        return ['clients' => $clients, 'matters' => $matters];
    }

    //顧客報酬カラム
    public function search_reward($search){
        if($search == ''){
            $trader_rewards = '';
            return $trader_rewards;
        }
        $method = new Trader;
        $columns = $method->column_reward();

        $clients = $columns['clients']
        ->where('status_name', 'LIKE', '%' . $search . '%')
        ->orWhere('payment_date','LIKE','%'.$search.'%')
        ->orwhere('member','LIKE','%'.$search.'%')
        ->orwhere('contractor','LIKE','%'.$search.'%')
        ->orwhere('buildingname','LIKE','%'.$search.'%')
        ->orwhere('traders.trader_name','LIKE','%'.$search.'%');

        $matters = $columns['matters']
        ->where('status_name', 'LIKE', '%' . $search . '%')
        ->orWhere('payment_date','LIKE','%'.$search.'%')
        ->orwhere('member','LIKE','%'.$search.'%')
        ->orwhere('contractor','LIKE','%'.$search.'%')
        ->orwhere('buildingname','LIKE','%'.$search.'%')
        ->orwhere('traders.trader_name','LIKE','%'.$search.'%')
        ->orwhere('agency_store_2.trader_name','LIKE','%'.$search.'%')
        ->orwhere('agency_store_3.trader_name','LIKE','%'.$search.'%');

        $columns = $matters->union($clients)->orderby('payment_date', 'ASC')->get();
        
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

        return $trader_rewards;
    }

    //法人案件顧客チェックボックスログ
    public function log_reward_check_box($table,$number_json,$name_json,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '取次店報酬・詳細一覧、%s、%s、%s、を%sしました。';
        $logs->log = sprintf($format,$table,$number_json,$name_json,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //個人顧客現状ST更新ログ
    public function log_change_status($id,$before_number,$table,$before_status,$after_number,$after_status){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = '取次店報酬・詳細一覧、id, %d, %s、%d：%sを%d：%sに更新しました。';
        $logs->log = sprintf($format,$id,$before_number,$table,$before_status,$after_number,$after_status);
        $logs->user_id = $users['id'];
        $logs->save();
    }

}
