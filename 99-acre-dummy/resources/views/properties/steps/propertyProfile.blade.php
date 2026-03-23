@vite('resources/js/property-profile.js')
<form id="propertyProfileForm">
   @csrf
   <input type="hidden" id="property_id" name="property_id">

   <h2 class="text-xl font-semibold">Tell us about your property</h2>

   {{-- AREA DETAILS --}}
   <div>
      <h3 class="font-medium mb-2">Add Area Details</h3>

      <div class="flex gap-3 items-center">
         <x-text-input
            type="number"
            name="carpet_area"
            placeholder="Carpet Area"
            class="w-2/3" />

         <select name="area_unit"
            class="area-unit w-1/3 h-[42px] px-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @foreach($areaUnits as $unit)
            <option value="{{ $unit }}">{{ $unit }}</option>
            @endforeach
         </select>
      </div>

     <div class="mt-2 text-sm text-blue-600">

   {{-- TOGGLE LINKS --}}
   <span class="cursor-pointer mr-4" id="addBuiltup">
      + Built-up Area
   </span>

   <span class="cursor-pointer" id="addSuperBuiltup">
      + Super Built-up Area
   </span>

   {{-- BUILT-UP INPUT --}}
   <div id="builtupWrap" class="mt-3 hidden">
      <div class="flex gap-3 items-center">
         <x-text-input
            type="number"
            name="builtup_area"
            placeholder="Built-up Area"
            class="w-2/3" />

         <select
            class="area-unit w-1/3 h-[42px] px-2 border-gray-300 rounded-md shadow-sm">
            @foreach($areaUnits as $unit)
            <option value="{{ $unit }}">{{ $unit }}</option>
            @endforeach
         </select>
      </div>
   </div>

   {{-- SUPER BUILT-UP INPUT --}}
   <div id="superBuiltupWrap" class="mt-3 hidden">
      <div class="flex gap-3 items-center">
         <x-text-input
            type="number"
            name="super_builtup_area"
            placeholder="Super Built-up Area"
            class="w-2/3" />

         <select 
            class="area-unit w-1/3 h-[42px] px-2 border-gray-300 rounded-md shadow-sm">
            @foreach($areaUnits as $unit)
            <option value="{{ $unit }}">{{ $unit }}</option>
            @endforeach
         </select>
      </div>
   </div>

</div>
   </div>

   {{-- ROOM DETAILS --}}
   <div>
      <h3 class="font-medium mb-3">Add Room Details</h3>

      {{-- Bedrooms --}}
      <div class="mb-4">
         <label class="block text-sm mb-2">No. of Bedrooms</label>
         <div class="flex gap-2">
            @foreach([1,2,3,4] as $num)
            <button type="button"
               data-field="bedrooms"
               data-value="{{ $num }}"
           
               class="room-btn">
               {{ $num }}
            </button>
            @endforeach
         </div>
         <input type="hidden" name="bedrooms">
      </div>

      {{-- Bathrooms --}}
      <div class="mb-4">
         <label class="block text-sm mb-2">No. of Bathrooms</label>
         <div class="flex gap-2">
            @foreach([1,2,3,4] as $num)
            <button type="button"
               data-field="bathrooms"
               data-value="{{ $num }}"
               
               class="room-btn">
               {{ $num }}
            </button>
            @endforeach
         </div>
         <input type="hidden" name="bathrooms">
      </div>

      {{-- Balconies --}}
      <div>
         <label class="block text-sm mb-2">Balconies</label>
         <div class="flex gap-2">
            @foreach([0,1,2,3] as $num)
            <button type="button"
               data-field="balconies"
               data-value="{{ $num }}"
              
               class="room-btn">
               {{ $num }}
            </button>
            @endforeach
         </div>
         <input type="hidden" name="balconies">
      </div>
   </div>
{{-- FURNISHING --}}

   {{-- FLOOR DETAILS --}}
   <div>
      <h3 class="font-medium mb-3">Floor Details</h3>

      <div class="flex gap-3">
         <x-text-input
            type="number"
            name="total_floors"
            placeholder="Total Floors"
            class="w-full" />

         <select name="floor_no"
            class="w-1/3 h-[42px] px-2 border-gray-300 rounded-md shadow-sm">

            <option value="">Property on floor</option>

            @foreach($floors as $floor)
            <option value="{{ $floor }}">{{ $floor }}</option>
            @endforeach
         </select>
      </div>
   </div>
  <div id="rentSection" class="mt-6 hidden">

    {{-- FURNISHING --}}
    <div class="mt-5" id="furnishingBlock">
        <h3 class="font-medium mb-2 flex items-center gap-2">
            Furnishing
            <span class="text-red-500">*</span>
        </h3>

        <div class="flex gap-3 flex-wrap">
            @foreach($furnishings as $item)
            <button type="button"
                data-group="furnishing"
                data-value="{{ $item }}"
                class="chip-btn furnishing-btn">
                {{ $item }}
            </button>
            @endforeach
        </div>

        <input type="hidden" name="furnishing">

        <div id="furnishingDropdown" class="mt-4 hidden">
            <div class="w-64 rounded-md shadow-lg bg-white border p-3">
                <div class="grid grid-cols-2 gap-2 max-h-64 overflow-y-auto">
                    @foreach($furnishingItems as $item)
                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox"
                            name="furnishing_items[]"
                            class="furnishing-item-checkbox"
                            value="{{ $item }}">
                        {{ $item }}
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- AGE --}}
    <div id="ageBlock">
        <h3 class="font-medium mb-2">Age of property</h3>

        <div class="flex gap-3 flex-wrap">
            @php
                $ages = ['0-1 years','1-5 years','5-10 years','10+ years'];
            @endphp

            @foreach($ages as $item)
            <button type="button"
                data-group="property_age"
                data-value="{{ $item }}"
                class="chip-btn">
                {{ $item }}
            </button>
            @endforeach
        </div>

        <input type="hidden" name="property_age">
    </div>

    {{-- AVAILABLE --}}
    <div class="mt-4" id="availableBlock">
        <h3 class="font-medium mb-2">Available from</h3>

        <x-text-input 
            type="date"
            name="property_date"
            class="w-1/2" />
    </div>

    {{-- RENT ONLY FIELDS --}}
    <div id="rentOnlyFields">

        <div class="mt-4">
            <h3 class="font-medium mb-2">Preferred agreement type</h3>

            <div class="flex gap-3 flex-wrap">
                @php
                    $agreements = ['Company lease agreement','Any'];
                @endphp

                @foreach($agreements as $item)
                <button type="button"
                    data-group="agreement_type"
                    data-value="{{ $item }}"
                    class="chip-btn">
                    {{ $item }}
                </button>
                @endforeach
            </div>

            <input type="hidden" name="agreement_type">
        </div>

        <div class="mt-4">
            <h3 class="font-medium mb-2">
                Are you ok with brokers contacting you?
            </h3>

            <div class="flex gap-3">
                <button type="button"
                    data-group="broker_contact"
                    data-value="yes"
                    class="chip-btn">Yes</button>

                <button type="button"
                    data-group="broker_contact"
                    data-value="no"
                    class="chip-btn">No</button>
            </div>

            <input type="hidden" name="broker_contact">
        </div>

        <div class="mt-5">
            <h3 class="font-medium mb-2">
                Willing to rent out to
            </h3>

            <div class="flex gap-3 flex-wrap">
                @foreach($rentout as $item)
                <button type="button"
                    data-group="rent_out"
                    data-value="{{ $item }}"
                    class="chip-btn">
                    {{ $item }}
                </button>
                @endforeach
            </div>

            <input type="hidden" name="rent_out">
        </div>

    </div>
</div>
   
   {{-- AVAILABILITY --}}
<div>
    <h3 class="font-medium mb-2">Availability Status</h3>

    <div class="flex gap-3">
        @foreach($availability as $item)
        <button type="button"
            data-group="availability_status"
            data-value="{{ $item }}"
            class="chip-btn">
            {{ $item }}
        </button>
        @endforeach
    </div>

    <input type="hidden" name="availability_status">
</div>

   {{-- OWNERSHIP --}}
  {{-- OWNERSHIP --}}
<div>
    <h3 class="font-medium mb-2">Ownership</h3>

    <div class="flex gap-3">
        @foreach($ownerships as $item)
        <button type="button"
            data-group="ownership"
            data-value="{{ $item }}"
            class="chip-btn">
            {{ $item }}
        </button>
        @endforeach
    </div>

    <input type="hidden" name="ownership">
</div>
   {{-- SUBMIT --}}
   <div class="mt-6">
      <x-primary-button class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
    Continue
</x-primary-button>
   </div>

</form>