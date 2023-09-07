<?php

namespace App\Exports;

use App\Models\clients;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Client_detailExport implements FromCollection,WithHeadings
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

        return clients::select(
            'clients.id',
            'clients.company_name',
            'clients.name',
            'clients.department',
            'clients.position',
            'clients.phone_number',
            'clients.email',
            'clients.dm',
            'industrys.industry_name',
            'clients.address',
            'clients.sales_scale',
            'clients.credit_information',
            'clients.settlement_time',
            'clients.listing_category',
            'clients.corporate_code',
            'clients.group_company',
            'clients.agent',
            'clients.created_at',
            'clients.updated_at')
            ->join('industrys', 'clients.industry_id', '=', 'industrys.id')
            ->where('clients.id',$this->id)
            ->get();
            
            // return clients::where('id',$this->id)->get();
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
            'DM送付の可否',
            '業種',
            '所在地',
            '売り上げ規模',
            '与信情報',
            '決済時期',
            '上場区分',
            '法人コード',
            'グループ会社',
            '代理店',
            '作成日',
            '最終更新日',
		]; 
	}
}
