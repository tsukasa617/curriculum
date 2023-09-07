<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Surveie;
use App\Models\Client;

class LpController extends Controller
{
    //申し込み画面
    public function all() {
        $method = new Client;
        //都道府県
        $prefectures = $method->prefecture();

        return view('LP.lp_all',['prefectures' => $prefectures]);
    }

    //新規登録画面
    public function create(Request $request) {
        $method = new Client;
        
        
        $lps = $request->all();

        //入力された住所
        $address = $lps['prefecture'].$lps['city'];
        
        $lps = json_encode($lps,JSON_PRETTY_PRINT);
        $survey = $method->survey_recomend($request);
        //調査会社おすすめ順 名前
        $survey_recomends = $survey['survey_recoms'];
        //調査会社おすすめ順 住所
        $survey_add = $survey['survey_add'];
    
    
        return view('LP.lp_create',['lps' => $lps, 'address' => $address, 'survey_recomends' => $survey_recomends, 'survey_add' => $survey_add]);
    }

    //新規登録確認画面
    public function create_check(Request $request) {
    
        $method = new Client;
        $req_lp = json_decode($request->lps, true);

        foreach($req_lp as $key => $lp){
            $lps[$key] = $lp;
        }

        $lps['survey_name'] = $request->survey_name;
        $phone = $method->phone($lps['contractor_contact']);
        unset($lps['_token']);

        return view('LP.lp_create_check',['lps' => $lps,'phone'=>$phone]);
    }

    //新規登録
    public function add(Request $request) {
        try {
            $method = new Client; 
            $method->lp_create_validation($request);
            $lps = $request->all();

            //調査会社名からIDを取得
            $survey = Surveie::select("id")->where('survey_name','=',$request['survey_name'])->first();
            $lps['survey_id'] = $survey->id;

            //住所・登録日をセット
            $lps['address'] = $lps['prefecture'].$lps['city'];
            $lps['submit_date'] = date('Y-m-d');
            
            //最新のIDにインクリメントしてセット
            $maxId = $method->max('member') +1;
            $lps['member'] = $maxId;

            //clientsテーブル登録に必要な値をそれぞれセット
            $lps = $method->lps_add_setup($lps);

            // '_token'を$lpsから取り除く
            unset($lps['_token']); 

            $method->fill($lps); 
            $method->save(); 
            
            // 申し込み受付完了画面へリダイレクト
            return redirect('lp/complete'); 
        } catch (\Exception $e) {
            return redirect('lp/all')->with('error_message', 'フォーム送信に失敗しました。お手数ですが再度お試しください。'); 
        }
    }
}
