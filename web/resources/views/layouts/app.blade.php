<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('shared.headerfront')
        <main class="py-4">
            @yield('content')
        </main>
    </div>

@section('javascript')
     <!-- jQuery 3 -->
     {{-- <script src="{{ asset('js/components/jquery/dist/jquery.min.js') }}"></script> --}}
     <script src="{{ asset('js/components/jquery.min.js') }}"></script>
     <!-- Bootstrap 3.3.7 -->
     {{-- <script src="{{ asset('js/components/bootstrap/dist/js/bootstrap.min.js') }}"></script> --}}
     <script src="{{ asset('js/components/bootstrap.min.js') }}"></script>
 
     <!-- Custom scripts -->
     <script src="{{ asset('js/scripts.js') }}"></script>
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
