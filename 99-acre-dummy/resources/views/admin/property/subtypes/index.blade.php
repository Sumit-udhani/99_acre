@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('content')

<x-master-crud
    title="Sub Types"
    :data="$subtypes"
    routePrefix="admin.subtypes"
    :types="$types"
    mode="normal"
    :hasSlug="true"
/>

@endsection