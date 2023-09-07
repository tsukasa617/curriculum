<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Surveie;
use App\Models\Trader;

class SurveyCorpController extends Controller
{
    public function all() {

        //ログインIDと権限をsessionに保存
        $method = new Surveie;
        $method->auth('App\Models\Auth', 'Illuminate\Support\Facades\Auth');

        $survey_corps = Surveie::paginate(60);
        //電話番号に-入れる
        foreach($survey_corps as $survey_corp) {
            $survey_corp['survey_phone'] = $method->phone($survey_corp['survey_phone']);
        }

        return view('surveycorp/surveycorp_all',['values' => $survey_corps]);
    }

    //担当案件表示
    public function Responsible(Request $request) {

    }

    //調査会社新規登録
    public function create() {

        //ログインIDと権限をsessionに保存
        $method = new Surveie;
        $method->auth('App\Models\Auth', 'Illuminate\Support\Facades\Auth');

        return view('surveycorp/surveycorp_create');
    }

    //調査会社登録内容確認
    public function create_check(Request $request) {

        //ログインIDと権限をsessionに保存
        $method = new Surveie;
        $method->auth('App\Models\Auth', 'Illuminate\Support\Facades\Auth');

        $request->validate([
            'survey_name'=>['required','max:100','unique:surveies'],
            'survey_address'=>['required','max:100'],
        ]);

        $survey_corp = $request->all();

        return view('surveycorp/surveycorp_create_check', ['values' => $survey_corp]);
    }

    //調査会社登録処理
    public function add(Request $request) {
        try {
            $request->validate([

                'survey_name'=>['required','max:100','unique:surveies'],
                'survey_zipcode'=>['max:7'],
                'survey_address'=>['required','max:100'],
                'survey_phone'=>['max:13'],
                'survey_mail'=>['max:100'],
                'survey_url'=>['max:255'],
            ]);

            $form = $request->all();
            unset($form['_token']);

            // $survey_corps = new SurveyCorp;
            $survey_corps = new Surveie;
            $survey_corps->fill($form);
            $survey_corps->save();

            //操作ログ
            $id = Surveie::orderby('id','desc')->select('id')->first();
            $survey_corps->log_all((int)$id['id'],$form['survey_name'],'新規登録');

            return redirect('survey_corp/all')->with('success_message', '登録に成功しました。');
        } catch (\Exception $e) {
            return view('surveycorp/surveycorp_create')->with('error_message', '登録に失敗しました。再度お試しください。');
        }
    }

    //調査会社詳細
    public function detail(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Surveie;
        $method->auth('App\Models\Auth', 'Illuminate\Support\Facades\Auth');

        // $survey_corps = SurveyCorp::find($request->id);
        $survey_corp = Surveie::find($request->id);
        //電話番号に-入れる
        $survey_corp['survey_phone'] = $method->phone($survey_corp['survey_phone']);

        return view('surveycorp/surveycorp_detail',['survey_corp' => $survey_corp]);
    }

    public function edit(Request $request) {

        //ログインIDと権限をsessionに保存
        $method = new Surveie;
        $method->auth('App\Models\Auth', 'Illuminate\Support\Facades\Auth');

        // $survey_corp = SurveyCorp::where('id',$request->id)
        $survey_corp = Surveie::where('id',$request->id)
        ->find($request->id);

        return view('surveycorp/surveycorp_edit',['values' => $survey_corp]);
    }

    public function edit_check(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new Surveie;
        $method->auth('App\Models\Auth', 'Illuminate\Support\Facades\Auth');

        $survey_name = Surveie::where('id',$request->id)->first();

        $survey_name = $survey_name['survey_name'];

        if($request->survey_name !== $survey_name){
            $request->validate([
                // 'corp_name'=>['required','max:100','unique:survey_corps'],
                'survey_name'=>['required','max:100','unique:surveies'],
            ]);
        }

        $request->validate([
            'survey_zipcode'=>['max:7'],
            'survey_address'=>['required','max:100'],
            'survey_phone'=>['max:13'],
            'survey_mail'=>['max:100'],
            'survey_url'=>['max:255'],
            //'requester'=>['required'],
        ]);

        //$traders = Trader::all();

        $survey_corp = $request->all();

        return view('surveycorp/surveycorp_edit_check',['values' => $survey_corp]);
    }

    public function update(Request $request)
    {
        try {
            // $survey_corp = SurveyCorp::find($request->id);
            $survey_corp = Surveie::find($request->id);
            $survey_name = $survey_corp['survey_name'];

            if($request->survey_name !== $survey_name){
                $request->validate([
                    // 'corp_name'=>['required','max:100','unique:survey_corps'],
                    'survey_name'=>['required','max:100','unique:surveies'],
                ]);
            }

            $request->validate([
                'survey_zipcode'=>['max:7'],
                'survey_address'=>['required','max:100'],
                'survey_phone'=>['max:13'],
                'survey_mail'=>['max:100'],
                'survey_url'=>['max:255'],
            ]);

            $form = $request->all();
            unset($form['_token']);
                
            $survey_corp->fill($form);
            $survey_corp->save();

            //操作ログ
            $method = new Surveie;
            $method->log_all((int)$form['id'],$form['survey_name'],'編集');

            return redirect('survey_corp/all')->with('success_message', '更新に成功しました');
        } catch (\Exception $e) {
            return redirect()->action('SurveyCorpController@edit', ['id' => $request->id])->with('error_message', '更新に失敗しました。再度お試しください。');
        }
    }

    //削除機能
    public function delete(Request $request)
    {
        try {
            $survey_corps = Surveie::find($request->id);

            //操作ログ
            $method = new Surveie;
            $method->log_all((int)$survey_corps['id'],$survey_corps['survey_name'],'削除');

            $survey_corps->delete();

            return redirect('survey_corp/all')->with('success_message', '削除に成功しました');
        } catch (\Exception $e) {
            return redirect()->action('SurveyCorpController@edit', ['id' => $request->id])->with('error_message', '更新に失敗しました。再度お試しください。');
        }
    }

}
