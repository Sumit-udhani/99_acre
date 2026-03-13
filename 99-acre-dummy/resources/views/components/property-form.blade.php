
<form id="basicPropertyForm" method="POST" action="{{ route('property.store') }}">
@csrf

<div id="propertyApp" data-auth="{{ auth()->check() ? '1' : '0' }}">
<div class="card property-card">
<div class="card-body p-4">

@auth
<h1 class="text-lg font-semibold mb-3">
Welcome back {{ auth()->user()->name }}, Fill out basic details
</h1>
@else
<h5 class="fw-semibold fs-5 mb-3">
Start posting your property, it’s free
</h5>
@endauth


{{-- HIDDEN INPUTS (important for controller) --}}
<input type="hidden" name="purpose_id" id="purpose_id">
<input type="hidden" name="type_id" id="type_id">
<input type="hidden" name="location_type_id" id="location_type_id">


{{-- PURPOSE --}}
<label class="fw-semibold mb-2">
@auth
I'm looking to ...
@else
You're looking to ...
@endauth
</label>

<div class="purpose-group d-flex gap-2 flex-wrap mb-3">

@foreach($purposes as $purpose)

<button
type="button"
class="btn purpose-btn"
data-id="{{ $purpose->id }}"
data-name="{{ strtolower($purpose->name) }}"
>
{{ $purpose->name }}
</button>

@endforeach

</div>


{{-- CATEGORY --}}
<label class="fw-semibold mb-2">
And it's a...
</label>

<div class="category-radio-group mb-3">

@foreach($categories as $category)

<div class="form-check form-check-inline">

<input
class="form-check-input category-radio"
type="radio"
name="category_id"
id="category{{ $category->id }}"
data-name="{{ strtolower($category->name) }}"
value="{{ $category->id }}"
>

<label
class="form-check-label"
for="category{{ $category->id }}">
{{ $category->name }}
</label>

</div>

@endforeach

</div>


{{-- PROPERTY TYPES --}}
<div class="types-wrapper mb-3">

@foreach($types as $type)

<button
type="button"
class="btn purpose-btn type-btn"
data-id="{{ $type->id }}"
data-name="{{ strtolower($type->name) }}"
data-category="{{ $type->category_id }}"
>
{{ $type->name }}
</button>

@endforeach

</div>


{{-- SUB TYPES --}}
<div class="subtypes-wrapper mb-3" style="display:none;">

<label class="fw-semibold mb-2" id="subtype-label">
Your type is ...
</label>

<div class="subtype-list d-flex gap-2 flex-wrap">
</div>

</div>


{{-- LOCATION TYPES --}}
<div class="location-wrapper mb-3" style="display:none;">

<label class="fw-semibold mb-2">
Your shop is located inside ?
</label>

<div class="location-list d-flex gap-2 flex-wrap">
</div>

</div>


@guest
<label class="fw-semibold mt-2">
Your contact details for the buyer to reach you
</label>

<input
type="text"
class="form-control mt-2 mb-3 phone-field"
placeholder="Enter mobile number"
>
@endguest


<button type="submit" class="btn start-btn w-100">
@auth
Continue
@else
Start now
@endauth
</button>

</div>
</div>
</div>

</form>


<x-modal name="auth-modal" focusable maxWidth="md">

<div class="p-6"
x-data="{
form: 'register'
}">

<h2 class="text-lg font-semibold mb-4">
Register to Continue
</h2>

@include('auth.partials.register-form')

</div>

</x-modal>