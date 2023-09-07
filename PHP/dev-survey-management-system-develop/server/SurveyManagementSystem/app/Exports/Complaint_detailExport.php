<?php

namespace App\Exports;

use App\Models\complaints;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Complaint_detailExport implements FromCollection,WithHeadings
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
        return complaints::select(
            'complaints.id',
            'complaints.reception_date',
            'clients.company_name',
            'clients.name',
            'users.family_name',
            'users.personal_name',
            'complaint_sections.complaint_name',
            'complaints.complaint',
            'complaints.processing',
            'complaints.correspondence')
            ->join('clients', 'complaints.client_id', '=', 'clients.id')
            ->join('complaint_sections', 'complaints.complaint_section_id', '=', 'complaint_sections.id')
            ->join('users', 'complaints.person_id', '=', 'users.id')
            ->where('complaints.id',$this->id)
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
            'メールアドレス',
		]; 
	}
}
