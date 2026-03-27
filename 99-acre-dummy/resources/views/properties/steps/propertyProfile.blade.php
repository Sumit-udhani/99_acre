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
                placeholder="Carpet Area, Plot Area"
                min="0"
                class="w-2/3" />
            <select name="area_unit"
                class="area-unit w-1/3 h-[42px] px-2 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @foreach($areaUnits as $unit)
                <option value="{{ $unit }}">{{ $unit }}</option>
                @endforeach
            </select>
        </div>
        <div class="text-red-500 text-sm mt-1" id="error-carpet_area"></div>


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
                        min="0"
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
                        min="0"
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

    {{-- ================= OFFICE ONLY SECTION ================= --}}
    <div id="officeSection" class="mt-6 hidden">

        <h3 class="font-medium mb-3">Describe your office setup</h3>

        {{-- Seats --}}
        <div class="flex gap-3 mb-4">
            <x-text-input
                type="number"
                name="min_seats"
                placeholder="Min. no. of Seats"
                class="w-1/2"
                min="0" />

            <x-text-input
                type="number"
                name="max_seats"
                placeholder="Max. no. of Seats (optional)"
                class="w-1/2"
                min="0" />
        </div>
<div id="error-min_seats" class="text-red-500 text-sm"></div>
        {{-- Cabins --}}
        <div class="mb-4">
            <x-text-input
                type="number"
                name="cabins"
                placeholder="No. of Cabins"
                class="w-1/2"
                min="0" />
        </div>
<div id="error-min_seats" class="text-red-500 text-sm"></div>
        {{-- Meeting Rooms --}}
        <div class="mb-4">
            <x-text-input
                type="number"
                name="meeting_rooms"
                placeholder="No. of Meeting Rooms"
                class="w-1/2"
                min="0" />
        </div>
<div id="error-cabins" class="text-red-500 text-sm"></div>
        {{-- Washrooms --}}
        <div class="mb-4">
            <h3 class="font-medium mb-2">Washrooms</h3>
            <div class="flex gap-3">
                <button type="button" class="chip-btn" data-field="washrooms" data-value="available">Available</button>
                <button type="button" class="chip-btn" data-field="washrooms" data-value="not_available">Not Available</button>
            </div>
            <input type="hidden" name="washrooms">
        </div>
<div id="error-washrooms" class="text-red-500 text-sm"></div>
        {{-- Conference Room --}}
        <div class="mb-4">
            <h3 class="font-medium mb-2">Conference Room</h3>
            <div class="flex gap-3">
                <button type="button" class="chip-btn" data-field="conference_room" data-value="available">Available</button>
                <button type="button" class="chip-btn" data-field="conference_room" data-value="not_available">Not Available</button>
            </div>
            <input type="hidden" name="conference_room">
        </div>
<div id="error-washrooms" class="text-red-500 text-sm"></div>
        {{-- Reception --}}
        <div class="mb-4">
            <h3 class="font-medium mb-2">Reception Area</h3>
            <div class="flex gap-3">
                <button type="button" class="chip-btn" data-field="reception_area" data-value="available">Available</button>
                <button type="button" class="chip-btn" data-field="reception_area" data-value="not_available">Not Available</button>
            </div>
            <input type="hidden" name="reception_area">
        </div>
<div id="error-reception_area" class="text-red-500 text-sm"></div>
        {{-- Pantry --}}
        <div class="mb-4">
            <h3 class="font-medium mb-2">Pantry Type</h3>
            <div class="flex gap-3">
                <button type="button" class="chip-btn" data-field="pantry_type" data-value="private">Private</button>
                <button type="button" class="chip-btn" data-field="pantry_type" data-value="shared">Shared</button>
                <button type="button" class="chip-btn" data-field="pantry_type" data-value="not_available">Not Available</button>
            </div>
            <input type="hidden" name="pantry_type">
        </div>
<div id="error-pantry_type" class="text-red-500 text-sm"></div>
        {{-- LIFTS --}}
        <div class="mb-4">
            <h3 class="font-medium mb-2">Lifts</h3>
            <div class="flex gap-3">
                <button type="button" class="chip-btn" data-field="lifts" data-value="available">Available</button>
                <button type="button" class="chip-btn" data-field="lifts" data-value="not_available">Not Available</button>
            </div>
            <input type="hidden" name="lifts">
        </div>
<div id="error-lifts" class="text-red-500 text-sm"></div>
        {{-- PARKING --}}
        <div class="mb-4">
            <h3 class="font-medium mb-2">Parking</h3>
            <div class="flex gap-3">
                <button type="button" class="chip-btn" data-field="parking" data-value="available">Available</button>
                <button type="button" class="chip-btn" data-field="parking" data-value="not_available">Not Available</button>
            </div>
            <input type="hidden" name="parking">
        </div>
<div id="error-parking" class="text-red-500 text-sm"></div>

    </div>

    {{-- Washrooms --}}
        <div id="retailExtraSection" class="hidden">
        <div class="mb-4">
            <h3 class="font-medium mb-2">Washrooms</h3>
            <div class="flex gap-3">
                <button type="button" class="chip-btn" data-field="washrooms" data-value="available">Available</button>
                <button type="button" class="chip-btn" data-field="washrooms" data-value="not_available">Not Available</button>
            </div>
            <input type="hidden" name="washrooms">
        <div id="error-washrooms" class="text-red-500 text-sm"></div>

        </div>

        {{-- PARKING --}}
        <div class="mb-4">
            <h3 class="font-medium mb-2">Parking</h3>
            <div class="flex gap-3">
                <button type="button" class="chip-btn" data-field="parking" data-value="available">Available</button>
                <button type="button" class="chip-btn" data-field="parking" data-value="not_available">Not Available</button>
            </div>
            <input type="hidden" name="parking">
            
        </div>
        <div id="error-parking" class="text-red-500 text-sm"></div>
        </div>


    <div id="hospitalitySection" style="display:none;">

    <div class="mb-4">
        <h3 class="font-medium mb-2">Quality Ranking</h3>

        <div class="flex gap-3 flex-wrap">
            @foreach($qualityRatings as $item)
                <button type="button"
                    class="option-btn chip-btn"
                    data-group="quality_ratings"
                    data-value="{{ $item }}">
                    {{ $item }}
                </button>
            @endforeach
        </div>

        <input type="hidden" name="quality_ratings">
          <div id="error-quality_ratings" class="text-red-500 text-sm"></div>
    </div>
   

    <div class="mb-4" id="washroomBlock">
        <h3 class="font-medium mb-2">No. of Washrooms</h3>

        <div class="flex gap-3 flex-wrap">
            @foreach($washrooms as $item)
                <button type="button"
                    class="option-btn chip-btn"
                     data-group="no_of_washroom"
                    data-value="{{ $item }}">
                    {{ $item }}
                </button>
            @endforeach
        </div>
  <div class="text-sm text-blue-600 cursor-pointer mb-2" id="addWashroom">
        + Add other
    </div>

    
    <div id="washroomInputWrap" class="hidden">
      <x-text-input type="number" id="customWashroom"  placeholder="No of washrooms" class="s-2/3" />

    <input type="hidden" name="no_of_washroom">
        <!-- ✅ Error -->
    </div>
    <div id="error-no_of_washroom" class="text-red-500 text-sm"></div>

</div>
 </div>

 <!-- Storage Section -->
<div id="storageSection" class="hidden mt-6"></div>


    <div id="plotLandSection" style="display:none;">


        <div class="mb-4">
            <label class="fw-semibold">Is there a boundary wall around the property?</label>


            <div class="d-flex gap-2">
                <button type="button"
                    class="btn option-btn chip-btn"
                    data-group="boundary_wall"
                    data-value="Yes">
                    Yes
                </button>

                <button type="button"
                    class="btn option-btn chip-btn"
                    data-group="boundary_wall"
                    data-value="No">
                    No
                </button>
            </div>

            <input type="hidden" name="boundary_wall">

            <div id="error-boundary_wall" class="text-red-500 text-sm"></div>
        </div>

        <!-- Open Sides -->
        <div class="mb-4">
            <label class="fw-semibold">No. of open sides</label>


            <div class="d-flex gap-2">
                @foreach([1,2,3,'3+'] as $num)
                <button type="button" class="btn option-btn share-count-btn chip-btn" data-group="open_sides"
                    data-value="{{ $num }}">
                    {{ $num }}
                </button>
                @endforeach
            </div>

            <input type="hidden" name="open_sides">
            <div id="error-open_sides" class="text-red-500 text-sm"></div>

        </div>

        <!-- Construction -->
        <div class="mb-4">
            <label class="fw-semibold">Any construction done on this property?</label>


            <div class="d-flex gap-2">
                <button type="button" class="btn option-btn chip-btn" data-group="is_construction"
 data-value="Yes">Yes</button>
                <button type="button" class="btn option-btn chip-btn" data-group="is_construction" data-value="No">No</button>
            </div>

            <input type="hidden" name="is_construction">
            <div id="error-is_construction" class="text-red-500 text-sm"></div>

        </div>

        <!-- Possession -->
        <div class="mb-4">
            <label class="fw-semibold">Possession By</label> <br>

            <select name="property_possesion" class="form-control mt-2">
                <option value="">Expected by</option>
                @foreach($possesions as $pos)
                <option value="{{ $pos }}">{{ $pos }}</option>
                @endforeach
            </select>

            <div id="error-property_possesion" class="text-red-500 text-sm"></div>
        </div>

    </div>
    {{-- ROOM DETAILS --}}
    <div id="room-section">
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
        <div id="error-bedrooms" class="text-red-500 text-sm"></div>

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
        <div id="error-bathrooms" class="text-red-500 text-sm"></div>

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
    <div id="error-balconies" class="text-red-500 text-sm"></div>

    {{-- FURNISHING --}}

    {{-- FLOOR DETAILS --}}
    <div id="floorSection">
        <h3 class="font-medium mb-3">Floor Details</h3>

        <div class="flex gap-3">
            <x-text-input
                type="number"
                name="total_floors"
                placeholder="Total Floors"
                min="0"
                class="w-full" />

            <select name="floor_no" id="floor_no"
                class="w-1/3 h-[42px] px-2 border-gray-300 rounded-md shadow-sm">

                <option value="">Property on floor</option>
                <option value="Basement">Basement</option>
                <option value="Ground">Ground</option>

            </select>
        </div>

        <!-- ✅ Error containers -->
        <div id="error-total_floors" class="text-red-500 text-sm"></div>
        <div id="error-floor_no" class="text-red-500 text-sm"></div>
    </div>
    <!-- ================= PG ONLY SECTION ================= -->
    <div id="pgOnlyFields" class="mt-6 hidden">

        {{-- ROOM TYPE --}}
        <div class="mt-5" id="roomTypeBlock">
            <h3 class="font-medium mb-2">Room Type</h3>

            <div class="flex gap-3">
                <button type="button"
                    class="chip-btn room-type-btn"
                    data-value="Sharing">
                    Sharing
                </button>

                <button type="button"
                    class="chip-btn room-type-btn"
                    data-value="Private">
                    Private
                </button>
            </div>

            <input type="hidden" name="room_type" id="room_type">
            <div id="error-room_type" class="text-red-500 text-sm"></div>
            {{-- SHARING COUNT --}}
            <div id="sharingCountBlock" class="mt-4 hidden">
                <h3 class="font-medium mb-2">
                    How many people can share this room?
                </h3>

                <div class="flex gap-3 flex-wrap">
                    @foreach(['2','3','4','4+'] as $val)
                    <button type="button"
                        class="share-count-btn"
                        data-value="{{ $val }}">
                        {{ $val }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>
        <div id="error-sharing_count" class="text-red-500 text-sm"></div>

        <!-- RESERVED PARKING -->
        <div class="mt-4">
            <h3 class="font-medium mb-2">Reserved Parking (Optional)</h3>

            <div class="flex gap-6 items-center">

                <!-- Covered -->
                <div class="flex items-center gap-2">
                    <span>Covered</span>
                    <button type="button" class="parking-minus" data-type="covered" class="room-btn">-</button>
                    <span id="coveredCount">0</span>
                    <button type="button" class="parking-plus" data-type="covered">+</button>
                </div>

                <!-- Open -->
                <div class="flex items-center gap-2">
                    <span>Open</span>
                    <button type="button" class="parking-minus" data-type="open">-</button>
                    <span id="openCount">0</span>
                    <button type="button" class="parking-plus" data-type="open">+</button>
                </div>

            </div>

            <input type="hidden" name="parking" id="parkingInput">
        </div>

        <!-- AVAILABLE FOR -->
        <div class="mt-5">
            <h3 class="font-medium mb-2">Available for</h3>

            <div class="flex gap-3">
                <button type="button" data-group="available_gender" data-value="Girls" class="chip-btn">Girls</button>
                <button type="button" data-group="available_gender" data-value="Boys" class="chip-btn">Boys</button>
                <button type="button" data-group="available_gender" data-value="Any" class="chip-btn">Any</button>
            </div>

            <input type="hidden" name="available_gender">
        </div>
        <div id="error-available_gender" class="text-red-500 text-sm"></div>

        <!-- SUITABLE FOR -->
        <div class="mt-5">
            <h3 class="font-medium mb-2">Suitable for</h3>

            <div class="flex gap-4 flex-wrap">

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="suitable_for[]" value="Students">
                    Students
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="suitable_for[]" value="Working Professionals">
                    Working Professionals
                </label>

            </div>
        </div>
        <div id="error-suitable_for" class="text-red-500 text-sm"></div>
    </div>

    <div id="rentSection" class="mt-6 hidden">

        {{-- FURNISHING --}}
        <div id="furnishingWrapper" class="hidden">
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
                <div id="error-furnishing" class="text-red-500 text-sm"></div>

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
                <div id="error-furnishing_items" class="text-red-500 text-sm"></div>
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
        <div id="error-property_age" class="text-red-500 text-sm"></div>

        {{-- AVAILABLE --}}
        <div class="mt-4" id="availableBlock">
            <h3 class="font-medium mb-2">Available from</h3>

            <x-text-input
                type="date"
                name="property_date"
                class="w-1/2" />
        </div>
        <div id="error-property_date" class="text-red-500 text-sm"></div>

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
            <div id="error-agreement_type" class="text-red-500 text-sm"></div>

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
            <div id="error-broker_contact" class="text-red-500 text-sm"></div>

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
        <div id="error-rent_out" class="text-red-500 text-sm"></div>
    </div>

    {{-- AVAILABILITY --}}
    <div id="availabilitySection">
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

        <!-- ✅ Error -->
        <div id="error-availability_status" class="text-red-500 text-sm"></div>
    </div>
    {{-- Ownership --}}
    <div id="ownershipSection">
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

        <!-- ✅ Error -->
        <div id="error-ownership" class="text-red-500 text-sm"></div>
    </div>
    <div class="mt-6">
    <h3 class="font-medium mb-3">Price Details</h3>

    <div class="mt-6">
    <h3 class="font-medium mb-3">Price Details</h3>

    <div class="flex gap-3">

        {{-- EXPECTED PRICE --}}
        <div id="priceSection">
        <div class="w-2/3">
            <x-text-input
                type="number"
                 name="property_price"
                placeholder="₹ Expected Price"
                min="0"
                id="expected_price"
                class="w-full" />

            <div id="error-expected_price" class="text-red-500 text-sm mt-1"></div>
        </div>

        {{-- PRICE PER UNIT --}}
      <div class="w-1/3 flex">

    {{-- DISPLAY ONLY FIELD --}}
    <x-text-input
        type="text"
        id="price_display"
        placeholder="₹ Price per"
        class="w-full rounded-r-none bg-gray-100 text-gray-600 cursor-not-allowed"
        readonly />

    {{-- AREA UNIT --}}
    <x-text-input
        type="text"
        id="price_area_unit"
        class="w-[90px] text-center bg-gray-100 text-gray-600 cursor-not-allowed rounded-l-none"
        readonly />
</div>

    </div>
</div>
<div id="error-expected_price" class="text-red-500 text-sm mt-1"></div>
</div>
    {{-- SUBMIT --}}
    <div class="mt-6">
        <x-primary-button class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
            Continue
        </x-primary-button>
    </div>

</form>