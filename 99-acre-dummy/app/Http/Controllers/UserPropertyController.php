<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
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
    public function store(StorePropertyRequest  $request)
    {
        // $request->validate([
        //     'purpose_id' => 'required',
        //     'category_id' => 'required',
        //     'type_id' => 'required',
        //     'sub_type_id' => 'nullable',
        //     'location_type_id' => 'nullable'

        // ]);

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
    $property = \App\Models\Property::findOrFail($id);
    $purposeSlug = $property->purpose->slug ?? null;
$typesSlug = $property->type->slug?? null;
    $rules = [
        'bedrooms' => 'nullable',
        'bathrooms' => 'nullable',
        'balconies' => 'nullable',

        'carpet_area' => 'required|numeric',
        'area_unit' => 'required',

        'builtup_area' => 'nullable|numeric',
        'super_builtup_area' => 'nullable|numeric',

        'total_floors' => 'required|integer',
        'floor_no' => 'required',

        'availability_status' => 'required',
        'ownership' => 'required',
        'boundary_wall'=>'nullable',
         'open_sides' =>'nullable',
          'is_construction'=>'nullable',
        'property_possesion'=>'nullable',

        'quality_ratings'=>'nullable',
        'no_of_washroom'=>'nullable',

           
    ];

    // ✅ RENT
    if ($purposeSlug === 'rent-lease') {
        $rules = array_merge($rules, [
            'property_age'   => 'required',
            'property_date'  => 'required|date',
            'rent_out'       => 'required',
            'agreement_type' => 'required',
            'broker_contact' => 'required',
            'furnishing'     => 'required',
            'furnishing_items' => 'required|array',
        ]);
    }
if ($typesSlug === 'hospitality') {
    $rules = array_merge($rules, [
            'property_age'   => 'required',
          
            'furnishing'     => 'required',
            'furnishing_items' => 'required|array',
        ]);
}
    // ✅ PG
    if ($purposeSlug === 'pg') {
        $rules = array_merge($rules, [
            'property_age'   => 'required',
            'property_date'  => 'required|date',
            'furnishing'     => 'required',
            'furnishing_items' => 'required|array',

            'available_gender' => 'required',
            'suitable_for' => 'required|array',
            'parking' => 'nullable|string',
        'room_type'=>'nullable|string',
           
        ]);
    }

    $validated = $request->validate($rules);

    $data = $validated;

    // ✅ furnishing_items
    if (!empty($validated['furnishing_items'])) {
        $data['furnishing_items'] = implode(',', $validated['furnishing_items']);
    }

    // ✅ suitable_for (array → string)
    if (!empty($validated['suitable_for'])) {
        $data['suitable_for'] = implode(',', $validated['suitable_for']);
    }

    // ✅ parking already string from JS
    $data['parking'] = $request->parking ?? null;
    $data['room_type'] = $request->room_type ?? null;

   // ✅ CLEAN DATA
if ($purposeSlug === 'rent-lease') {
    // keep all
} 
elseif ($purposeSlug === 'pg') {
    unset(
        $data['rent_out'],
        $data['agreement_type'],
        $data['broker_contact']
    );
} 
elseif ($typesSlug === 'hospitality') {

    // ✅ KEEP ONLY required for hospitality
    unset(
        $data['property_date'],
        $data['rent_out'],
        $data['agreement_type'],
        $data['broker_contact'],
        $data['available_gender'],
        $data['suitable_for'],
        $data['parking'],
        $data['room_type']
    );

} 
else {
    // ❌ REMOVE for normal SELL
    unset(
        $data['property_age'],
        $data['property_date'],
        $data['rent_out'],
        $data['agreement_type'],
        $data['broker_contact'],
        $data['furnishing'],
        $data['furnishing_items'],
        $data['available_gender'],
        $data['suitable_for'],
        $data['parking'],
        $data['room_type']
    );
}

    \App\Models\PropertyProfile::updateOrCreate(
        ['property_id' => $id],
        $data
    );

    return response()->json([
        'success' => true
    ]);
}
// public function saveProfile(Request $request, $id)
// {
//     $property = \App\Models\Property::findOrFail($id);
//     $purposeSlug = $property->purpose->slug ?? null;

//     $rules = [
//         'bedrooms' => 'required',
//         'bathrooms' => 'required',
//         'balconies' => 'required',

//         'carpet_area' => 'required|numeric',
//         'area_unit' => 'required',

//         'builtup_area' => 'nullable|numeric',
//         'super_builtup_area' => 'nullable|numeric',

//         'total_floors' => 'required|integer',
//         'floor_no' => 'required',

//         'availability_status' => 'required',
//         'ownership' => 'required',
//     ];

//     // ✅ RENT-LEASE (ALL FIELDS)
//     if ($purposeSlug === 'rent-lease') {
//         $rules = array_merge($rules, [
//             'property_age'   => 'required',
//             'property_date'  => 'required|date',
//             'rent_out'       => 'required',
//             'agreement_type' => 'required',
//             'broker_contact' => 'required',
//             'furnishing'     => 'required',
//             'furnishing_items' => 'required|array',
//         ]);
//     }

//     // ✅ PG (ONLY FEW FIELDS)
//     if ($purposeSlug === 'pg') {
//         $rules = array_merge($rules, [
//             'property_age'   => 'required',
//             'property_date'  => 'required|date',
//             'furnishing'     => 'required',
//             'furnishing_items' => 'required|array',

//             'available_gender'=>'required',
//             'suitable_for'=>'required|array',
//             'parking'=>'nullable|string'
//         ]);
//     }

//     $validated = $request->validate($rules);

//     $data = $validated;

//     // ✅ HANDLE furnishing_items
//     if (!empty($validated['furnishing_items'])) {
//         $data['furnishing_items'] = implode(',', $validated['furnishing_items']);
//     } 
//     if (!empty($validated['suitable_for'])) {
//         $data['suitable_for'] = implode(',', $validated['suitable_for']);
//     }
    
//     else {
//         $data['furnishing_items'] = null;
//     }

//     // ✅ CLEAN DATA BASED ON PURPOSE
//     if ($purposeSlug === 'rent-lease') {
//         // keep all
//     } elseif ($purposeSlug === 'pg') {
//         // ❌ remove rent-only fields
//         unset(
//             $data['rent_out'],
//             $data['agreement_type'],
//             $data['broker_contact']
//         );
//     } else {
        
//         unset(
//             $data['property_age'],
//             $data['property_date'],
//             $data['rent_out'],
//             $data['agreement_type'],
//             $data['broker_contact'],
//             $data['furnishing'],
//             $data['furnishing_items']
//         );
//     }

//     PropertyProfile::updateOrCreate(
//         ['property_id' => $id],
//         $data
//     );

//     return response()->json([
//         'success' => true
//     ]);
// }
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
