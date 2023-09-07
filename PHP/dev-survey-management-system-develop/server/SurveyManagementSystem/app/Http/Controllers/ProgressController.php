<?php

namespace App\Http\Controllers;

use App\Models\Progress_status;
use App\Models\Progress_management;
use App\Models\Trader;

use Carbon\Carbon;

use Illuminate\Http\Request;

class ProgressController extends Controller
{
    //
    public function index() {
        $progress_managements = Progress_management::select(
            'progress_managements.id',
            'progress_managements.member_id',
            'traders.trader_name',
            'progress_managements.current_date',
            'progress_managements.document_arrival_expected',
            'progress_managements.document_arrival_done',
            'progress_managements.insurance_send_bill_expected',
            'progress_managements.insurance_send_bill_done',
            'progress_managements.insurance_ertification_expected',
            'progress_managements.insurance_ertification_done',
            'progress_managements.insurance_payment_expected',
            'progress_managements.insurance_payment_done',
            'progress_managements.send_bill_expected',
            'progress_managements.send_bill_done',
            'progress_managements.payment_expected',
            'progress_managements.payment_done',
            'progress_statuses.status_name')
            ->join('traders', 'progress_managements.trader', '=', 'traders.id')
            ->join('progress_statuses', 'progress_managements.status', '=', 'progress_statuses.id')
            ->get();
        
        return view('progress/progress_all',['progress_managements' => $progress_managements]);
    }

    public function create() {
        $traders = Trader::all();
        return view('progress/progress_create',['traders' => $traders]);
    }

    public function add(Request $request) {
        $progress = new Progress_management;

        $form = $request->all();
        unset($form['_token']);

        $form['document_arrival_expected'] = date("Y-m-d",strtotime('7 day', strtotime($form['current_date'])));
        $form['insurance_send_bill_expected'] = date("Y-m-d",strtotime('11 day', strtotime($form['current_date'])));
        $form['insurance_ertification_expected'] = date("Y-m-d",strtotime('21 day', strtotime($form['current_date'])));
        $form['insurance_payment_expected'] = date("Y-m-d",strtotime('28 day', strtotime($form['current_date'])));
        $form['send_bill_expected'] = date("Y-m-d",strtotime('30 day', strtotime($form['current_date'])));
        $form['payment_expected'] = date("Y-m-d",strtotime('35 day', strtotime($form['current_date'])));

        $form['status'] = 1;
        $form['finish'] = 0;
        
        $progress->fill($form);
        $progress->save();
    }

    public function edit(Request $request) {
        $progress = Progress_management::find($request->id);

        unset($progress['_token']);

        $progress['document_arrival_done'] = $request->document_arrival_done;
        $progress['insurance_send_bill_done'] = $request->insurance_send_bill_done;
        $progress['insurance_ertification_done'] = $request->insurance_ertification_done;
        $progress['insurance_payment_done'] = $request->insurance_payment_done;
        $progress['send_bill_done'] = $request->send_bill_done;
        $progress['payment_done'] = $request->payment_done;

        $progress->save();

        return redirect('progress/index');
    }

    public function delete(Request $request) {
        dd($request);//まだ未実装
    }

    public function update() {
        $currentdate = Carbon::now();

        $progresses = Progress_management::all();

        foreach($progresses as $progress){

            $progress_managements = Progress_management::find($progress['id']);

            if(is_null($progress['document_arrival_done'])){
                if($currentdate < $progress['document_arrival_expected']){
                    $progress_managements['status'] = 1;  //進行中
                }else{
                    $progress_managements['status'] = 2;  //保険書類到着遅れ
                }
            }elseif(is_null($progress['insurance_send_bill_done'])){
                if($currentdate < $progress['insurance_send_bill_expected']){
                    $progress_managements['status'] = 1;  //進行中
                }else{
                    $progress_managements['status'] = 3;  //保険請求送付Re遅れ
                }
            }elseif(is_null($progress['insurance_ertification_done'])){
                if($currentdate < $progress['insurance_ertification_expected']){
                    $progress_managements['status'] = 1;  //進行中
                }else{
                    $progress_managements['status'] = 4;  //保険認定C遅れ
                }
            }elseif(is_null($progress['insurance_payment_done'])){
                if($currentdate < $progress['insurance_payment_expected']){
                    $progress_managements['status'] = 1;  //進行中
                }else{
                    $progress_managements['status'] = 5;  //保険入金C遅れ
                }
            }elseif(is_null($progress['send_bill_done'])){
                if($currentdate < $progress['send_bill_expected']){
                    $progress_managements['status'] = 1;  //進行中
                }else{
                    $progress_managements['status'] = 6;  //請求書送付Re遅れ
                }
            }elseif(is_null($progress['payment_done'])){
                if($currentdate < $progress['payment_expected']){
                    $progress_managements['status'] = 1;  //進行中
                }else{
                    $progress_managements['status'] = 7;  //入金Re遅れ
                }
            }else{
                $progress_managements['status'] = 8;  //完了
            }

            $progress_managements->save();
        }
    }
}
