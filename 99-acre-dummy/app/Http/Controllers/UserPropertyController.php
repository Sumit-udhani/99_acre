<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyProfile;
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
            'type_id' => 'required',
            'sub_type_id' => 'nullable',
            'location_type_id' => 'nullable'

        ]);

        $property = Property::create([
            'user_id' => FacadesAuth::id(),
            'purpose_id' => $request->purpose_id,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
            'sub_type_id' => $request->sub_type_id,
            'location_type_id' => $request->location_type_id
        ]);

        return response()->json([
            'success' => true,
           'property_id' => $property->id
        ]);
    }
    public function location($id)
    {
        $property = Property::findOrFail($id);

        $purposes = PropertyPurpose::all();
        $categories = PropertyCategory::all();
        $types = PropertyType::all();
        $steps = PropertyStep::where('active', 1)->orderBy('order')->get();

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
        $steps = PropertyStep::where('active', 1)->orderBy('order')->get();

        return view('dashboard', [
            'step' => 'basic',
            'property' => $property,
            'purposes' => $purposes,
            'categories' => $categories,
            'types' => $types,
            'steps' => $steps
        ]);
    }
     public function saveLocation(Request $request,$id)
{
    $request->validate([
        'city'=>'required',
        'locality'=>'required',
        'address'=>'required'
    ]);

    $property = Property::findOrFail($id);

    $property->update([
        'city'=>$request->city,
        'locality'=>$request->locality,
        'sub_locality'=>$request->sub_locality,
        'address'=>$request->address,
        'latitude'=>$request->latitude,
        'longitude'=>$request->longitude
    ]);

   return response()->json([
    'success' => true,
    'property_id' => $property->id
]);
}

//Save property profile form 


public function saveProfile(Request $request, $id)
{
    $validated = $request->validate([
        'bedrooms' => 'required',
        'bathrooms' => 'required',
        'balconies' => 'required',

        'carpet_area' => 'required|numeric',
        'area_unit' => 'required',

        'builtup_area' => 'nullable|numeric',
        'super_builtup_area' => 'nullable|numeric',

        'total_floors' => 'required|integer',
        'floor_no' => 'required',

        'availability_status' => 'required',
        'ownership' => 'required',
    ]);

    // ✅ DRY: no repetition
    PropertyProfile::updateOrCreate(
        ['property_id' => $id],
        $validated
    );

    return response()->json([
        'success' => true
    ]);
}
    public function updateBasic(Request $request, $id)
    {
        $request->validate([
            'purpose_id' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'sub_type_id' => 'nullable',
            'location_type_id' => 'nullable'
        ]);

        $property = Property::findOrFail($id);

        $property->update([
            'purpose_id' => $request->purpose_id,
            'category_id' => $request->category_id,
            'type_id' => $request->type_id,
            'sub_type_id' => $request->sub_type_id,
            'location_type_id' => $request->location_type_id
        ]);

        return response()->json([
            'success'=>true,
             'property_id' => $property->id
        ]);
    }
}
