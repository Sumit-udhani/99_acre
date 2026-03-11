<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


  
    @vite(['resources/css/app.css', 'resources/js/app.js'])
   
    <!-- DataTables CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
       

       
        @isset($header)
      <x-header />
        @endisset

       
        <main>
            {{ $slot }}

            <script src="{{ asset('js/property-form.js') }}"></script>
        </main>
    </div>
    
</body>

</html>