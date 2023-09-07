<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return User::select(
            'users.id',
            'users.employee_code',
            'users.family_name',
            'users.personal_name',
            'users.kana_family_name',
            'users.kana_personal_name',
            'affiliations.affiliation_name',
            'positions.position_name')
            ->join('affiliations', 'users.affiliation_id', '=', 'affiliations.id')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->get();

    }

    public function headings():array
	{
		return [
			'#', 
			'社員コード', 
            '氏名 （姓：漢字）', 
            '氏名 （名：漢字）', 
            '氏名 （姓：カナ）', 
            '氏名 （名：カナ）', 
			'部署', 
			'役職',
		]; 
	}
}
