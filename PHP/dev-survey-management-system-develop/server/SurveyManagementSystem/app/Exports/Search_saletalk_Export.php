<?php

namespace App\Exports;

use App\Models\Saletalks;
use Maatwebsite\Excel\Concerns\FromCollection;

class Search_saletalk_Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection($info)
    {
        //dd($info);
        $result = array();
        foreach($info as $key => $val){
            $result[] = $val;
        }
        return $info;
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
