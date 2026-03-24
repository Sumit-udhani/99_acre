@props([
'title',
'data',
'routePrefix',
'mode' => 'normal',
'hasOrderStatus' => false
])
@if(session('success'))
<div class="alert alert-success"
    style="background-color: lightgreen; color: white; width:auto;">
    {{ session('success') }}
</div>
@endif

<div id="ajax-success"></div>
<div class="container">
    <h2>{{ $title }}</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
        Add {{ $title }}
    </button>
    <div class="table-responsive">
        <table id="crudTable" class="table table-bordered">
            <thead>
                <tr>

                    @if($mode == 'property')

                    <th>Purpose</th>
                    <th>Category</th>
                    <th>Type</th>

                    <th>SubType</th>


                    <th>Location Type</th> {{-- NEW --}}
                    <th>City</th>
                    <th>Locality</th>
                    <th>Sub Locality</th>
                    <th>Address</th>
                    <th>Action</th>
                    @elseif($mode == 'user')

                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                    @elseif($mode == 'property-profile')
                    <th>#</th>
                    <th>Bedrooms</th>
                    <th>Bathrooms</th>
                    <th>Balconies</th>
                    <th>Carpet Area</th>
                    <th>Area Unit</th>
                    <th>Builtup Area</th>
                    <th>Super Builtup Area</th>
                    <th>Total Floors</th>
                    <th>Floor No</th>
                    <th>Availability</th>
                    <th>Ownership</th>





                    <th>Furnishing</th>
                    <th>Furnishing Items</th>

                    <th>Property Age</th>
                    <th>Available From</th>
                    <th>Agreement Type</th>
                    <th>Broker Contact</th>
                    <th>Rent Out</th>
                    <th>Available Gender</th>
                    <th>Suitable For</th>
                    <th>Parking</th>
                    <th>Room Type</th>


                    <th>Action</th>
                    @elseif($mode == 'property-profile-option')
                    <th>#</th>
                    <th>Area Unit</th>
                    <th>Floor No</th>
                    <th>Availability</th>
                    <th>Ownership</th>
                    <th>Furnishing</th>
                    <th>Rentout</th>
                    <th>Furnishing Items</th>

                    <th>Action</th>
                    @elseif($mode == 'normal')

                    <th>#</th>
                    <th>Name</th>

                    @if($types)
                    <th>Type</th>
                    @endif

                    @if($hasSlug)
                    <th>Slug</th>
                    @endif

                    @if($categories)
                    <th>Category</th>
                    @endif

                    @if($purposes)
                    <th>Purpose</th>
                    @endif
                    @if($hasOrderStatus)
                    <th>Order</th>
                    <th>Status</th>
                    @endif
                    <th>Action</th>

                    @endif
                </tr>
            </thead>

            <tbody>
                @forelse($items as $key => $item)
                <tr>

                    @if($mode == 'property')

                    <td>{{ $item->purpose->name ?? '' }}</td>
                    <td>{{ $item->category->name ?? '' }}</td>
                    <td>{{ $item->type->name ?? '' }}</td>

                    <td>{{ $item->subtype->name ?? '' }}</td>


                    <td>{{ $item->locationType->name ?? '-' }}</td>
                    <td>{{ $item->city ?? '-' }}</td>
                    <td>{{ $item->locality ?? '-' }}</td>
                    <td>{{ $item->sub_locality ?? '-' }}</td>
                    <td>{{ $item->address ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning"
                            data-toggle="modal"
                            data-target="#editModal{{ $item->id }}">
                            Edit
                        </button>

                        <form action="{{ route($routePrefix.'.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>


                    @elseif($mode == 'user')

                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>

                    <td>
                        @if($item->roles->isNotEmpty())
                        @foreach($item->roles as $role)
                        <span class="badge bg-success">
                            {{ ucfirst($role->name) }}
                        </span>
                        @endforeach
                        @else
                        <span class="badge bg-secondary">No Role</span>
                        @endif
                    </td>

                    <td>
                        <select class="form-control statusDropdown"
                            data-id="{{ $item->id }}">
                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $item->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $item->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </td>

                    <td>
                        <button class="btn btn-sm btn-warning"
                            data-toggle="modal"
                            data-target="#editModal{{ $item->id }}">
                            Edit
                        </button>

                        <form action="{{ route($routePrefix.'.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                    @elseif($mode == 'property-profile')
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->bedrooms ?? '-' }}</td>
                    <td>{{ $item->bathrooms ?? '-' }}</td>
                    <td>{{ $item->balconies ?? '-' }}</td>
                    <td>{{ $item->carpet_area ?? '-' }}</td>
                    <td>{{ $item->area_unit ?? '-' }}</td>
                    <td>{{ $item->builtup_area ?? '-' }}</td>
                    <td>{{ $item->super_builtup_area ?? '-' }}</td>
                    <td>{{ $item->total_floors ?? '-' }}</td>
                    <td>{{ $item->floor_no ?? '-' }}</td>
                    <td>{{ $item->availability_status ?? '-' }}</td>
                    <td>{{ $item->ownership ?? '-' }}</td>



                    <td>{{ $item->furnishing ?? '-' }}</td>
                    <td>
                        @if(!empty($item->furnishing_items))
                        {{ implode(', ', explode(',', $item->furnishing_items)) }}
                        @else
                        -
                        @endif
                    </td>

                    <td>{{ $item->property_age ?? '-' }}</td>
                    <td>{{ $item->property_date ?? '-' }}</td>
                    <td>{{ $item->agreement_type ?? '-' }}</td>
                    <td>{{ $item->broker_contact ?? '-' }}</td>
                    <td>{{ $item->rent_out ?? '-' }}</td>
                    <td>{{ $item->available_gender ?? '-' }}</td>
                    <td>
                        @if(!empty($item->suitable_for))
                        {{ implode(', ', explode(',', $item->suitable_for)) }}
                        @else
                        -
                        @endif
                    </td>
                        <td>
                        @if(!empty($item->parking))
                        {{ implode(', ', explode(',', $item->parking)) }}
                        @else
                        -
                        @endif
                    </td>
                    <td>{{ $item->room_type ?? '-' }}</td>

                    <td>
                        <button class="btn btn-sm btn-warning"
                            data-toggle="modal"
                            data-target="#editModal{{ $item->id }}">
                            Edit
                        </button>

                        <form action="{{ route($routePrefix.'.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                    @elseif($mode == 'property-profile-option')
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->area_unit ?? '-' }}</td>
                    <td>{{ $item->floor_no ?? '-' }}</td>
                    <td>{{ $item->availability_status ?? '-' }}</td>
                    <td>{{ $item->ownership ?? '-' }}</td>
                    <td>{{ $item->furnishing ?? '-' }}</td>
                    <td>{{ $item->rent_out ?? '-' }}</td>
                    <td>{{ $item->furnishing_items ?? '-' }}</td>

                    <td>
                        <button class="btn btn-sm btn-warning"
                            data-toggle="modal"
                            data-target="#editModal{{ $item->id }}">
                            Edit
                        </button>

                        <form action="{{ route($routePrefix.'.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                    @else

                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->title ?? $item->name }}</td>

                    @if($types)
                    <td>{{ $item->propertyType->name ?? '' }}</td>
                    @endif

                    @if($hasSlug)
                    <td>{{ $item->slug ?? '' }}</td>
                    @endif

                    @if($categories)
                    <td>{{ $item->category->name ?? '' }}</td>
                    @endif

                    @if($purposes)
                    <td>{{ $item->purpose->name ?? '' }}</td>
                    @endif
                    @if($hasOrderStatus)
                    <td>{{ $item->order }}</td>
                    <td>
                        @if($item->active)
                        <span class="badge bg-success">Active</span>
                        @else
                        <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    @endif
                    <td>
                        <button class="btn btn-sm btn-warning"
                            data-toggle="modal"
                            data-target="#editModal{{ $item->id }}">
                            Edit
                        </button>

                        <form action="{{ route($routePrefix.'.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>

                    @endif
                    <!-- <td>
                    <button class="btn btn-sm btn-warning"
                        data-toggle="modal"
                        data-target="#editModal{{ $item->id }}">
                        Edit
                    </button>

                    <form action="{{ route($routePrefix.'.destroy', $item->id) }}"
                        method="POST"
                        style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </td> -->
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">
                        No data found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ===================== --}}
{{-- EDIT MODALS OUTSIDE TABLE --}}
{{-- ===================== --}}
@foreach($items as $item)
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST"
            action="{{ route($routePrefix.'.update', $item->id) }}">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    @if($mode == 'property')

                    {{-- PURPOSE --}}
                    <div class="form-group mb-3">
                        <label>Select Purpose</label>
                        <select name="purpose_id" class="form-control" required>
                            @foreach($purposes as $purpose)
                            <option value="{{ $purpose->id }}"
                                {{ $item->purpose_id == $purpose->id ? 'selected' : '' }}>
                                {{ $purpose->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- CATEGORY --}}
                    <div class="form-group mb-3">
                        <label>Select Category</label>
                        <select name="category_id" class="form-control" required>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- TYPE --}}
                    <div class="form-group mb-3">
                        <label>Select Type</label>
                        <select name="type_id" class="form-control" required>
                            @foreach($types as $type)
                            <option value="{{ $type->id }}"
                                {{ $item->type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- SUB--TYPE --}}
                    <div class="form-group mb-3">
                        <label>Select Sub Type</label>

                        <select name="sub_type_id" class="form-control" required>

                            @foreach($subtypes as $type)

                            <option value="{{ $type->id }}"
                                {{ $item->sub_type_id == $type->id ? 'selected' : '' }}>

                                {{ $type->name }}

                            </option>

                            @endforeach

                        </select>
                    </div>

                    {{-- LOCATION TYPE --}}
                    <div class="form-group mb-3">
                        <label>Select Location Type</label>
                        <select name="location_type_id" class="form-control">
                            <option value="">-- Select Location Type --</option>
                            @foreach($locationTypes as $locationType)
                            <option value="{{ $locationType->id }}"
                                {{ $item->location_type_id == $locationType->id ? 'selected' : '' }}>
                                {{ $locationType->name }}
                            </option>
                            @endforeach
                        </select>
                        {{-- CITY --}}
                        <div class="form-group mb-3">
                            <label>City</label>
                            <input type="text"
                                name="city"
                                class="form-control"
                                value="{{ $item->city }}"
                                required>
                        </div>

                        {{-- LOCALITY --}}
                        <div class="form-group mb-3">
                            <label>Locality</label>
                            <input type="text"
                                name="locality"
                                class="form-control"
                                value="{{ $item->locality }}"
                                required>
                        </div>

                        {{-- SUB LOCALITY --}}
                        <div class="form-group mb-3">
                            <label>Sub Locality</label>
                            <input type="text"
                                name="sub_locality"
                                class="form-control"
                                value="{{ $item->sub_locality }}">
                        </div>

                        {{-- ADDRESS --}}
                        <div class="form-group mb-3">
                            <label>Address</label>
                            <textarea
                                name="address"
                                class="form-control"
                                rows="3"
                                required>{{ $item->address }}</textarea>
                        </div>
                    </div>
                    @elseif($mode == 'property-profile-option')

                    {{-- AREA UNIT --}}
                    <div class="form-group mb-3">
                        <label>Area Unit</label>
                        <input type="text"
                            name="area_unit"
                            class="form-control"
                            value="{{ $item->area_unit }}"
                            placeholder="e.g. Sq.ft, Sq.yd"
                            required>
                    </div>

                    {{-- FLOOR NO --}}
                    <div class="form-group mb-3">
                        <label>Floor No</label>
                        <input type="text"
                            name="floor_no"
                            class="form-control"
                            value="{{ $item->floor_no }}"
                            placeholder="e.g. Ground, 1st, 2nd"
                            required>
                    </div>

                    {{-- AVAILABILITY STATUS --}}
                    <div class="form-group mb-3">
                        <label>Availability Status</label>
                        <input type="text"
                            name="availability_status"
                            class="form-control"
                            value="{{ $item->availability_status }}"
                            placeholder="e.g. Ready to move, Under construction">
                    </div>

                    {{-- OWNERSHIP --}}
                    <div class="form-group mb-3">
                        <label>Ownership</label>
                        <input type="text"
                            name="ownership"
                            class="form-control"
                            value="{{ $item->ownership }}"
                            placeholder="e.g. Freehold, Leasehold"
                            required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Furnishing</label>
                        <input type="text"
                            name="furnishing"
                            class="form-control"
                            value="{{ $item->furnishing }}"
                            placeholder="e.g. Ground, 1st, 2nd">
                    </div>

                    <div class="form-group mb-3">
                        <label>Rentout</label>
                        <input type="text"
                            name="rent_out"
                            class="form-control"
                            value="{{ $item->rent_out }}"
                            placeholder="e.g. Ground, 1st, 2nd">
                    </div>
                    <div class="form-group mb-3">
                        <label>Furnishing Items</label>
                        <input type="text"
                            name="furnishing_items"
                            class="form-control"
                            value="{{ $item->furnishing_items }}"
                            placeholder="e.g. Ac,Tv"
                            required>

                    </div>

                    @elseif($mode == 'user')

                    {{-- USER FIELDS --}}

                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text"
                            name="name"
                            value="{{ $item->name ?? '' }}"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email"
                            name="email"
                            value="{{ $item->email ?? '' }}"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Password (leave blank if not changing)</label>
                        <input type="password"
                            name="password"
                            class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Select Role</label>
                        <select name="role" class="form-control">
                            @foreach($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ $item->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    @else

                    {{-- NORMAL CRUD MODE --}}
                    <div class="form-group mb-3">

                        <label>
                            {{ $hasOrderStatus ? $title.' Title' : $title.' Name' }}
                        </label>

                        <input
                            type="text"
                            name="{{ $hasOrderStatus ? 'title' : 'name' }}"
                            value="{{ $hasOrderStatus ? $item->title : $item->name }}"
                            class="form-control"
                            required>

                    </div>
                    @if($hasOrderStatus)

                    <div class="form-group mb-3">
                        <label>Order</label>
                        <input type="number"
                            name="order"
                            value="{{ $item->order }}"
                            class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label>Status</label>

                        <select name="active" class="form-control">

                            <option value="1" {{ $item->active ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ !$item->active ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    @endif
                    @if($types)

                    <div class="form-group mb-3">
                        <label>Select Type</label>

                        <select name="property_type_id" class="form-control">

                            @foreach($types as $type)

                            <option value="{{ $type->id }}"
                                {{ $item->type_id == $type->id ? 'selected' : '' }}>

                                {{ $type->name }}

                            </option>

                            @endforeach

                        </select>

                    </div>

                    @endif
                    @if(isset($item->slug))
                    <div class="form-group mb-3">
                        <label>Slug</label>
                        <input type="text"
                            name="slug"
                            value="{{ $item->slug }}"
                            class="form-control"
                            required>
                    </div>
                    @endif

                    {{-- PURPOSE --}}
                    @if($purposes)
                    <div class="form-group mb-3">
                        <label>Select Purpose</label>
                        <select name="purpose_id" class="form-control">
                            <option value="">-- Select Purpose --</option>
                            @foreach($purposes as $purpose)
                            <option value="{{ $purpose->id }}"
                                {{ $item->purpose_id == $purpose->id ? 'selected' : '' }}>
                                {{ $purpose->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    {{-- CATEGORY --}}
                    @if($categories)
                    <div class="form-group mb-3">
                        <label>Select Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    @endif

                </div>

                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-success">
                        Update
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endforeach
{{-- ===================== --}}
{{-- CREATE MODAL --}}
{{-- ===================== --}}

<div class="modal fade" id="createModal" tabindex="-1">

    <div class="modal-dialog">
        <form method="POST" action="{{ route($routePrefix.'.store') }}">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add {{ $title }}</h5>
                    @if ($mode !== 'property-profile')

                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                    @endif
                </div>
                <div class="modal-body">

                    @if($mode == 'property')

                    {{-- PROPERTY MODE FIELDS --}}

                    <div class="form-group mb-3">
                        <label>Select Purpose</label>
                        <select name="purpose_id" class="form-control" required>
                            <option value="">-- Select Purpose --</option>
                            @foreach($purposes as $purpose)
                            <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Select Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label>Select Type</label>
                        <select name="type_id" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="locationSection" style="display:none;">
                        <div class="form-group mb-3">
                            <label>Select Location Type</label>
                            <select name="location_type_id" class="form-control">
                                <option value="">-- Select Location Type --</option>
                                @foreach($locationTypes as $locationType)
                                <option value="{{ $locationType->id }}"
                                    data-type="{{ $locationType->property_type_id }}">
                                    {{ $locationType->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @elseif($mode == 'user')

                    <div class="form-group mb-3">
                        <label>Name</label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Email</label>
                        <input type="email"
                            name="email"
                            class="form-control"
                            required>
                    </div>
                    <!-- ✅ ADD THIS -->
                    <div class="form-group mb-3">
                        <label>Password</label>
                        <input type="password"
                            name="password"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Select Role</label>
                        <select name="role" class="form-control">
                            @foreach($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ isset($item) && $item->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="form-group mb-3">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control" required></textarea>
    </div> -->
                    @elseif($mode == 'property-profile-option')

                    <div class="form-group mb-2">
                        <label>Area Unit</label>
                        <input type="text" name="area_unit" class="form-control" required>
                    </div>

                    <div class="form-group mb-2">
                        <label>Floor No</label>
                        <input type="text" name="floor_no" class="form-control" required>
                    </div>

                    <div class="form-group mb-2">
                        <label>Availability Status</label>
                        <input type="text" name="availability_status" class="form-control">
                    </div>

                    <div class="form-group mb-2">
                        <label>Ownership</label>
                        <input type="text" name="ownership" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Furnishing</label>
                        <input type="text" name="furnishing" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Rentout</label>
                        <input type="text" name="rent_out" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>Furnishing Items</label>
                        <input type="text" name="furnishing_items" class="form-control">
                    </div>
                    @else

                    {{-- NORMAL CRUD MODE FIELDS --}}

                    <div class="form-group mb-3">

                        <label>
                            {{ $hasOrderStatus ? $title.' Title' : $title.' Name' }}
                        </label>

                        <input
                            type="text"
                            name="{{ $hasOrderStatus ? 'title' : 'name' }}"
                            class="form-control"
                            required>

                    </div>
                    @if($hasOrderStatus)
                    <div class="form-group mb-3">
                        <label>Order</label>
                        <input type="number" name="order" class="form-control" value="1">
                    </div>
                    @endif

                    {{-- ACTIVE FIELD --}}
                    @if($hasOrderStatus)
                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="active" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    @endif
                    @if($types)
                    <div class="form-group mb-3">
                        <label>Select Type</label>

                        <select name="property_type_id" class="form-control">

                            <option value="">-- Select Type --</option>

                            @foreach($types as $type)
                            <option value="{{ $type->id }}">
                                {{ $type->name }}
                            </option>
                            @endforeach

                        </select>

                    </div>
                    @endif
                    @if($hasSlug)
                    <div class="form-group mb-3">
                        <label>Slug</label>
                        <input type="text" name="slug" class="form-control" required>
                    </div>
                    @endif

                    @if($purposes)
                    <div class="form-group mb-3">
                        <label>Select Purpose</label>
                        <select name="purpose_id" class="form-control" required>
                            <option value="">-- Select Purpose --</option>
                            @foreach($purposes as $purpose)
                            <option value="{{ $purpose->id }}">{{ $purpose->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if($categories)
                    <div class="form-group mb-3">
                        <label>Select Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif


                    @endif

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>
@section('js')
<script>
    $(document).ready(function() {

        // =====================
        // DATATABLE
        // =====================
        if ($('#crudTable').length) {

            if ($.fn.DataTable.isDataTable('#crudTable')) {
                $('#crudTable').DataTable().destroy();
            }

            $('#crudTable').DataTable();
        }

        // =====================
        // LOCATION VISIBILITY
        // =====================
        function checkLocationVisibility() {

            let selectedTypeId = $('select[name="type_id"]').val();
            let selectedCategoryId = $('select[name="category_id"]').val();

            let commercialCategoryId = "2";
            let retailTypeId = "2";

            if (selectedCategoryId == commercialCategoryId && selectedTypeId == retailTypeId) {
                $('#locationSection').show();
            } else {
                $('#locationSection').hide();
                $('select[name="location_type_id"]').val('');
            }

            $('select[name="location_type_id"] option').each(function() {
                let optionType = $(this).data('type');

                if (!optionType || optionType == selectedTypeId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        $('select[name="category_id"]').change(checkLocationVisibility);
        $('select[name="type_id"]').change(checkLocationVisibility);

        // =====================
        // USER STATUS UPDATE (AJAX)
        // =====================
        $(document).on('change', '.statusDropdown', function(e) {
            e.preventDefault();
            let userId = $(this).data('id');
            let status = $(this).val();

            $.ajax({
                url: "/admin/users/" + userId + "/status",
                method: "POST", // use POST
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "PATCH", // Laravel converts POST → PATCH
                    status: status
                },
                success: function(response) {

                    $('#ajax-success').html(
                        `<div class="alert alert-success">
                    ${response.message}
                </div>`
                    );

                    setTimeout(function() {
                        $('#ajax-success').html('');
                    }, 3000);
                },
                error: function(xhr) {

                    console.log(xhr.responseText);

                    $('#ajax-success').html(
                        `<div class="alert alert-danger">
                    Something went wrong
                </div>`
                    );
                }
            });

        });

    });
</script>
@endsection