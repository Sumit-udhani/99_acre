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
            class="w-1/3 h-[42px] px-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @foreach($areaUnits as $unit)
            <option value="{{ $unit }}">{{ $unit }}</option>
            @endforeach
         </select>
      </div>

      <div class="mt-2 text-sm text-blue-600 cursor-pointer">
         + Built-up Area &nbsp;&nbsp; + Super Built-up Area
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