<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Microsoft Yahei','Microsoft YaHei','微软雅黑',微软雅黑,'Simhei','SimHei',黑体,'黑体',sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">主页</a>
                        <a href="{{ route('logout') }}">登出</a>
                    @else
                        <a href="{{ route('login') }}">登录</a>
                        <a href="{{ route('register') }}">注册</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    北邮青年 - 测试用主页
                </div>
                
                <div class="test">
                @auth
                @else
                @endauth
                </div>
                
                <div class="test">
                    <h2>测试数据:</h2>
                    <p>Auth::user()->isSuperAdmin()
                    @auth 
                        {{ Auth::user()->isSuperAdmin() }}
                    @endauth
                    </p>
                </div>
            </div>

        </div>
        <script src="/js/app.js"></script>
    </body>
</html>
