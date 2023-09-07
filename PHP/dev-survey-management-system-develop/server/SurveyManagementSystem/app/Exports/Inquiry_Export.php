<?php

namespace App\Exports;

use App\Models\inquirys;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Inquiry_Export implements FromCollection/* ,WithHeadings */
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return inquirys::select(
            'inquirys.id',
            'inquirys.reception_date',
            'inquirys.correspondence',
            'inquiry_sections.inquiry_name',
            'inquirys.client_id',
            'clients.company_name',
            'clients.name',
            'users.family_name',
            'users.personal_name',
            'inquirys.created_at',
            'inquirys.updated_at')
            ->join('clients', 'inquirys.client_id', '=', 'clients.id')
            ->join('inquiry_sections', 'inquirys.inquiry_section_id', '=', 'inquiry_sections.id')
            ->join('users', 'inquirys.person_id', '=', 'inquirys.id')
            ->get();

    }
}
