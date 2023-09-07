<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Log;

//論理削除
use Illuminate\Database\Eloquent\SoftDeletes;

class Auth extends Model
{
    //論理削除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = array('id');

    protected $casts = ['authority' => 'json'];

    //ログインIDと権限をsessionに保存
    public function auth(){
        if(session()->put('authoritys') == null){
            $authority = Model::where('id', FacadesAuth::user()->auth_id)->select('authority')->get();
            $authority = json_decode($authority,true);
            foreach($authority as $a){
                foreach($a as $authoritys){}
            }
            session()->put(['user_login'=> FacadesAuth::user()->login, 'authoritys' => $authoritys]);
        }
    }

    //権限カラム
    public function column(){
        $auths = Model::select(
            'id',
            'authority',
            'auth_name'
        );
        return $auths;
    }

    //新規登録バリデーション
    public function create_validation($request) {
        $request->validate([
            'auth_name'=>['required','unique:auths']
        ]);
    }

    //編集バリデーション
    public function edit_validation($request_id,$request) {
        $auth_name = Model::find($request_id);

        $request->validate([
            'auth_name'=>['required',Rule::unique('auths')->ignore($auth_name)]
        ]);
    }
}

