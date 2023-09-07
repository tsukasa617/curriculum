<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth as ModelAuth;
use Illuminate\Support\Facades\Auth;

//論理削除
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    //論理削除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $guarded = array('id');

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
}
