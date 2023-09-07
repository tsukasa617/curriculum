<?php

namespace App\Http\Controllers;

use App\Models\Auth as ModelAuth;
use App\Traits\Logging;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    use Logging;
    //
    public function all(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new ModelAuth;
        $method->auth();

        $auths = $method->column()->paginate(15);

        return view('auth_blade/auth_all',['auths' => $auths]);
    }

    public function create()
    {
        //ログインIDと権限をsessionに保存
        $method = new ModelAuth;
        $method->auth();

        $auths = ModelAuth::all();

        return view('auth_blade/auth_create',["auths" => $auths]);
    }

    public function create_check(Request $request)
    {
        $method = new ModelAuth;

        //新規登録バリデーション
        $method->create_validation($request);

        //ログインIDと権限をsessionに保存
        $method->auth();

        $auths = $request->all();

        if(isset($auths['authority_edit']) == false){
            $auths['authority_edit'] = '';
        }
        if(isset($auths['authority_delete']) == false){
            $auths['authority_delete'] = '';
        }
        if(isset($auths['authority_add']) == false){
            $auths['authority_add'] = '';
        }
        if(isset($auths['authority_user']) == false){
            $auths['authority_user'] = '';
        }
        if(isset($auths['authority_sales']) == false){
            $auths['authority_sales'] = '';
        }
        if(isset($auths['authority_survey']) == false){
            $auths['authority_survey'] = '';
        }
        if(isset($auths['authority_all_column']) == false){
            $auths['authority_all_column'] = '';
        }

        $authority_values['values'] = array('1' => $auths['authority_edit'], '2' => $auths['authority_delete'], '3' => $auths['authority_add'], '4' => $auths['authority_user'], '5' => $auths['authority_sales'], '6' => $auths['authority_survey'], '7' => $auths['authority_all_column']);

        $authority_values['values'] = array_filter($authority_values['values']);

        $authority_json = json_encode($authority_values['values'],JSON_UNESCAPED_UNICODE);

        return view('auth_blade/auth_create_check',['auths' => $auths, 'authority_values' => $authority_values, 'authority_json' => $authority_json]);
    }

    public function create_add(Request $request)
    {
        try {
            $auths = new ModelAuth;

            //新規登録バリデーション
            $auths->create_validation($request);

            $form = $request->all();
            unset($form['_token']);

            $auths['authority'] = json_decode($form['authority']);
            $auths['auth_name'] = $form['auth_name'];

            $auths->save();

            //権限ログ
            $id = ModelAuth::orderby('id','desc')->select('id')->first();
            $format = '権限管理、ID：%d、権限：%sを%sしました。';
            $this->createLogTypeA($format, (int)$id['id'], $form['auth_name'], '新規登録');

            return redirect('auth/all')->with('success_message', '登録に成功しました。');
        } catch (\Exception $e) {
            return redirect('auth/create')->with('error_message', '登録に失敗しました。再度お試しください。');
        }
    }

    public function edit(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new ModelAuth;
        $method->auth();

        $auths = $method->column()->find($request->id);

        if(isset($auths['authority'][1]) == false){
            $auths['authority'] += array( 1 =>'');
        }
        if(isset($auths['authority'][2]) == false){
            $auths['authority'] += array( 2 =>'');
        }
        if(isset($auths['authority'][3]) == false){
            $auths['authority'] += array( 3 =>'');
        }
        if(isset($auths['authority'][4]) == false){
            $auths['authority'] += array( 4 =>'');
        }
        if(isset($auths['authority'][5]) == false){
            $auths['authority'] += array( 5 =>'');
        }
        if(isset($auths['authority'][6]) == false){
            $auths['authority'] += array( 6 =>'');
        }
        if(isset($auths['authority'][7]) == false){
            $auths['authority'] += array( 7 =>'');
        }

        return view('auth_blade/auth_edit',["auths" => $auths]);
    }

    public function edit_check(Request $request)
    {
        $method = new ModelAuth;

        //編集バリデーション
        $method->edit_validation($request->id,$request);

        //ログインIDと権限をsessionに保存
        $method->auth();

        $auths = $request->all();

        if(isset($auths['authority_edit']) == false){
            $auths['authority_edit'] = '';
        }
        if(isset($auths['authority_delete']) == false){
            $auths['authority_delete'] = '';
        }
        if(isset($auths['authority_add']) == false){
            $auths['authority_add'] = '';
        }
        if(isset($auths['authority_user']) == false){
            $auths['authority_user'] = '';
        }
        if(isset($auths['authority_sales']) == false){
            $auths['authority_sales'] = '';
        }
        if(isset($auths['authority_survey']) == false){
            $auths['authority_survey'] = '';
        }
        if(isset($auths['authority_all_column']) == false){
            $auths['authority_all_column'] = '';
        }

        $authority_values['values'] = array('1' => $auths['authority_edit'], '2' => $auths['authority_delete'], '3' => $auths['authority_add'], '4' => $auths['authority_user'], '5' => $auths['authority_sales'], '6' => $auths['authority_survey'], '7' => $auths['authority_all_column']);

        $authority_values['values'] = array_filter($authority_values['values']);

        $authority_json = json_encode($authority_values['values'],JSON_UNESCAPED_UNICODE);

        return view('auth_blade/auth_edit_check',['auths' => $auths, 'authority_values' => $authority_values, 'authority_json' => $authority_json]);
    }

    public function update(Request $request)
    {
        try {
            $method = new ModelAuth;

            //編集バリデーション
            $method->edit_validation($request->id,$request);

            $auths = ModelAuth::find($request->id);

            $form = $request->all();
            unset($form['_token']);

            $auths['authority'] = json_decode($form['authority']);
            $auths['auth_name'] = $form['auth_name'];

            $auths->save();

            //権限ログ
            $method->log_all((int)$auths['id'],$form['auth_name'],'編集');

            return redirect('auth/all')->with('success_message', '編集に成功しました。');
        } catch (\Exception $e) {
            return redirect('auth/create')->with('error_message', '編集に失敗しました。再度お試しください。');
        }
    }

    public function delete(Request $request)
    {
        $auths = ModelAuth::find($request->id);

        //権限ログ
        $method = new ModelAuth;
        $method->log_all((int)$auths['id'],$auths['auth_name'],'削除');

        $auths->delete();

        return redirect('auth/all')->with('success_message', '削除しました。');
    }
}
