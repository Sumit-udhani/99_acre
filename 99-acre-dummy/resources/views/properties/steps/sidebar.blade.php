<div>

<h3 class="text-lg font-semibold mb-4">
Property Steps
</h3>

<ul class="space-y-3">

@foreach($steps as $step)

<li class="p-3 rounded-md border
@if($step->slug == $step) 
bg-blue-50 border-blue-400
@else 
bg-gray-50 
@endif
">

<div class="flex justify-between items-center">

<span class="font-medium">
{{ $step->title }}
</span>

{{-- SHOW EDIT BUTTON ONLY IF STEP COMPLETED --}}
@if(isset($property) && $step->slug == 'basic' && $property->purpose_id)

<a href="{{ route('property.basic.edit',$property->id) }}"
class="text-blue-600 text-sm hover:underline">
Edit
</a>

@endif

</div>


{{-- SHOW BASIC DETAILS SUMMARY --}}
@if(isset($property) && $step->slug == 'basic' && $property->purpose)

<div class="text-sm text-gray-500 mt-1">

{{ $property->purpose->name }}
•
{{ $property->category->name }}
•
{{ $property->type->name }}

</div>

@endif


</li>

@endforeach

</ul>

</div>