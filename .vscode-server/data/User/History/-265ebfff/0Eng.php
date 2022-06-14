<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Styles -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <style>
        .idsi{
            background-color:#0d1a80;
            color:white;
            font-size: 20px;
        }
        .xlink{
            /* background-color:#0d1a80; */
            /* font-weight: bold; */
            color:white !important;
            font-size: 20px;
            text-decoration: none !important;
        }
        .nav-item>a:hover {
            background-color: white;
            color:#0d6efd !important;
            border:0px;
            text-decoration: none !important;
        }
        .active {
            background-color: white !important;
            color: #0d1a80 !important;
            text-decoration: none !important;
            
        }
        .bp {
            font-weight: bold;
            background-color: #0d1a80;
            color: white;
        }
    </style>
    </head>
    @if (!Auth::guest())
        @include('inc.navbar')
    @endif
        <body>
            <div id="app" class="container-fluid">
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        </body>
        @if(Request::is('user'))
            <script src="{{ asset('js/user.js') }}"></script>
        @endif
</html>
