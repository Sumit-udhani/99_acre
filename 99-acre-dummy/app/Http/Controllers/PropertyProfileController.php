<?php

namespace App\Http\Controllers;

use App\Models\PropertyProfile;
use Illuminate\Http\Request;

class PropertyProfileController extends Controller
{
    /**
     * List all profiles
     */
    public function index()
    {
        $profiles = PropertyProfile::latest()->get();

        return view('admin.property.property-profile.index', compact('profiles'));
    }

    /**
     * Store (optional if admin creates manually)
     */
    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        PropertyProfile::create($validated);

        return back()->with('success', 'Profile created successfully');
    }

    /**
     * Update (MAIN USE CASE)
     */
    public function update(Request $request,PropertyProfile $property_profile)
    {
        $validated = $this->validateData($request);

        $property_profile->update($validated);

        return redirect()
            ->route('property-profiles.index')
            ->with('success', 'Profile updated successfully');
    }

    /**
     * Delete
     */
    public function destroy(string $id)
    {
        $profile = PropertyProfile::findOrFail($id);
        $profile->delete();

        return back()->with('success', 'Profile deleted successfully');
    }

    /**
     * DRY VALIDATION
     */
    private function validateData(Request $request)
    {
        return $request->validate([
            // Only admin-managed fields (as per your requirement)

            'area_unit' => 'required|string|max:50',
            'floor_no' => 'required|string|max:50',
            'availability_status' => 'required|string|max:100',
            'ownership' => 'required|string|max:100',
        ]);
    }
}