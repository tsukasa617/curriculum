<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Surveie;
use App\Models\Trader;
use App\Models\Auth as ModelAuth;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

// use App\Exports\UsersExport;
// use App\Exports\User_detailExport;

class UserController extends Controller
{
    //
    public function all(Request $request)
    {

        //ログインIDと権限をsessionに保存
        $method = new User;
        $method->auth();

        $users = $method->column()
        ->orderBy('surveies.id', 'asc')
        ->orderBy('users.login', 'asc')
        ->paginate(100);

        return view('user/user_all',['users' => $users]);
    }

    //キーワード検索
    public function filter_search(Request $request) {
        
        //ログインIDと権限をsessionに保存
        $method = new User;
        $method->auth();

        $search = $request->search;

        $users = $method->column()->paginate(10);

        $users = $method->column()
            ->where('login','LIKE','%'.$search.'%')
            ->orwhere('username','LIKE','%'.$search.'%')
            ->orwhere('survey_name','LIKE','%'.$search.'%')
            ->orwhere('auth_name','LIKE','%'.$search.'%')
            ->orwhere('trader_name','LIKE','%'.$search.'%')
            ->orderBy('surveies.id', 'asc')
            ->orderBy('users.login', 'asc')
            ->paginate(10);

        return view('user/user_all',['users' => $users]);
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
            $users = '';
            $users = User::find($val['id']);
            $users_login[] = ['ログインID' => $users['login']];
            $users_username[] = ['氏名' => $users['username']];
            $data = $users->delete();
        }

        //操作ログ
        $method = new User;

        $users_login = json_encode($users_login,JSON_UNESCAPED_UNICODE);
        $users_username = json_encode($users_username,JSON_UNESCAPED_UNICODE);

        $method->log_check_box($users_login,$users_username,'削除');

        return response()->json($data);
    }

    public function create()
    {
        //ログインIDと権限をsessionに保存
        $method = new User;
        $method->auth();

        $auths = ModelAuth::all();
        $surveies = Surveie::all();
        $traders = Trader::all();

        return view('user/user_create',["auths" => $auths,"surveies" => $surveies,"traders" => $traders]);
    }

    public function create_check(Request $request)
    {
        $method = new User;

        //ハッシュされたパスワードと現在のパスワードを比較
        $passes = User::select('password')->get();
        foreach($passes as $pass){
            if(Hash::check($request->password, $pass['password'])) {
                $request->validate([
                    'password_dummy'=>['required']
                ]);
            }
        }

        //新規登録バリデーション
        $method->create_validation($request);

        //ログインIDと権限をsessionに保存
        $method->auth();

        $users = $request->all();

        $auths = ModelAuth::find($request->auth_id);
        $survey = Surveie::find($request->survey_id);

        if($request->trader_id == ''){
            $traders = ['id' => '', 'trader_name' => ''];
            $users['trader_id'] = '1';
        }else{
            $traders = Trader::find($request->trader_id);
        }

        return view('user/user_create_check',['users' => $users, "auths" => $auths, "survey" => $survey, "traders" => $traders]);
    }

    public function create_add(Request $request)
    {
        try {
            $users = new User;

            //新規登録バリデーション
            $request->validate([
                'login'=>['required','max:30','regex:/^[0-9]+$/i','unique:users'],
                'username'=>['required'],
                'password'=>['required','string','unique:users','min:6'],
                'survey_id'=>['required'],
                'auth_id'=>['required']
            ]);

            $form = $request->all();
            unset($form['_token']);
            
            $users->login = $form['login'];
            $users->username = $form['username'];
            $users->password = Hash::make($form['password']);
            $users->survey_id = $form['survey_id'];
            $users->auth_id = $form['auth_id'];
            $users->trader_id = $form['trader_id'];
            
            $users->save();

            //操作ログ
            $users->log_all((int)$form['login'],$form['username'],'新規作成');
    
            return redirect('user/all')->with('success_message', '登録に成功しました。');
        } catch (\Exception $e) {
            return redirect('user/create')->with('error_message', '登録に失敗しました。再度お試しください。');
        }
    }

    public function edit(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new User;
        $method->auth();

        $users = $method->column()->find($request->input('id'));

        $auths = ModelAuth::all();
        $surveies = Surveie::all();
        $traders = Trader::all();

        return view('user/user_edit',['users' => $users, "auths" => $auths, "surveies" => $surveies, "traders" => $traders]);
    }

    public function edit_check(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new User;
        $method->auth();

        //編集バリデーション
        $method->edit_validation($request->id,$request);

        $users = $request->all();

        $survey_name = Surveie::where('id', $users['survey_id'])->select('survey_name')->first();

        $auth_name = ModelAuth::where('id', $users['auth_id'])->select('auth_name')->first();

        $trader_name = Trader::where('id', $users['trader_id'])->select('trader_name')->first();

        return view('user/user_edit_check',['users' => $users, 'survey_name' => $survey_name, 'auth_name' => $auth_name, 'trader_name' => $trader_name]);
    }

    public function update(Request $request)
    {
        try {
            $method = new User;
            
            //編集バリデーション
            $method->edit_validation($request->id,$request);
    
            $users = User::find($request->id);
    
            $form = $request->all();
            unset($form['_token']);
    
            $users->login = $form['login'];
            $users->username = $form['username'];
            $users->survey_id = $form['survey_id'];
            $users->auth_id = $form['auth_id'];
            $users->trader_id = $form['trader_id'];
            
            $users->save();

            //操作ログ
            $method->log_all((int)$form['login'],$form['username'],'編集');
    
            return redirect('user/all')->with('success_message', '編集に成功しました。');
        } catch (\Exception $e) {
            return redirect('user/edit', ['id' => $request->id])->with('error_message', '編集に失敗しました。再度お試しください。');
        }
    }

    public function delete(Request $request)
    {
        $users = User::find($request->id);

        //操作ログ
        $method = new User;
        $method->log_all((int)$users['login'],$users['username'],'削除');

        $users->delete();

        return redirect('user/all')->with('success_message', '削除に成功しました。');
    }

    public function pass_set(Request $request)
    {
        //ログインIDと権限をsessionに保存
        $method = new User;
        $method->auth();

        $users = User::find($request->id);
        
        return view('user/pass_set',['users' => $users]);
    }

    public function pass_reset(Request $request)
    {
        // パスワードのバリデーション。新しいパスワードは6文字以上、new_password_confirmationフィールドの値との一致しているかを確認する
        $request->validate([
            'new_password' => 'required|string|min:6',
            // 'new_password' => 'required|string|min:6|confirmed', 確認メッセージの呼び出し
        ]);

        // 現在登録しているパスワードと新しく登録するパスワードが異なることを確認する
        if ((Hash::check($request->new_password, User::find($request->id)->password))) {
            return redirect()->back()->with('change_password_error', '新しいパスワードと現在のパスワードと同じです。違うパスワードを設定してください。');
        }

        // 変更するパスワードと確認用のパスワードが一致していることを確認する
        if ($request->new_password !== $request->new_password_confirmation ) {
            return redirect()->back()->with('change_password_error', '新しいパスワードと新しいパスワード(確認用)が違います。');
        }

        /*$form = $request->all();

        unset($form['_token']);*/
        $users = User::find($request->id);
        $users->password = Hash::make($request->new_password);
        $users->save();

        //操作ログ
        $method = new User;
        $method->log_all((int)$users['login'],$users['username'],'パスワード変更');

        return redirect('user/all')->with('change_password_success', 'パスワードを変更しました。');
    }
}
