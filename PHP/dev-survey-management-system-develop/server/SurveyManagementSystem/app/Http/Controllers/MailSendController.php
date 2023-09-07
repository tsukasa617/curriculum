<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailSend;

class MailSendController extends Controller
{
    //ステータス変更時の顧客へ対するメール
    public function status_send(Request $request){

        $forms = $request->all();
        $method = new MailSend;

        if($forms['form'] == '個人'){
            $method->client($forms);

            if($forms['check'] == 'チェック'){
                return response()->json($forms['data']);
            }

            return redirect('client/all')->with('success_message', '更新に成功しました。');
        }else{
            $method->matter_first($forms);
            if($forms['second_client']){
                $method->matter_second($forms);
            }
            if($forms['third_client']){
                $method->matter_third($forms);
            }

            if($forms['check'] == 'チェック'){
                return response()->json($forms['data']);
            }
            return redirect('matter/all')->with('success_message', '更新に成功しました。');
        }
    }
}
