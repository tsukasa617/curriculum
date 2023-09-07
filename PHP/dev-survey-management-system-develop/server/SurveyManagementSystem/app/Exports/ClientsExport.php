<?php

namespace App\Exports;

use App\Models\clients;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    // private $id;

    // public function __construct($id)
    // {

        // $this->id = $id;

    // }
    
    public function collection()
    {
        // return clients::all();

        return clients::select(
            'id',
            'company_name',
            'name',
            'department',
            'position',
            'phone_number',
            'email')
        ->get();

    }

    public function headings():array
	{
		return [
			'#', 
			'会社名', 
			'氏名', 
			'部署', 
			'役職', 
            '電話番号',
            'メールアドレス',
		]; 
	}
}
