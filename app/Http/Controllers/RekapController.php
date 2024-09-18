<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RekapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }
    /**
     * Display a listing of the ratings (for admin).
     */
    public function index()
    {   
        $jumlahMahasiswa = User::where('role','mahasiswa')->count();
        $jumlahBelum = User::where('role', 'mahasiswa')
        ->whereDoesntHave('pamerans')
        ->count();
        return view('rekap.index', compact('jumlahMahasiswa', 'jumlahBelum'));
    }
    public function data()
    {
        $users = User::with('pamerans','pamerans.files')->where('role','mahasiswa')->where('id', '!=', Auth::user()->id);

        return DataTables::of($users)
            ->addColumn('status', function ($user) {
                return $user->pamerans()->exists() ? '<div class="btn btn-success">Sudah Unggah</div>' : '<div class="btn btn-danger">Belum Unggah</div>';
            })
            ->addColumn('nama_pameran', function ($user) {
                return $user->pamerans()->exists() ? $user->pamerans()->first()->title : 'Upload Dahulu';
            })
            ->rawColumns(['nama_pameran','status']) 
            ->make(true);
    }
}
