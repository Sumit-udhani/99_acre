@extends('adminlte::page')

@section('content')

<x-master-crud 
    title="Purpose"
    :data="$purposes"
    routePrefix="admin.purposes" />

@endsection