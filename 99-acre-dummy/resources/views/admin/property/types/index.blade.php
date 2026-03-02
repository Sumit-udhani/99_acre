@extends('adminlte::page')

@section('plugins.Datatables', true)
@section('content')
<x-master-crud 
    title="types"
    :data="$types"
    routePrefix="admin.types" 
    :categories="$categories"
    :purposes="$purposes"
    />
    @endsection

