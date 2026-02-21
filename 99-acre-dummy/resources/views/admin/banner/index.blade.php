@extends('adminlte::page')

@section('content')

<div class="container">
    <h2>Banner List</h2>

    <a href="{{ route('banner.create') }}" class="btn btn-primary mb-3">
        Add Banner
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Subtitle</th>
                <th>Button</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($banners as $key => $banner)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        @if($banner->image_path)
                            <img src="{{ asset('storage/'.$banner->image_path) }}" width="120">
                        @endif
                    </td>
                    <td>{{ $banner->title }}</td>
                    <td>{{ $banner->subtitle }}</td>
                    <td>{{ $banner->button_text }}</td>
                    <td>
                        <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('banner.destroy', $banner->id) }}" 
                              method="POST" 
                              style="display:inline-block">
                            @csrf
                            @method('DELETE')

                            <button type="submit" 
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No Banners Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection