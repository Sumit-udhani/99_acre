<div>

<h3 class="text-lg font-semibold mb-4">
Property Steps
</h3>

<ul class="space-y-3">

@foreach($steps as $step)

<li class="p-3 rounded-md border bg-gray-50 hover:bg-blue-50 cursor-pointer">

<span class="font-medium">
{{ $step->title }}
</span>

</li>

@endforeach

</ul>

</div>