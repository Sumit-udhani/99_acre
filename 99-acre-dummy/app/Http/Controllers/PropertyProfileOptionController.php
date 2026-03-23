<?php

namespace App\Http\Controllers;

use App\Models\PropertyProfileOption;
use Illuminate\Http\Request;

class PropertyProfileOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = PropertyProfileOption::latest()->get();
        return view('admin.property.property-profile-options.index', compact('options'));
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
        $request->validate([
            'area_unit' => 'nullable|string|max:50',
            'floor_no' => 'nullable|string|max:50',
            'availability_status' => 'nullable|string|max:100',
            'ownership' => 'nullable|string|max:100',
            'furnishing' => 'required|string|max:100',
            'rent_out' => 'required|string|max:100',
            'furnishing_items' => 'required|string|max:100',
        ]);

        PropertyProfileOption::create($request->only([
            'area_unit',
            'floor_no',
            'availability_status',
            'ownership',
            'furnishing',
            'rent_out',
            'furnishing_items'
        ]));

        return back()->with('success', 'Option added');
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

    public function update(Request $request, $id)
    {
        $option = PropertyProfileOption::findOrFail($id);

        $request->validate([
            'area_unit' => 'nullable|string|max:50',
            'floor_no' => 'nullable|string|max:50',
            'availability_status' => 'nullable|string|max:100',
            'ownership' => 'nullable|string|max:100',
            'furnishing' => 'nullable|string|max:100',
            'rent_out' => 'nullable|string|max:100',
            'furnishing_items' => 'required|string|max:100',

        ]);

        $option->update($request->only([
            'area_unit',
            'floor_no',
            'availability_status',
            'ownership',
            'furnishing',
            'rent_out',
            'furnishing_items'
        ]));

        return back()->with('success', 'Option Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PropertyProfileOption::findOrFail($id)->delete();

        return back()->with('success', 'Option Deleted');
    }
}
