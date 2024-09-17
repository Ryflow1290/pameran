<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannersController extends Controller
{   
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }
    
    public function index()
    {
        $banners = Banner::all();
        return view('banners.index', compact('banners'));
    }

    public function create()
    {
        return view('banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imagePath = $image->store('public/banners', 'public');
        }

        Banner::create([
            'title' => $request->input('title'),
            'image_path' => $imagePath,
            'description' => $request->input('description'),
            'is_active' => false
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner created successfully.');
    }


    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('banners.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image validation
            'description' => 'nullable|string'
        ]);

        if ($request->hasFile('image_path')) {
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }

            $image = $request->file('image_path');
            $imagePath = $image->store('public/banners', 'public');
        } else {
            $imagePath = $banner->image_path;
        }

        $banner->update([
            'title' => $request->input('title'),
            'image_path' => $imagePath,
            'description' => $request->input('description')
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');
    }


    public function toggleStatus($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->is_active = !$banner->is_active; // Toggle active status
        $banner->save();

        return redirect()->route('banners.index')->with('success', 'Banner status updated.');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
    }
}
