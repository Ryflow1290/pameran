<?php

namespace App\Http\Controllers;

use App\Models\Pameran;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin')->except('store', 'destroy');
    }
    /**
     * Display a listing of the ratings (for admin).
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            $pamerans = Pameran::with('likes')->get();
            return view('ratings.index', compact('pamerans'));
        } else {
            $pamerans = Pameran::with('likes')->get();
            return view('ratings.index', compact('pamerans'));
        }
    }
    public function data()
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            $pamerans = Pameran::with('user')->withCount('likes')->get();

            return DataTables::of($pamerans)
                ->addColumn('likes_count', function ($pameran) {
                    return $pameran->likes_count;
                })
                ->make(true);
        } else {
            $pamerans = Pameran::with('user')->withCount('likes')
                ->where('user_id', $user->id)
                ->get();

            return DataTables::of($pamerans)
                ->addColumn('likes_count', function ($pameran) {
                    return $pameran->likes_count;
                })
                ->make(true);

        }
    }
    /**
     * Show the form for editing a specific rating.
     */
    public function edit($id)
    {
        $rating = Rating::findOrFail($id);
        return view('ratings.edit', compact('rating'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $request->validate([
            'pameran_id' => 'required|exists:pamerans,id',
            'rating' => 'required|integer|min:1|max:5',
            'opinion' => 'nullable|string',
        ]);

        // Create or update rating by the same user on the same pameran
        Rating::updateOrCreate(
            ['pameran_id' => $request->pameran_id, 'user_id' => $user_id],
            ['count' => $request->rating, 'opinion' => $request->opinion]
        );

        return redirect()->back()->with('success', 'Rating submitted successfully');
    }
    /**
     * Update the specified rating in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'count' => 'required|integer|min:1|max:5',
            'opinion' => 'nullable|string',
        ]);

        $rating = Rating::findOrFail($id);
        $rating->update([
            'count' => $request->count,
            'opinion' => $request->opinion,
        ]);

        return redirect()->route('ratings.index')->with('success', 'Rating updated successfully');
    }

    /**
     * Remove the specified rating from storage.
     */
    public function destroy($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return redirect()->back()->with('success', 'Rating deleted successfully');
    }
}
