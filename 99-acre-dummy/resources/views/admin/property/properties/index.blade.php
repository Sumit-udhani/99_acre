@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('content')

<x-master-crud 
    title="Properties"
    :data="$properties"
    routePrefix="admin.properties"
    :categories="$categories"
    :purposes="$purposes"
    :types="$types"
    :subtypes="$subtypes"
    :locationTypes="$locationTypes" 
    mode="property"
/>

@endsection 