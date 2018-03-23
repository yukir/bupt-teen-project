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
</head>
<body>
    <style>
        #app {
            width: 100vw;
            height: 100vh;
            background-color: #f5f5f5;
            display: flex;
            flex-direction: coloum;
            align-items: center;
            justify-content: space-between;
        }
        #qr-frame {
            width: 65vh;
            height: 65vh;
            padding: 20px;
            box-sizing: content-box;
            flex-grow: 0;
            flex-shrink: 0;
            background-color: white;
        }
        #app h3,h4 {
            flex-shrink: 1;
            flex-grow: 0;
        }
        #app h3 {
            height: 8vh;
            font-size: 8vh;
        }
        #app h4 {
            height: 15vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        #app h4 img {
            height: 45%;
        }
        #app h4 span {
            height: 45%;
            padding: 1.14rem 0 .912rem 0;
            box-sizing: border-box;
            font-size: 5vh;
        }
        #full-screen-button {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 5vh;
        }
        #qr-frame canvas {
            width: 100%;
            height: 100%;
        }
        @media screen and (max-width: 600px) {
            #qr-frame {
                width: 300px;
                height: 300px;
                padding: 10px;
            }
            #full-screen-button {
                display: none;
            }
        }
    </style>
    <div id="app">
        <a id="full-screen-button" href="#!" @click="toggleFullScreen">全屏显示</a>
        <h3>{{ $activity->title }}</h3>
        <a href="{{ $qrSrc }}">快速访问</a>
        <qr-code ref="qrcode" class="z-depth-4" id="qr-frame" src="{{ $qrSrc }}" :size="getQRFrameSize()"></qr-code>
        <h4><img src="{{ asset('img/apps.png') }}" /><span>使用任意应用扫码</span></h4>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('js/materialize.min.js') }}"></script> 
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/qr-display.js') }}"></script>
</body>
</html>
