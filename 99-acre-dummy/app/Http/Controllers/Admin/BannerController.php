<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
      $banners = Banner::latest()->get();
        return view('admin.banner.index', compact('banners'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
          return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
           

            'description' => 'nullable|string',
             'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,,gif,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
        }

        Banner::create([
            'title' => $request->title,
            'description' => $request->description,
            'subtitle'=>$request->subtitle,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('banner.index')
            ->with('success', 'Banner created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
         $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $banner->image_path;

        if ($request->hasFile('image')) {

            // Delete old image
            if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
                Storage::disk('public')->delete($banner->image_path);
            }

            $imagePath = $request->file('image')->store('banners', 'public');
        }

        $banner->update([
            'title' => $request->title,
            'description' => $request->description,
            'subtitle'=>$request->subtitle,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('banner.index')
            ->with('success', 'Banner updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
     public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if ($banner->image_path && Storage::disk('public')->exists($banner->image_path)) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();

        return redirect()->route('banner.index')
            ->with('success', 'Banner deleted successfully');
    }
}
