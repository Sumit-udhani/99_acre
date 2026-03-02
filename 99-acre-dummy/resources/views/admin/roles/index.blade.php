@extends('adminlte::page')

@section('title', 'Roles')

@section('plugins.Datatables', true)

@section('content')

<x-master-crud 
    title="Roles"
    :data="$roles"
    routePrefix="admin.roles"
/>

@endsection