<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Dashboard') }}
</h2>
</x-slot>
<input type="hidden" id="global_purpose_id" name="purpose_id">
<div class="py-12">

<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

<div class="bg-white shadow-sm sm:rounded-lg">

<div class="p-6">

<div class="flex gap-6">

{{-- LEFT SIDE : PROPERTY STEPS --}}
<div class="w-1/4 border-r pr-6">

@include('properties.steps.sidebar')

</div>


{{-- RIGHT SIDE : PROPERTY FORM --}}
<div class="w-3/4">

{{-- BASIC STEP --}}
<div id="basicStep">

<x-property-form
:purposes="$purposes"
:categories="$categories"
:types="$types"
/>

</div>

{{-- LOCATION STEP --}}
<div id="locationStep" style="display:none;">

@include('properties.steps.location')

</div>
<div id="profileStep" style="display:none;">
    @include('properties.steps.propertyProfile', [
    'areaUnits' => $areaUnits,
    'floors' => $floors,
    'availability' => $availability,
    'ownerships' => $ownerships,
    'furnishings'=> $furnishings,
    'furnishingItems'=>$furnishingItems,
    'rentout'=>$rentout,
   
])
</div>
</div>

</div>

</div>

</div>

</div>

</x-app-layout>