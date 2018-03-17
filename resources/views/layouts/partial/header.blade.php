<!-- Dropdown Structure -->
<ul id="dropdown_auth" class="dropdown-content">
    <li>
        <a class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('登出') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
<nav>
    <div class="nav-wrapper container">
        <a href="{{ config('app.url', '/') }}" class="brand-logo">{{ config('app.name', 'Laravel') }}</a>
        <ul class="right hide-on-med-and-down">
            @guest
            <li><a href="{{ route('login') }}">{{ __('登录') }}</a></li>
            <li><a href="{{ route('register') }}">{{ __('注册') }}</a></li>
            @else
            <li><a class="dropdown-button" href="#!" data-activates="dropdown_auth">{{ Auth::user()->username }}<i class="material-icons right" style="margin-left:2px;">arrow_drop_down</i></a></li>
            @endguest
        </ul>
    </div>
</nav>