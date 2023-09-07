<?php

namespace App\Exports;

use App\Models\inquirys;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Inquiry_detailExport implements FromCollection,WithHeadings
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
        return inquirys::select(
            'inquirys.id',
            'inquirys.reception_date',
            'clients.company_name',
            'clients.name',
            'users.family_name',
            'users.personal_name',
            'inquiry_sections.inquiry_name',
            'inquirys.inquiry',
            'inquirys.answer',
            'inquirys.correspondence')
            ->join('clients', 'inquirys.client_id', '=', 'clients.id')
            ->join('inquiry_sections', 'inquirys.inquiry_section_id', '=', 'inquiry_sections.id')
            ->join('users', 'inquirys.person_id', '=', 'users.id')
            ->where('inquirys.id',$this->id)
            ->get();
    }

    public function headings():array
	{
		return [
			'#', 
            '受付日',
            '顧客先会社名',
            '顧客先担当者',
            '担当者(姓)',
			'担当者(名)',
			'クレーム区分',
			'クレーム内容',
			'処理内容',
            '対応状況',
		]; 
    }

}
