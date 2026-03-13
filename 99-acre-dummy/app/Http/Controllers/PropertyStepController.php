<?php

namespace App\Http\Controllers;

use App\Models\PropertyStep;
use Illuminate\Http\Request;

class PropertyStepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
           $steps = PropertyStep::orderBy('order')->get();
        return view('admin.property-steps.index', compact('steps'));
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
            'title' => 'required|string|max:255',
            'order' => 'required|integer',
            'active' => 'required|boolean',
            'slug'=>'required'
        ]);

        PropertyStep::create($request->all());

        return redirect()
            ->back()
            ->with('success','Step created successfully');
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
    public function update(Request $request, PropertyStep $property_step)
    {
        //
          $request->validate([
            'title' => 'required|string|max:255',
            'order' => 'required|integer',
            'active' => 'required|boolean',
            'slug'   =>'required'
        ]);

        $property_step->update($request->all());

        return redirect()
            ->route('admin.property-steps.index')
            ->with('success','Step updated successfully');
    }

   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $property_step = PropertyStep::findOrFail($id);
        $property_step->delete();
        return redirect()->back()->with('success','Step deleted successfully');
    }
}
