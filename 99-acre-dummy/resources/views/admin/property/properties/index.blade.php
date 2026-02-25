@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('content')

<x-master-crud 
    title="Properties"
    :data="$properties"
    routePrefix="admin.properties"
    :purposes="$purposes"
    :categories="$categories"
    :types="$types"
    :locationTypes="$locationTypes" 
    mode="property"
/>

@endsection 