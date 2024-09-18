<?php

namespace App\Imports;

use App\Models\TahunLulus;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Find or create the TahunLulus
            $tahunLulus = TahunLulus::firstOrCreate([
                'tahun' => $row['tahun_lulus'],
                'year' => $row['year']
            ]);

            User::updateOrCreate([ 
                'email' => $row['email']
            ], [
                'last_name' => $row['last_name'],
                'name' => $row['name'],
                'nim' => $row['nim'],
                'tahun_lulus' => $tahunLulus->id,
                'password' => $row['name'].$row['nim'],
                'role' => 'mahasiswa',
            ]);
        }
    }
}
