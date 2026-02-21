<?php

namespace App\Http\Controllers;

use App\Models\SiteLogo;
use Illuminate\Http\Request;

class LogoController extends Controller
{
      public function create()
    {
        $logo = SiteLogo::first();
        return view('admin.logo.create', compact('logo'));
    }
    public function store(Request $request)
{
    $request->validate([
        'title' => 'nullable|string|max:255',
        'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {

        // Store image in storage/app/public/logos
        $imagePath = $request->file('image')->store('logos', 'public');
            $imageUrl = asset('storage/'.$imagePath);

        // Get first logo record
        $logo = SiteLogo::first();

        if ($logo) {

            
            // Update existing record
            $logo->update([
                'title' => $request->title,
                'image_path' => $imagePath,
                'url'  => $imageUrl,
                'is_active' => true,
            ]);

        } else {

            // Create new record
            SiteLogo::create([
                'title' => $request->title,
                'image_path' => $imagePath,
                'url'  => $imageUrl,
                'is_active' => true,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Logo updated successfully');
}

}
