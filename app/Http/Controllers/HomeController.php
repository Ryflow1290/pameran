<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pameran;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        
        $widget = [
            'users' => $users,
            'pamerans' => $pamerans,
            'jurusans' => $jurusans,
            //...
        ];

        return view('home', compact('widget'));
    }
}
