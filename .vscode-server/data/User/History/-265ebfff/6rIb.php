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
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/chosen.css">
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
            border-color: #0d1a80;
            background-color: #0d1a80;
            color: white;
        }
        .close{
            opacity:1 !important;
            color:white !important;
        }
        @media (min-width: 768px) {
            .modal-xl {
                width: 90%;
            max-width:900px;
            }
         }
         .switch {
            position: relative;
            display: inline-block;
            width: 110px;
            height: 34px;
            user-select: none;
        }
        .switch input {
            display: none;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ca2222;
            -webkit-transition: .4s;
            transition: .4s;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        input:checked + .slider {
            background-color: #2ab934;
        }
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        input:checked + .slider:before {
            -webkit-transform: translateX(75px);
            -ms-transform: translateX(75px);
            transform: translateX(75px);
        }
        .on {
            display: none;
            color: white;
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 40%;
            font-size: 13px;
            font-weight: bold;
        }
        .off {
            color: white;
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 60%;
            font-size: 13px;
            font-weight: bold;
        }
        input:checked+ .slider .on {
            display: block;
        }
        input:checked + .slider .off {
            display: none;
        }
        .slider.round {
            border-radius: 34px;
        }
        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    </head>
    @if (!Auth::guest())
        @include('inc.navbar')
    @endif
    @if (Auth::guest())
        @include('inc.guest')
    @endif
        <body>
            <div id="app" class="container-fluid">
                <main class="pt-2 pb-5">
                    @yield('content')
                </main>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <script src="/chosen.jquery.js"></script>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                window.onload = displayClock();
                function displayClock(){
                    var display = new Date().toLocaleTimeString();
                    datetime.textContent = display;
                    setTimeout(displayClock, 1000);
                }
                $(".chosen-select").chosen({width: "100%"})
            </script>
        </body>
        @if(Request::is('user'))
            <script src="{{ asset('js/user.js') }}"></script>
        @endif
        @if(Request::is('holiday'))
            <script src="{{ asset('js/holiday.js') }}"></script>
        @endif
        @if(Request::is('leave'))
        <script src="{{ asset('js/leave.js') }}"></script>
        @endif
        @if(Request::is('shift'))
        <script src="{{ asset('js/shift.js') }}"></script>
        @endif
        @if(Request::is('branch'))
        <script src="{{ asset('js/branch.js') }}"></script>
        @endif
        @if(Request::is('employee'))
        <script src="{{ asset('js/employee.js') }}"></script>
        @endif
</html>
