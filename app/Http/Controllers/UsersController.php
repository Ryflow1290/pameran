<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function getUsersData()
    {
        $users = User::select(['id', 'name', 'last_name', 'email', 'role'])->where('id', '!=', Auth::user()->id);

        return DataTables::of($users)
            ->addColumn('actions', function ($user) {
                return '
                <a href="' . route('users.edit', $user->id) . '" class="btn btn-sm btn-primary">Edit</a>
                <a href="' . route('users.delete', $user->id) . '" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal' . $user->id . '">Delete</a>
                
                <div class="modal fade" id="deleteModal' . $user->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Delete "' . $user->name . '" !.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="' . route('users.delete', $user->id) . '" onclick="">Delete</a>
                <form id="" action="' . route('users.delete', $user->id) . '" method="POST" style="display: none;">
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

    public function editUsersData($id)
    {
        // Fetch the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found.');
        }

        $jurusan = Jurusan::all();

        // Return the view with the user's data
        return view('admin.users.edit')->with(compact('user'))->with(compact('jurusan'));
    }

    public function updateUsersData(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Exclude current user's email from the unique check
            'role' => 'required|string'
        ]);

        // Fetch the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->route('users')->with('error', 'User not found.');
        }

        // Update the user data
        $user->update([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ]);

        if ($request->input('new_password') != '') {
            $user->update([
                'password' => $request->input('new_password')
            ]);
        }

        // Redirect back with success message
        return redirect()->route('users')->with('success', 'User updated successfully.');
    } 

    public function deleteUsersData($id)
    {
        // Fetch the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->route('users')->with('error', 'User not found.');
        }

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }
}
