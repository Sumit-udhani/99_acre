@extends('adminlte::page')

@section('content')

<div class="container">
    <h2>Create Banner</h2>

    <!-- <a href="{{ route('banner.index') }}" class="btn btn-secondary mb-3">
        Back
    </a> -->

    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
          <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label>Button Text</label>
            <input type="text" name="button_text" class="form-control">
        </div>

        <div class="mb-3">
            <label>Button URL</label>
            <input type="text" name="button_url" class="form-control">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">
            Save Banner
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