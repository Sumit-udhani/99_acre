@extends('adminlte::page')

@section('title', 'Users')

@section('plugins.Datatables', true)

@section('content')

<x-master-crud 
    title="Users"
    :data="$users"
    routePrefix="admin.users"
    mode="user"
     :roles="$roles"
/>

@endsection