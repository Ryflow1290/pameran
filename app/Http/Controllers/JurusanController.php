<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }

    public function index()
    {
        $jurusans = Jurusan::all();
        return view('admin.jurusans.index', compact('jurusans'));
    }
    public function data()
    {
        $jurusans = Jurusan::with('users', 'pamerans')->get();
        return DataTables::of($jurusans)
            ->addColumn('actions', function ($jurusan) {
                return '
            <a href="' . route('jurusan.show', $jurusan->id) . '" class="btn btn-sm btn-primary">Edit</a>
            <a href="' . route('jurusan.destroy', $jurusan->id) . '" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal">Delete</a>
            
            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Delete "' . $jurusan->name . '" !.</div>
        <div class="modal-footer">
            <button class="btn btn-link" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="' . route('jurusan.destroy', $jurusan->id) . '" onclick="">Delete</a>
            <form id="" action="' . route('jurusan.destroy', $jurusan->id) . '" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
</div>
            ';
            })
            ->rawColumns(['actions']) // to render HTML in actions column
            ->make(true);
    }
    public function create()
    {
        return view('admin.jurusans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:jurusans'
        ]);

        Jurusan::create([
            'name' => $request->input('name'),
            'code' => $request->input('code')
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan created successfully.');
    }

    public function edit($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusans.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:jurusans,code,' . $id
        ]);

        $jurusan->update([
            'name' => $request->input('name'),
            'code' => $request->input('code')
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan updated successfully.');
    }

    public function destroy($id)
    {
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan deleted successfully.');
    }
}
