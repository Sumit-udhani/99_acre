<?php

namespace App\Http\Controllers;

use App\Models\PropertyCategory;
use App\Models\PropertyPurpose;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $types = PropertyType::with(['purpose', 'category'])->get();
        $purposes = PropertyPurpose::all();
        $categories = PropertyCategory::all();

        return view('admin.property.types.index', compact(
            'types',
            'categories',
            'purposes'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'purpose_id' => 'required|exists:purposes,id',
        ]);

        PropertyType::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug), // auto clean slug
            'category_id' => $request->category_id,
            'purpose_id' => $request->purpose_id,
        ]);

        return back()->with('success', 'Type created successfully');

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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
          $type = PropertyType::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'category_id' => 'required|exists:property_categories,id',
            'purpose_id' => 'required|exists:property_purposes,id',
        ]);

        $type->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'category_id' => $request->category_id,
            'purpose_id' => $request->purpose_id,
        ]);

        return back()->with('success', 'Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
            $type = PropertyType::findOrFail($id);
        $type->delete();

        return back()->with('success', 'Type deleted successfully');
    }
}
