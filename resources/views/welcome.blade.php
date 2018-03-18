<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Styles -->
        <link href="{{ asset('css/materialize.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/materialize_font.css') }}" rel="stylesheet">
        <link href="{{ asset('css/main.css') }}" rel="stylesheet">
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
                        <a href="#">{{ Auth::user()->username }}</a>
                        <a href="{{ url('/home') }}">登录页</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">登出</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
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
                    <h3>当前登录用户:{{ Auth::user()->username }}</h3>
                    <p>{{ Auth::user()->powerShown() }}</p>
                @else
                    <h3>预置用户名#密码</h3>

                    <p>admin#admin 最高权限  </p>
                    <p>demo#demo 默认注册用户  </p>
                    <p>banned#banned 被封禁用户  </p>

                    <p>以下为各种管理员用户</p>

                    <p><p>sxyl_admin#123456  </p>
                    <p>xxst_admin#123456  </p> 
                    <p>zttr_xtw#123456  </p>
                    <p>zttr_tzs#123456  </p>
                    <p>zttr_tgpx#123456  </p>
                    <p>zttr_admin#123456   </p>
                    <p>xywh_admin#123456  </p>
                @endauth
                </div>
                
                <div class="test">
                    <h3>测试数据:</h3>
                    <p>Auth::user()->isSuperAdmin():
                    @auth 
                        {{ (Auth::user()->isSuperAdmin()) }}
                    @endauth
                    </p>
                </div>
            </div>

        </div>
        <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
        <script src="{{ asset('js/materialize.min.js') }}"></script> 
        <script src="{{ asset('js/main.js') }}"></script> 
    </body>
</html>
