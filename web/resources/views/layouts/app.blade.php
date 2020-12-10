<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Konstantin home') }}</title>

    <link rel="shortcut icon" href="favicon.ico">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/index.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <x-header/>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <x-footer/>

@section('javascript')
     <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
     <script src="{{ asset('js/tether.min.js') }}"></script>
     <script src="{{ asset('js/bootstrap.min.js') }}"></script>
     <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
     <script src="{{ asset('js/jquery.fancybox.min.js') }}"></script>
     <script src="{{ asset('js/script.js') }}"></script>
     <script src="{{ asset('js/app.js') }}"></script>
     <script>
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
     </script>
 @show
</body>
</html>
