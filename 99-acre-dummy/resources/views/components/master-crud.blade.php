@if(session('success'))
    <div class="alert alert-success" 
         style="background-color: lightgreen; color: white; width:auto;">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <h2>{{ $title }}</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
        Add {{ $title }}
    </button>

    <table id="crudTable" class="table table-bordered">
        <thead>
            <tr>
              
@if($mode == 'property')

    <th>Purpose</th>
    <th>Category</th>
    <th>Type</th>
    <th>Location Type</th> {{-- NEW --}}
   
    <th>Action</th>
@elseif($mode == 'user')

    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Status</th>
    <th>Action</th>

  @elseif($mode == 'normal')

<th>#</th>
<th>Name</th>
<th>Slug</th>

@if($categories)
    <th>Category</th>
@endif

@if($purposes)
    <th>Purpose</th>
@endif

<th>Action</th>
@else

<th>#</th>
<th>Name</th>

@if(isset($items[0]) && isset($items[0]->slug))
    <th>Slug</th>
@endif

@if($categories)
    <th>Category</th>
@endif

@if($purposes)
    <th>Purpose</th>
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
     <td>{{ $item->locationType->name ?? '' }}</td> 
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
<form action="{{ route('admin.users.updateStatus', $item->id) }}" method="POST">
    @csrf
    @method('PATCH')

    <select name="status" onchange="this.form.submit()">
        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ $item->status == 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="rejected" {{ $item->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>
</form>
</td>
@else

    <td>{{ $key+1 }}</td>
    <td>{{ $item->name }}</td>
  @if(isset($item->slug))
   <td>{{ $item->slug ?? '' }}</td>
@endif
    @if($categories)
        <td>{{ $item->category->name ?? '' }}</td>
    @endif

    @if($purposes)
        <td>{{ $item->purpose->name ?? '' }}</td>
    @endif

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
        <label>{{ $title }} Name</label>
        <input type="text"
               name="name"
               value="{{ $item->name }}"
               class="form-control"
               required>
    </div>

    <div class="form-group mb-3">
        @if ($item->slug)
            
        <label>Slug</label>
        <input type="text"
               name="slug"
               value="{{ $item->slug }}"
               class="form-control"
               required>
        @endif
    </div>

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
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
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

@else

    {{-- NORMAL CRUD MODE FIELDS --}}

    <div class="form-group mb-3">
        <label>{{ $title }} Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group mb-3">
         @if ($item->slug)
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" required>
        @endif
    </div>

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
$(document).ready(function () {

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

        $('select[name="location_type_id"] option').each(function () {
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
    $('.statusDropdown').change(function () {

        let userId = $(this).data('id');
        let status = $(this).val();

        $.ajax({
            url: "{{ route('admin.users.updateStatus', ':id') }}".replace(':id', userId),
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "PATCH",
                status: status
            },
            success: function () {
                alert('User status updated successfully');
            },
            error: function () {
                alert('Something went wrong');
            }
        });

    });

});
</script>
@endsection