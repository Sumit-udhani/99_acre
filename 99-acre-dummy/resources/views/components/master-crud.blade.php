<div class="container">
    <h2>{{ $title }}</h2>

    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">
        Add {{ $title }}
    </button>

    <table id="crudTable" class="table table-bordered">
        <thead>
            <tr>
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
            </tr>
        </thead>

        <tbody>
            @forelse($items as $key => $item)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->slug }}</td>

                    @if($categories)
                        <td>{{ $item->category->name ?? '' }}</td>
                    @endif

                    @if($purposes)
                        <td>{{ $item->purpose->name ?? '' }}</td>
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

                    <div class="form-group mb-3">
                        <label>{{ $title }} Name</label>
                        <input type="text"
                            name="name"
                            value="{{ $item->name }}"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text"
                            name="slug"
                            value="{{ $item->slug }}"
                            class="form-control"
                            required>
                    </div>

                    @if($categories)
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
                    @endif

                    @if($purposes)
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
                    @endif

                </div>

                <div class="modal-footer">
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

                    <div class="form-group mb-3">
                        <label>{{ $title }} Name</label>
                        <input type="text"
                            name="name"
                            class="form-control"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text"
                            name="slug"
                            class="form-control"
                            required>
                    </div>

                    @if($purposes)
                    <div class="form-group mb-3">
                        <label>Select Purpose</label>
                        <select name="purpose_id" class="form-control" required>
                            <option value="">-- Select Purpose --</option>
                            @foreach($purposes as $purpose)
                                <option value="{{ $purpose->id }}">
                                    {{ $purpose->name }}
                                </option>
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
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
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

{{-- ===================== --}}
{{-- DATATABLE SCRIPT --}}
{{-- ===================== --}}
@section('js')
<script>
$(document).ready(function () {
    console.log("DataTable script loaded");

    if (typeof $.fn.DataTable === 'function') {
        $('#crudTable').DataTable({
            pageLength: 10
        });
    } else {
        console.error("DataTable JS not loaded");
    }
});
</script>
@endsection