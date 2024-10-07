<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pameran;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','isMahasiswa'])->except('semua', 'data');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();
        $pamerans = Pameran::count();
        $jurusans = Jurusan::count();
        $rating = Rating::count();

        $widget = [
            'users' => $users,
            'pamerans' => $pamerans,
            'jurusans' => $jurusans,
            'ratings' => $rating,
            //...
        ];

        return view('home', compact('widget'));
    }

    public function data(Request $request)
    {
        $search = $request->input('search');
        $currentPage = $request->input('page', 1);
        $perPage = 9;

        $query = Pameran::with('user', 'files', 'jurusan');

        if ($search) {  
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
                ->orWhereHas('jurusan', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        }

        $projects = $query->paginate($perPage, ['*'], 'page', $currentPage);

        return response()->json([
            'data' => $projects->items(),
            'total_pages' => $projects->lastPage(),
            'current_page' => $projects->currentPage(),
        ]);
    }

    public function semua()
    {
        return view('semua');
    }
}
