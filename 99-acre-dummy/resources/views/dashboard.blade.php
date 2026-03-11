<x-app-layout>

<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('Dashboard') }}
</h2>
</x-slot>

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

<x-property-form
:purposes="$purposes"
:categories="$categories"
:types="$types"
/>

</div>

</div>

</div>

</div>

</div>

</div>

</x-app-layout>