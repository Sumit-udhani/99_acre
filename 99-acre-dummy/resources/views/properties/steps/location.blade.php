<x-app-layout>
    @push('scripts')
    
    @vite('resources/js/property-location.js')
    <script
    src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap"
    async
    defer>
    </script>
    
    
    @endpush
@section('content')
<div class="max-w-3xl mx-auto py-8">

    <h2 class="text-xl font-semibold mb-6">
        Add Property Location
    </h2>

    <form method="POST"
        action="{{ route('property.location.store',$property->id) }}"
        class="space-y-6">

        @csrf

        {{-- CITY --}}
        <div>
            <x-input-label for="city" value="City" />

            <div class="flex gap-2 mt-1">

                <x-text-input
                    id="city"
                    name="city"
                    type="text"
                    class="block w-full"
                    placeholder="Enter City"
                    required />

                <x-primary-button
                    type="button"
                    id="detectLocation"
                    class="flex items-center gap-2">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 21c4.5-4.5 7-7.5 7-11a7 7 0 10-14 0c0 3.5 2.5 6.5 7 11z" />

                        <circle cx="12" cy="10" r="2.5" />

                    </svg>

                    Detect Location

                </x-primary-button>

            </div>

        </div>


        {{-- LOCALITY --}}
        <div>

            <x-input-label for="locality" value="Locality" />

            <x-text-input
                id="locality"
                name="locality"
                type="text"
                class="block w-full mt-1"
                placeholder="Enter locality"
                required />

        </div>


        {{-- SUB LOCALITY --}}
        <div>

            <x-input-label
                for="sub_locality"
                value="Sub Locality" />

            <x-text-input
                id="sub_locality"
                name="sub_locality"
                type="text"
                class="block w-full mt-1"
                placeholder="Apartment / society / landmark" />

        </div>


        {{-- ADDRESS --}}
        <div>

            <x-input-label
                for="address"
                value="Full Address" />

            <textarea
                id="address"
                name="address"
                rows="3"
                required
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1"
                placeholder="Enter full address"></textarea>

        </div>


        {{-- MAP --}}
        <div>

            <x-input-label value="Map Location" />

            <div id="map"
                class="w-full h-80 rounded-md border">
            </div>

        </div>


        {{-- LAT LONG --}}
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">


        <div class="pt-4">

            <x-primary-button class="w-full justify-center">
                Continue
            </x-primary-button>

        </div>

    </form>

</div>

</x-app-layout>