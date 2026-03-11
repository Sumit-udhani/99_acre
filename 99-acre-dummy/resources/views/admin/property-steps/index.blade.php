@extends('adminlte::page')

@section('title', 'Property Steps')

@section('plugins.Datatables', true)

@section('content')

<x-master-crud 
    title="Property Steps"
    :data="$steps"
    routePrefix="admin.property-steps"
    mode="normal"
  :hasOrderStatus="true"
/>

@endsection