<?php

namespace App\Http\Controllers;

use App\Models\PropertyCategory;
use App\Models\PropertyLocationType;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PropertyLocationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $locationTypes = PropertyLocationType::with('propertyType')->get();
        $types = PropertyType::all();
         return view('admin.property.location-types.index', compact(
            'locationTypes',
            'types'
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
            'property_type_id' => 'required|exists:property_types,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:property_location_types,slug',
        ]);

        PropertyLocationType::create([
            'property_type_id' => $request->property_type_id,
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Location Type Created Successfully');
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
    public function update(Request $request, PropertyLocationType $location_type)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:property_categories,id',
            'name' => 'required|string|max:255',
            'slug' => [
            'required',
            'string',
            'max:255',
            Rule::unique('property_location_types', 'slug')
                ->ignore($location_type->id),
        ],
        ]);

        $location_type->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug'=>$request->slug,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Location Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( PropertyLocationType $location_type)
    {
        //
            $location_type->delete();

        return redirect()
            ->back()
            ->with('success', 'Location Type Deleted Successfully');
    }
}
