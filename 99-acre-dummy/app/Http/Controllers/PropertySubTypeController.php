<?php

namespace App\Http\Controllers;

use App\Models\PropertySubType;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PropertySubTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
          $subtypes = PropertySubType::with('type')->get();
    $types = PropertyType::all();

    return view('admin.property.subtypes.index', compact('subtypes','types'));
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
        'name' => 'required',
        'type_id' => 'required'
    ]);

    PropertySubType::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'type_id' => $request->type_id
    ]);

    return redirect()->back()
        ->with('success','SubType created successfully');
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
    $subtype = PropertySubType::findOrFail($id);

    $subtype->update([
        'name'=>$request->name,
        'slug'=>Str::slug($request->name),
        'type_id'=>$request->type_id
    ]);

    return redirect()->back()
        ->with('success','SubType updated');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    PropertySubType::findOrFail($id)->delete();

    return redirect()->back()
        ->with('success','SubType deleted');
}

}
