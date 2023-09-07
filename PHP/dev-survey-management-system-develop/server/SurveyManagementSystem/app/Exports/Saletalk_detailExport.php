<?php

namespace App\Exports;

use App\Models\saletalks;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Saletalk_detailExport implements FromCollection,WithHeadings
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
            'saletalks.saletalk_date',
            'clients.company_name',
            'clients.name',
            'users.family_name',
            'users.personal_name',
            'saletalks.companion',
            'saletalks.objective',
            'saletalks.preparation',
            'saletalks.talk_contents',
            'saletalks.next_issue',
            'saletalks.correspondence')
            ->join('clients', 'saletalks.client_id', '=', 'clients.id')
            ->join('users', 'saletalks.person_id', '=', 'users.id')
            ->where('saletalks.id',$this->id)
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
