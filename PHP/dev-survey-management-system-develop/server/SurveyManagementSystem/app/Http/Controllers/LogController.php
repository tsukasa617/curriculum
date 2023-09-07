<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Log;

class LogController extends Controller
{
    public function all(Request $request)
    {

        //ログインIDと権限をsessionに保存
        $method = new Log;
        $method->auth();

        $logs = Log::select(
            'logs.log',
            'logs.created_at',
            'users.login',
            'users.username'
            )
            ->join('users', 'logs.user_id', '=', 'users.id')
            ->orderBy('logs.created_at', 'asc')
            ->paginate(100);

        return view('log/log_all',['logs' => $logs]);
    }

    //キーワード検索
    public function filter_search(Request $request) {
        
        //ログインIDと権限をsessionに保存
        $method = new Log;
        $method->auth();

        $search = $request->search;

        $logs = Log::select(
            'logs.log',
            'logs.created_at',
            'users.login',
            'users.username'
            )
            ->join('users', 'logs.user_id', '=', 'users.id')
            ->where('log','LIKE','%'.$search.'%')
            ->orwhere('logs.created_at','LIKE','%'.$search.'%')
            ->orwhere('login','LIKE','%'.$search.'%')
            ->orwhere('username','LIKE','%'.$search.'%')
            ->orderBy('logs.created_at', 'asc')
            ->paginate(100);

        return view('log/log_all',['logs' => $logs]);

    }
}
