@extends('adminlte::page')

@section('content')

<div class="container">
    <h2>Edit Banner</h2>

    <a href="{{ route('banner.index') }}" class="btn btn-secondary mb-3">
        Back
    </a>

    <form action="{{ route('banner.update', $banner->id) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" 
                   class="form-control" 
                   value="{{ $banner->title }}" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" 
                   class="form-control" 
                   value="{{ $banner->subtitle }}">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" 
                      class="form-control" 
                       id="description"
                      rows="4">{{ $banner->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Button Text</label>
            <input type="text" name="button_text" 
                   class="form-control" 
                   value="{{ $banner->button_text }}">
        </div>

        <div class="mb-3">
            <label>Button URL</label>
            <input type="text" name="button_url" 
                   class="form-control" 
                   value="{{ $banner->button_url }}">
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            @if($banner->image_path)
                <img src="{{ asset('storage/'.$banner->image_path) }}" width="150">
            @endif
        </div>

        <div class="mb-3">
            <label>Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            Update Banner
        </button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

<script>
ClassicEditor
    .create(document.querySelector('#description'))
    .catch(error => {
        console.error(error);
    });
</script>
@endsection