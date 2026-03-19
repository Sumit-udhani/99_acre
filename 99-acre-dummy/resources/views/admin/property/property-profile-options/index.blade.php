@extends('adminlte::page')

@section('content')

<x-master-crud 
    title="Property Profile Option"
    :data="$options"
    routePrefix="admin.property-profiles-option" 
    mode="property-profile-option"
    />

@endsection