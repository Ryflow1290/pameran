<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pameran;
use App\Models\PameranFile;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDO;
use Yajra\DataTables\Facades\DataTables;

class PameranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isMahasiswa'])->except('show');
    }

    public function index()
    {
        // $pamerans = Pameran::with('user', 'files')->get();
        return view('pameran.index');
    }

    public function data()
    {
        $pamerans = Auth::user()->role == 'admin' ? Pameran::with('user','user.tahun', 'jurusan', 'files')->get() : Pameran::with('user','user.tahun', 'jurusan', 'files')->where('user_id', Auth::user()->id)->get();
        return DataTables::of($pamerans)
            ->addColumn('actions', function ($pameran) {
                return '
            <a href="' . route('pameran.edit', $pameran->id) . '" class="btn btn-sm btn-primary">Edit</a>
            <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal' . $pameran->id . '">Delete</a>
            
            <div class="modal fade" id="deleteModal' . $pameran->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Delete "' . $pameran->name . '" !.</div>
        <div class="modal-footer">
        <form id="" action="' . route('pameran.destroy', $pameran->id) . '" method="POST" style="">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">

            <button class="btn btn-link" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-danger" onclick="" type="submit">Delete</button>

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
        $user = Auth::user();
        $exists = User::find($user->id);
        
        
        $jurusans = Jurusan::all();
        if ($user->role == 'admin') {

            $users = User::whereIn('role', ['mahasiswa', 'admin'])->get();
            return view('pameran.create')->with(compact('users'))->with(compact('jurusans'));
        } else {
            if($exists->pamerans()->exists()){
                return redirect()->route('pameran.index')->with('success', 'Tidak Dapat membuat Pameran Lebih Dari Satu');
            }
            return view('pameran.create')->with(compact('jurusans'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required',
            'description' => 'nullable|string',
            'file.*' => 'mimes:jpg,jpeg,png,mp4,pdf|max:10240',
            'caption.*' => 'required',
            'type.*' => 'required',
            
        ]);

        $role = Auth::user()->role;
        if($role == 'admin' && Auth::user()->id != $request->input('user')){
            if(User::find($request->input('user'))->pamerans()->exists()){
                return redirect()->route('pameran.index')->with('success', 'User ini sudah memiliki Pameran!');
            }
        }
        // Store pameran
        $pameran = Pameran::create([
            'title' => $request->input('title'),
            'user_id' =>  $role == 'admin' ? $request->input('user') : Auth::id(),
            'abstract' => $request->input('abstract'),
            'description' => $request->input('description'),
            'jurusan_id' => $request->input('jurusan')
        ]);

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $key => $file) {
                $path = $file->store('public/pameran', 'public');
                $type = $file->getClientOriginalExtension();
                $foto = ['jpeg', 'png', 'jpg'];

                $fileType = $type == 'mp4' ? 'video' : ($type == 'pdf' ? 'flyer' : (in_array($type, $foto) ? 'image' : $type));

                PameranFile::create([
                    'pameran_id' => $pameran->id,
                    'caption' => $request->input('caption')[$key],
                    'path' => $path,
                    'type' => $fileType,
                    'size' => $file->getSize()
                ]);

                // Store the file with a custom name if needed
                // Storage::disk('public')->put($request->input('caption')[$key], file_get_contents($file));
            }
        }

        return redirect()->route('pameran.index')->with('success', 'Pameran created successfully.');
    }

    public function show($id)
    {
        // if (session()->has('url.intended')) {
        session()->put('url.intended', url()->current());
        // }

        $userId = null;
        if (Auth::check()) {

            $userId = Auth::user()->id;
        }

        $pameran = Pameran::with('files','user.tahun')->findOrFail($id);

        $alreadyRated = Rating::where('pameran_id', $id)->where('user_id', $userId)->exists();


        $ratings = Rating::with('user')->where('pameran_id', $id)->get();

        return view('pameran.show', compact('pameran', 'ratings', 'alreadyRated'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $jurusans = Jurusan::all();
        if ($user->role == 'admin') {

            $pameran = Pameran::with('files', 'user', 'jurusan')->findOrFail($id);
            $users = User::whereIn('role', ['mahasiswa', 'admin'])->get();
            return view('pameran.edit', compact('pameran'))->with(compact('users'))->with(compact('jurusans'));
        } else {

            $pameran = Pameran::with('files', 'user', 'jurusan')->where('user_id', $user->id)->findOrFail($id);
            $users = User::all();
            return view('pameran.edit', compact('pameran'))->with(compact('jurusans'));
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'abstract' => 'required',
            'description' => 'nullable|string',
            'file.*' => 'mimes:jpg,jpeg,png,mp4,pdf|max:10240',
            // 'submittedFile.*' => 'required|string',
            'captionSubmitted' => 'nullable',
            'caption.*' => 'required',
            'type.*' => 'required',
            // 'submittedType.*' => 'required'
        ]);

        $user = Auth::user();

        if ($user->role == 'admin') {

            $pameran = Pameran::findOrFail($id);

            $pameran->update([
                'title' => $request->input('title'),
                'abstract' => $request->input('abstract'),
                'description' => $request->input('description'),
                'user_id' => $request->input('user'),
                'jurusan_id' => $request->input('jurusan')
            ]);
        } else {
            $pameran = Pameran::where('user_id', $user->id)->findOrFail($id);

            $pameran->update([
                'title' => $request->input('title'),
                'abstract' => $request->input('abstract'),
                'description' => $request->input('description'),
                'jurusan_id' => $request->input('jurusan')
            ]);
        }

        $submittedFileIds = $request->input('submittedFile');

        if (is_null($submittedFileIds)) {
            $del = PameranFile::where('pameran_id', $id)->delete();
        } else {
            $del = PameranFile::whereNotIn('id', $submittedFileIds)
                ->where('pameran_id', $id)
                ->delete();
            foreach ($request->input('submittedFile') as $key => $id) {
                $file = PameranFile::find($id);

                $file->update([
                    'caption' => $request->input('captionSubmitted')[$key],
                ]);
            }
        }


        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $key => $file) {
                $path = $file->store('public/pameran', 'public');
                $type = $file->getClientOriginalExtension();
                $foto = ['jpeg', 'png', 'jpg'];

                $fileType = $type == 'mp4' ? 'video' : ($type == 'pdf' ? 'flyer' : (in_array($type, $foto) ? 'image' : $type));

                PameranFile::create([
                    'pameran_id' => $pameran->id,
                    'caption' => $request->input('caption')[$key],
                    'path' => $path,
                    'type' => $fileType,
                    'size' => $file->getSize()
                ]);

                // Store the file with a custom name if needed
                // Storage::disk('public')->put($request->input('caption')[$key], file_get_contents($file));
            }
        }

        return redirect()->route('pameran.index')->with('success', 'Pameran updated successfully.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $pameran = $user->role == 'admin' ? Pameran::findOrFail($id) : Pameran::where('user_id', $user->id)->findOrFail($id);
        $pameran->files()->delete();
        $pameran->delete();

        return redirect()->route('pameran.index')->with('success', 'Pameran deleted successfully.');
    }
}
