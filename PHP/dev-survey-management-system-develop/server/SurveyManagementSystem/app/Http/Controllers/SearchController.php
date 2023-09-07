<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Matter;
use App\Models\Status;
use App\Models\User;
use App\Models\SurveyCorp;
use App\Models\Answer;
use App\Models\Trader;
use App\Models\Question_status;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index() {

        return view('/search/search_index');
    }

    public function client_result(Request $request) {

        $query = Client::query();

        $query = $query->select(
            'clients.id',
            'traders.trader_name',
            'survey_corps.corp_name',
            'clients.member_id',
            'clients.contractor',
            'clients.contractor_kana',
            'clients.another_name',
            'clients.contractor_contact',
            'clients.responder',
            'clients.responder_kana',
            'clients.responder_contact',
            'clients.email',
            'clients.zipcode',
            'clients.prefectures',
            'clients.city',
            'clients.town_area',
            'clients.buildingname_roomnumber',
            'users.username',
            'question_statuses.disp_name');

        $query->join('survey_corps','clients.survey', '=', 'survey_corps.id');
        $query->join('traders','clients.trader', '=', 'traders.id');
        $query->join('users','clients.registered_user', '=', 'users.id');
        $query->join('question_statuses','clients.questionnaire', '=', 'question_statuses.id');
        
        $datas = $request->input('searchs');
        
        foreach($datas as $key => $data) {

            if($data['select_column'] == "trader") { //業者
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('trader_name','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('trader_name','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('trader_name','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('trader_name','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "survey") { //調査会社
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('corp_name','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('corp_name','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('corp_name','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('corp_name','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "member_id") { //会員番号
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('member_id','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('member_id','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('member_id','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('member_id','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "contractor") { //契約者
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('contractor','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('contractor','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('contractor','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('contractor','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "contractor_kana") { //契約者フリガナ
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('contractor_kana','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('contractor_kana','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('contractor_kana','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('contractor_kana','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "contractor_contact") { //契約者連絡先
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('contractor_contact','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('contractor_contact','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('contractor_contact','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('contractor_contact','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "responder") { //対応者
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('responder','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('responder','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('responder','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('responder','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "responder_kana") { //対応者フリガナ
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('responder_kana','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('responder_kana','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('responder_kana','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('responder_kana','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "responder_contact") { //対応者連絡先
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('responder_contact','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('responder_contact','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('responder_contact','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('responder_contact','not like','%'.$search_word.'%');
                }
            }
    
            if($data['select_column'] == "email") { //メールアドレス
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('email','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('email','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('email','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('email','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "zipcode") { //郵便番号
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('zipcode','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('zipcode','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('zipcode','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('zipcode','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "prefectures") { //都道府県
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('prefectures','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('prefectures','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('prefectures','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('prefectures','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "city") { //市区町村
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('city','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('city','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('city','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('city','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "town_area") { //町域
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('town_area','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('town_area','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('town_area','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('town_area','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "buildingname_roomnumber") { //建物名・部屋番号
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('buildingname_roomnumber','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('buildingname_roomnumber','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('buildingname_roomnumber','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('buildingname_roomnumber','not like','%'.$search_word.'%');
                }
            }

        }
        $clients = $query->get();

        return view('/search/search_client',['clients' => $clients]);
    }

    public function matter_result(Request $request) {
        // dd($request);
        $query = Matter::query();

        $query = $query->select(
            'matters.id',
            'traders.trader_name',
            'survey_corps.corp_name',
            'statuses.status_name',
            'matters.application_status',
            'matters.member_id',
            'matters.contractor',
            'matters.contractor_kana',
            'matters.contractor_contact',
            'matters.responder',
            'matters.responder_contact',
            'matters.email',
            'matters.zipcode',
            'matters.prefectures',
            'matters.city',
            'matters.town_area',
            'matters.buildingname_roomnumber',
            'users.username'
        );

        $query->join('statuses', 'matters.status', '=', 'statuses.id');
        $query->join('survey_corps','matters.survey', '=', 'survey_corps.id');
        $query->join('traders','matters.trader', '=', 'traders.id');
        $query->join('users','matters.registered_user', '=', 'users.id');

        $datas = $request->input('searchs');
        
        foreach($datas as $key => $data) {

            if($data['select_column'] == "trader") { //業者
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('trader_name','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('trader_name','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('trader_name','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('trader_name','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "survey") { //調査会社
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('corp_name','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('corp_name','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('corp_name','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('corp_name','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "member_id") { //会員番号(案件番号)
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('member_id','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('member_id','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('member_id','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('member_id','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "contractor") { //契約者
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('contractor','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('contractor','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('contractor','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('contractor','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "contractor_kana") { //契約者フリガナ
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('contractor_kana','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('contractor_kana','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('contractor_kana','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('contractor_kana','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "contractor_contact") { //契約者連絡先
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('contractor_contact','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('contractor_contact','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('contractor_contact','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('contractor_contact','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "responder") { //対応者
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('responder','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('responder','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('responder','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('responder','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "responder_contact") { //対応者連絡先
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('responder_contact','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('responder_contact','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('responder_contact','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('responder_contact','not like','%'.$search_word.'%');
                }
            }
    
            if($data['select_column'] == "email") { //メールアドレス
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('email','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('email','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('email','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('email','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "zipcode") { //郵便番号
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('zipcode','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('zipcode','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('zipcode','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('zipcode','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "prefectures") { //都道府県
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('prefectures','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('prefectures','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('prefectures','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('prefectures','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "city") { //市区町村
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('city','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('city','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('city','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('city','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "town_area") { //町域
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('town_area','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('town_area','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('town_area','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('town_area','not like','%'.$search_word.'%');
                }
            }

            if($data['select_column'] == "buildingname_roomnumber") { //建物名・部屋番号
                $search_word = $data['search_word'];
                if($data['select_terms'] == "1") { //等しい
                    $query->where('buildingname_roomnumber','=',$search_word);
                }elseif($data['select_terms'] == "2") { //等しくない
                    $query->where('buildingname_roomnumber','<>',$search_word);
                }elseif($data['select_terms'] == "3") { //含む
                    $query->where('buildingname_roomnumber','like','%'.$search_word.'%');
                }elseif($data['select_terms'] == "4") { //含まない
                    $query->where('buildingname_roomnumber','not like','%'.$search_word.'%');
                }
            }

        }
        $matters = $query->get();
        
        return view('/search/search_matter',['matters' => $matters]);
    }
}
