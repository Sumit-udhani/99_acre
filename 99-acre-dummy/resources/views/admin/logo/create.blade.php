@extends('adminlte::page')

@section('title', 'Manage Logo')

@section('content_header')
    <h1>Manage Logo</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.logo.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Logo Title</label>
        <input type="text" name="title" class="form-control" 
               value="{{ $logo->title ?? '' }}">
    </div>

    <div class="mb-3">
        <label>Upload Logo</label>
        <input type="file" name="image" class="form-control">
    </div>

    @if(isset($logo))
        <div class="mb-3">
            <img src="{{ asset('storage/'.$logo->image_path) }}" width="150">
        </div>
    @endif

    <button type="submit" class="btn btn-primary">
        Save Logo
    </button>
</form>

@stop