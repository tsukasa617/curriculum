<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Auth as ModelAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Log;

//論理削除
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    //論理削除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
        // 'name', 'email', 'password',
    // ];

    protected $fillable = [
        'username',
        'password',
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    /* protected $casts = [
        'email_verified_at' => 'datetime',
    ]; */

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

    //ユーザーカラム
    public function column(){
        $users = Authenticatable::select(
            'users.id',
            'users.login',
            'users.username',
            'surveies.survey_name',
            'auths.auth_name',
            'traders.trader_name',
            'users.created_at',
            'users.updated_at'
        )
        ->join('surveies', 'users.survey_id', '=', 'surveies.id')
        ->join('auths', 'users.auth_id', '=', 'auths.id')
        ->join('traders', 'users.trader_id', '=', 'traders.id');
        return $users;
    }

    //新規登録バリデーション
    public function create_validation($request) {
        $request->validate([
            'login'=>['required','max:30','regex:/^[0-9]+$/i','unique:users'],
            'username'=>['required'],
            'password'=>['required','string','confirmed','min:6'],
            'survey_id'=>['required'],
            'auth_id'=>['required']
        ]);
    }

    //編集バリデーション
    public function edit_validation($request_id,$request) {

        $login = Authenticatable::find($request_id);

        $request->validate([
            'login'=>['required','max:30',Rule::unique('users')->ignore($login),'regex:/^[0-9]+$/i'],
            'username'=>['required'],
            'survey_id'=>['required'],
            'auth_id'=>['required']
        ]);
    }

    //アカウント管理ログ
    public function log_all($number,$name,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = 'アカウント管理、ログインID：%d、氏名：%sを%sしました。';
        $logs->log = sprintf($format,$number,$name,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }

    //アカウント管理チェックボックスログ
    public function log_check_box($number_json,$name_json,$action){
        $user_login = session()->get('user_login');
        $users = User::where('login', $user_login)->first();
        $logs = new Log;
        $format = 'アカウント管理、%s、%s、を%sしました。';
        $logs->log = sprintf($format,$number_json,$name_json,$action);
        $logs->user_id = $users['id'];
        $logs->save();
    }
}
