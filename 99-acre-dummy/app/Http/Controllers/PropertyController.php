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
        $properties = Property::with(['purpose', 'category', 'type','locationType'])->get();

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
            'price' => 'required|numeric',
            'property_purpose_id' => 'required|exists:property_purposes,id',
            'property_category_id' => 'required|exists:property_categories,id',
            'property_type_id' => 'required|exists:property_types,id',
            'property_location_type_id' => 'required|exists:property_location_types,id',
            // 'description' => 'nullable|string',
        ]);

        Property::create([
            'title' => $request->title,
            'price' => $request->price,
            'property_purpose_id' => $request->property_purpose_id,
            'property_category_id' => $request->property_category_id,
            'property_type_id' => $request->property_type_id,
            'property_location_type_id' => $request->property_location_type_id,
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
