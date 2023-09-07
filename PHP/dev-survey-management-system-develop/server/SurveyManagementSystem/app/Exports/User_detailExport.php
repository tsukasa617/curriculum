<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class User_detailExport implements FromCollection,WithHeadings
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
        return User::select(
            'users.id',
            'users.employee_code',
            'users.family_name',
            'users.personal_name',
            'users.kana_family_name',
            'users.kana_personal_name',
            'affiliations.affiliation_name',
            'positions.position_name',
            'users.office_tel',
            'users.mobile_tel',
            'users.email',
            'users.join',
            'users.zipcode',
            'users.address',
            'users.home_tel',
            'users.birthdate',
            'auths.authlevel_name',
            'users.created_at',
            'users.updated_at')
            ->join('affiliations', 'users.affiliation_id', '=', 'affiliations.id')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->join('auths', 'users.auth_id', '=', 'auths.id')
            ->where('users.id',$this->id)
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
            '電話番号（事務所）',
            '電話番号（携帯）',
            'メールアドレス',
            '入社日',
            '郵便番号',
            '住所',
            '電話番号（緊急連絡先）',
            '生年月日',
            '権限',
            '作成日',
            '最終更新日',
		]; 
	}
}
