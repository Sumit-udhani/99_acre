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
@section('js')
<script>
$(document).ready(function () {
    console.log("Datatable init running...");

    $('#crudTable').DataTable({
        pageLength: 10
    });
});
</script>
@endsection
