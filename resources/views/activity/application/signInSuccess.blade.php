<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title or config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialize_font.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <style>
        #app {
            height: 100vh;
            display: flex;
            flex-direction: coloum;
            justify-content: space-around;
            align-items: center;
        }
        #check-icon {
            font-size: 6em;
        }
    </style>
    <div id="app">
        <h2>{{ $activity->title }}</h2>
        <div class="center-align">
            <i id="check-icon" class="material-icons green-text">check_circle</i>
            <p>{{ $operation }}成功</p>
        </div>
        <div>{{ $username }}</div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script>
</body>
</html>
