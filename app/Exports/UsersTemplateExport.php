<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            ['John',' Doe', 'john.doe@example.com', '12345', '2024', '2024','12345678'],
            ['Jane','Smith', 'jane.smith@example.com', '67890', '2023', '2023','12345678'],
        ];
    }

    public function headings(): array
    {
        return [
            'name',
            'last_name',
            'email',
            'nim',
            'tahun_lulus',
            'year',
            'password'
        ];
    }
}
