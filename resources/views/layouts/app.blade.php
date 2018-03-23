<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($main_title) ? $main_title." - " : "" }}{{ $title or config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialize_font.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @yield('css')
</head>
<body>
    <div id="app">
        @include('layouts.partial.header')

        <main>
            @yield('content')
        </main>

        @include('layouts.partial.footer')
    </div>
    
    @include('layouts.partial.footer')
    
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script> 
    <script src="{{ asset('js/main.js') }}"></script> 
    @if (isset($extended_nav) && $extended_nav)
    <script>
        $(function(){
            $(".tab a ").click(function() { window.location.href = $(this).attr("href")});
        });    
    </script>
    @endif
    @yield('js')
    
    
</body>
</html>
