<div>

<h3 class="text-lg font-semibold mb-4">
Property Steps
</h3>

<ul class="space-y-4">

@foreach($steps as $s)

<li>

<div class="flex justify-between items-start">

<div>
<span 
data-step="{{ $s->slug }}"
class="font-medium text-gray-700"
>
{{ $s->title }}
</span>

{{-- SUMMARY --}}
@if(isset($property) && $s->slug == 'basic' && $property->purpose)
<div class="text-sm text-gray-500 mt-1">
{{ $property->purpose->name }} •
{{ $property->category->name }} •
{{ $property->type->name }}
</div>
@endif
</div>

{{-- EDIT BUTTON --}}
@if($s->slug == 'basic' )
<button 
type="button"
data-id=""
onclick="editBasicStep(this)"
class="text-blue-600 text-sm hover:underline hidden"
id="editBasicBtn">
Edit
</button>
@endif
@if($s->slug == 'location')
<button 
    type="button"
    onclick="editLocationStep()"
    class="text-blue-600 text-sm hover:underline hidden"
    id="editLocationBtn">
    Edit
</button>
@endif
</div>

</li>

@endforeach

</ul>

</div>