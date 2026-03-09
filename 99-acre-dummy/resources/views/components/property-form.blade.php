<div id="propertyApp" data-auth="{{ auth()->check() ? '1' : '0' }}">
<div class="card property-card">
<div class="card-body p-4">

<h5 class="fw-semibold fs-5 mb-3">
Start posting your property, it’s free
</h5>

<p class="text-muted small mb-2">Add Basic Details</p>

{{-- PURPOSE --}}
<label class="fw-semibold mb-2">You're looking to ...</label>
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
<label class="fw-semibold mt-2">
Your contact details for the buyer to reach you
</label>

<input
type="text"
class="form-control mt-2 mb-3 phone-field"
placeholder="Enter mobile number"
>

<button class="btn start-btn w-100">
Start now
</button>

</div>
<x-modal name="auth-modal" focusable maxWidth="md">

<div class="p-6" x-data="{ form:'login' }">

<h2 class="text-lg font-semibold mb-4">
Login / Register
</h2>

{{-- LOGIN FORM --}}
<div x-show="form==='login'">

@include('auth.partials.login-form')


</div>


{{-- REGISTER FORM --}}
<div x-show="form==='register'">

@include('auth.partials.register-form')



</div>

</div>

</x-modal>
</div>
</div>
