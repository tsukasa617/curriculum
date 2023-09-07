<?php

namespace App\Exports;

use App\Models\orders;
use App\Models\order_historys;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Order_detailExport implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;

    public function __construct($id)
    {

        $this->id = $id;

    }

    public function view(): View
    {

        $orders = orders::find($this->id)->first();

        $order_id = $this->id;
        
        $order_historys = order_historys::where('order_id',$order_id)->orderby('id','desc')->get();

        return view('client/client_order_detail_export',['orders' => $orders,'order_historys' => $order_historys]);
    }

}
