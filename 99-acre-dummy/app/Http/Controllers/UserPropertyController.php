<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Container\Attributes\Auth;
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

        return redirect()->route('property.location', $property->id);
    }
    public function location($id)
{
    $property = Property::findOrFail($id);

    return view('properties.steps.location', compact('property'));
}
}
