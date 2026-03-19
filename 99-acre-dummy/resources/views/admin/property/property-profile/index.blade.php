@extends('adminlte::page')

@section('content')

<x-master-crud 
    title="Property Profile"
    :data="$profiles"
    routePrefix="admin.property-profiles" 
    mode="property-profile"
    />

@endsection