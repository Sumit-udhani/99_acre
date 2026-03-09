@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('content')

<x-master-crud 
    title="Location Types"
    :data="$locationTypes"
    routePrefix="admin.location-types"
    :types="$types"
    
    mode="normal"
    :hasSlug="true"
/>

@endsection
