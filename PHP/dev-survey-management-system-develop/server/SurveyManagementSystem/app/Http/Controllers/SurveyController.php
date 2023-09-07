<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Auth as ModelAuth;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    //
    public function index(Request $request)
    {
        if(isset(Auth::user()->auth_id)){
            $authority = ModelAuth::where('id', Auth::user()->auth_id)->select('authority')->get();
            $authority = json_decode($authority,true);
            foreach($authority as $a){
                foreach($a as $authoritys){}
            }

            session()->put(['user_login'=> Auth::user()->login, 'authoritys' => $authoritys]);

            return redirect()->action('ClientController@all');

        }else{
            abort(404);
        }
    }

    // アカウントのパスワードリセット aoyagi
    public function pass_reset(Request $request)
    {
        return view('account/account_pass_reset');
        // パスワードのバリデーション。新しいパスワードは6文字以上、new_password_confirmationフィールドの値との一致しているかを確認する
        $request->validate([
            'new_password' => 'required|string|min:6'
        ]);

        // 現在登録しているパスワードと新しく登録するパスワードが異なることを確認する
        if ((Hash::check($request->get('new_password'), User::find($request->id)->password))) {
            return redirect()->back()->with('change_password_error', '新しいパスワードと現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        // 変更するパスワードと確認用のパスワードが一致していることを確認する
        if ($request->get('new_password') !== $request->get('new_password_confirmation')) {
            return redirect()->back()->with('change_password_error', '新しいパスワードと新しいパスワード(確認用)が違います。');
        }

        $form = $request->all();

        unset($form['_token']);
        $users = User::find($request->id);
        $users->password = Hash::make($form['new_password']);
        $users->save();

        return redirect()->back()->with('change_password_success', 'パスワードを変更しました。');
    }

    // アカウント詳細ページ aoyagi
    public function info(Request $request)
    {
        return view('account/account_info');
    }

}
