<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Matter_statuse;

class StatusController extends Controller
{
    //
    public function matter_status_all()
    {
        $matter_statuses = Matter_statuse::all()->sortby('id');

        return view('status/status_all',['statuses' => $matter_statuses]);
    }

    public function matter_status_add(Request $request)
    {
        //dd($request);
        $request->validate([
            'status_number'=> ['required', 'regex:/^[0-9]+$/i', Rule::unique('matter_statuses')->ignore($request->status_number, 'status_number')],
            'status_name'=> ['required',Rule::unique('matter_statuses')->ignore($request->status_name, 'status_name')]
        ]);

        $form = $request->all();
        unset($form['_token']);
        
        $matter_statuses = new Matter_statuse;
        $matter_statuses->fill($form);
        
        $matter_statuses->save();

        return redirect('status/all');
    }

    public function matter_status_update(Request $request)
    {
        $status = Matter_statuse::where('id',$request->id)->first();
        $status_number = $status['status_number'];
        $status_name = $status['status_name'];
        // dd($status_name,$request['status_name'],$request['id']);
        $request->validate([
            'status_number'=> ['required', 'regex:/^[0-9]+$/i', Rule::unique('matter_statuses')->ignore($request->status_number, 'status_number')],
            'status_name'=> ['required',Rule::unique('matter_statuses')->ignore($request->status_name, 'status_name')]
        ]);

        $matter_statuses = Matter_statuse::find($request->id);

        $form = $request->all();
        unset($form['_token']);
        
        $matter_statuses->fill($form);
        $matter_statuses->save();

        return redirect('status/all');
    }

    public function matter_status_delete(Request $request)
    {
        $statuses = Matter_statuse::find($request->id);
        $statuses->delete();

        return redirect('status/all');
    }
}
