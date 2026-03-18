@extends('adminlte::page')

@section('content')

<x-master-crud 
    title="Property Profile"
    :data="$profiles"
    routePrefix="admin.purposes" />

@endsection