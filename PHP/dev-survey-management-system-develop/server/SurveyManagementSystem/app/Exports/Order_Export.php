<?php

namespace App\Exports;

use App\Models\orders;
use Maatwebsite\Excel\Concerns\FromCollection;

class Order_Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $id;

    public function __construct($id)
    {

        $this->id = $id;

    }

    public function collection()
    {
        return orders::select(
            'orders.id',
            'clients.company_name',
            'clients.name',
            'users.family_name',
            'users.personal_name',
            'orders.order_date',
            'orders.subtotal',
            'orders.tax',
            'orders.total_price',
            'orders.delivery_date',
            'orders.maturity',
            'orders.payment_date')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('users', 'orders.person_id', '=', 'users.id')
            ->where('orders.id',$this->id)
            ->get();
    }

    public function headings():array
	{
		return [
			'#', 
            '商談日', 
            '顧客先会社名',
			'顧客先担当者',  
			'担当者氏名（姓）', 
            '担当者氏名（名）',
            '同行者',
            '目的',
            '事前準備',
            '商談内容',
            '次回課題',
            '対応状況',
		]; 
	}
}
