<?php

namespace App\Exports;

use App\Models\Saletalks;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Saletalk_Export implements FromCollection,WithHeadings
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
        return saletalks::select(
            'saletalks.id',
            'clients.company_name',
            'clients.name',
            'saletalks.saletalk_date',
            'users.family_name',
            'users.personal_name',
            'saletalks.companion',
            'saletalks.objective')
            ->join('clients', 'saletalks.client_id', '=', 'clients.id')
            ->join('users', 'saletalks.person_id', '=', 'users.id')
            ->where('clients.id',$this->id)
            ->get();
    }

    public function headings():array
	{
		return [
			'#', 
			'顧客先会社名', 
			'顧客先担当者', 
			'商談日', 
			'担当者氏名（姓）', 
            '担当者氏名（名）',
            '同行者',
            '目的',
		]; 
	}
}
