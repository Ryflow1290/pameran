<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersPameranExport implements FromCollection
{
    protected $submittedCount;
    protected $notSubmittedCount;
    protected $totalCount;

    public function __construct()
    {
        $this->submittedCount = User::withCount('pamerans')->get()->filter(function ($user) {
            return $user->pamerans_count > 0;
        })->count();

        $this->notSubmittedCount = User::withCount('pamerans')->get()->filter(function ($user) {
            return $user->pamerans_count <= 0;
        })->count();

        $this->totalCount = User::count();
    }

    public function collection()
    {
        // Prepare summary data
        $summaryData = collect([
            ['Submitted Users', $this->submittedCount ?? 0],
            ['Not Submitted Users', $this->notSubmittedCount ?? 0],
            ['Total Users', $this->totalCount],
            ['',''], 
        ]);

        $headings = collect([
            ['ID', 'Nim', 'Name', 'Jurusan Name', 'Pameran Title', 'Submitted']
        ]);

        $userData = User::withCount('pamerans')
            ->with(['pamerans' => function ($query) {
                $query->limit(1);
            }, 'jurusan'])
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'nim' => $user->nim,
                    'name' => $user->name . ' ' . $user->last_name,
                    'jurusan_name' => $user->jurusan->name ?? ' ',
                    'pameran_title' => $user->pamerans->first()->title ?? ' ',
                    'submitted' => $user->pamerans_count > 0 ? 'Sudah Mengumpulkan' : 'Belum Mengumpulkan',
                ];
            });

        return $summaryData->merge($headings)->merge($userData);
    }
}
