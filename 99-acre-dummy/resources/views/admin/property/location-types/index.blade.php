@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('content')

<x-master-crud 
    title="Location Types"
    :data="$locationTypes"
    routePrefix="admin.location-types"
    
    mode="location"
/>

@endsection
