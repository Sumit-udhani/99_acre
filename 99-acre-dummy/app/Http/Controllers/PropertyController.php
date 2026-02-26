<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyLocationType;
use App\Models\PropertyPurpose;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $properties = Property::with(['purpose', 'category', 'type', 'locationType'])->get();

        $purposes = PropertyPurpose::all();
        $categories = PropertyCategory::all();
        $types = PropertyType::all();
        $locationTypes = PropertyLocationType::all();

        return view('admin.property.properties.index', compact(
            'properties',
            'purposes',
            'categories',
            'types',
            'locationTypes'

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
            // 'title' => 'required|string|max:255',
            'purpose_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'description' => 'nullable',
        ]);
        // Conditional validation
$category = PropertyCategory::find($request->category_id);
$type = PropertyType::find($request->type_id);

if ($category->name === 'Commercial' && $type->name === 'Retail') {
    $request->validate([
        'location_type_id' => 'required'
    ]);
}

        Property::create([
            // 'title' => $request->title,
            // 'price' => $request->price,
            'purpose_id' => $request->purpose_id,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
            'location_type_id' => $request->location_type_id,
            // 'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Property created successfully.');
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
        $property = Property::findOrFail($id);
        $request->validate([
              'purpose_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'location_type_id' => 'required'
        ]);
        $property->update([
              'purpose_id' => $request->purpose_id,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
            'location_type_id' => $request->location_type_id,
        ]);
         return back()->with('success', 'Property updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $property = Property::findOrFail($id);
        $property->delete();
    }
}
