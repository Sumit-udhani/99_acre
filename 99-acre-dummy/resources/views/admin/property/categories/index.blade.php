@extends('adminlte::page')

@section('content')

<x-master-crud 
    title="Category"
    :data="$categories"
    routePrefix="admin.categories" />

@endsection