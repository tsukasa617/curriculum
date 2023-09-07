<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    //顧客の情報を取得し保険申請日が新しい順に並び替える
    public function map_info($id)
    {
        //Clientsを指定
        $table = DB::table('clients');

        //保険加入日と入金額の最新5件を取得
        $client_infos = $table->select('insurance_policy_date','payment_money')
                              ->where('survey_id', $id)
                              ->orderBy('insurance_policy_date', 'desc')
                              ->limit(5)
                              ->get();
        
        //案件数を取得
        $case_count = $table->select('insurance_policy_date','payment_money')
                            ->where('survey_id', $id)
                            ->count();

        return response()->json(['client_infos'=>$client_infos,'case_count'=>$case_count], JSON_UNESCAPED_UNICODE);
    }
}
