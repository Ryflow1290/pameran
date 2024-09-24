<?php

namespace App\Http\Controllers;

use App\Models\GlobalConfig;
use App\Models\User;
use Illuminate\Http\Request;

class GlobalConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    public function index()
    {
        $config = GlobalConfig::all();
        return view('admin.configs.index', compact('config'));
    }

    public function toggle(Request $request)
    {
        // dd($request);
        $config = GlobalConfig::updateOrCreate(['key' => 'isRatingOn'], ['value' => $request->isRatingOn == 'on' ? 'on' : 'off']);
        $config->save();

        return redirect()->route('config.index')->with('success', 'Status updated.');
    }
}
