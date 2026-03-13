<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyPurpose;
use App\Models\PropertyStep;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class UserPropertyController extends Controller
{
    //
      public function store(Request $request)
    {
        $request->validate([
            'purpose_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required'
        ]);

        $property = Property::create([
            'user_id' => FacadesAuth::id(),
            'purpose_id' => $request->purpose_id,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id
        ]);

      return response()->json([
    'success' => true,
    'redirect' => route('property.location', $property->id)
]); 
    }
public function location($id)
{
    $property = Property::findOrFail($id);

    $purposes = PropertyPurpose::all();
    $categories = PropertyCategory::all();
    $types = PropertyType::all();
    $steps = PropertyStep::where('active',1)->orderBy('order')->get();

    return view('dashboard', [
        'step' => 'location',
        'property' => $property,
        'purposes' => $purposes,
        'categories' => $categories,
        'types' => $types,
        'steps' => $steps
    ]);
}
public function editBasic($id)
{
    $property = Property::findOrFail($id);

    $purposes = PropertyPurpose::all();
    $categories = PropertyCategory::all();
    $types = PropertyType::all();
    $steps = PropertyStep::where('active',1)->orderBy('order')->get();

    return view('dashboard', [
        'step' => 'basic',
        'property' => $property,
        'purposes' => $purposes,
        'categories' => $categories,
        'types' => $types,
        'steps' => $steps
    ]);
}
public function updateBasic(Request $request,$id)
{
    $request->validate([
        'purpose_id' => 'required',
        'category_id' => 'required',
        'type_id' => 'required'
    ]);

    $property = Property::findOrFail($id);

    $property->update([
        'purpose_id' => $request->purpose_id,
        'category_id' => $request->category_id,
        'type_id' => $request->type_id
    ]);

    return redirect()->route('property.location',$property->id);
}
}
