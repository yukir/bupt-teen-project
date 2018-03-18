<!-- Dropdown Structure -->
@auth
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
<ul id="dropdown_sxyl" class="dropdown-content">
    <li>
        <a class="dropdown-item" href="/activity?type=sxyl">主题教育</a>
        <a class="dropdown-item" href="/activity?type=yxtx">雁翔团校</a>
        <a class="dropdown-item" href="/activity?type=mzy">梦之翼理论学习社团</a>
    </li>
</ul>
<ul id="dropdown_jctj" class="dropdown-content">
    <li>
        <a class="dropdown-item" href="/community_day">主题团日</a>
        <a class="dropdown-item" href="/activity?type=tgpx">团干培训</a>
        <!-- 团员信息待修改 -->
        @if (Auth::user()->zttr_admin)
        <a class="dropdown-item" href="/community/manage">团员信息管理</a>
        @endif
    </li>
</ul>
<ul id="dropdown_xywh" class="dropdown-content">
    <li>
        <a class="dropdown-item" href="/activity?type=xywh">校园文化活动</a>
    </li>
</ul>
@endauth
<nav>
    <div class="nav-wrapper container">
        
        <ul class="left hide-on-med-and-down active_check">
            <li><a href="{{ config('app.url', '/') }}" class="brand-logo">{{ $title or config('app.name', 'Laravel') }}</a></li>
            @auth
            <li><a class="dropdown-button" href="#!" data-activates="dropdown_sxyl">思想引领<i class="material-icons right" style="margin-left:2px;">arrow_drop_down</i></a></li>
            <li><a class="dropdown-button" href="#!" data-activates="dropdown_jctj">基层团建<i class="material-icons right" style="margin-left:2px;">arrow_drop_down</i></a></li>
            <li><a class="dropdown-button" href="#!" data-activates="dropdown_xywh">校园文化<i class="material-icons right" style="margin-left:2px;">arrow_drop_down</i></a></li>
            @endauth
        </ul>
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