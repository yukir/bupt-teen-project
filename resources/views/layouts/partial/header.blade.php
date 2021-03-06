<!-- Dropdown Structure -->


@auth
<ul id="dropdown_auth" class="dropdown-content">
    <li><a class="dropdown-item" href="/user/{{ Auth::user()->id }}">个人主页</a></li>
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
    <li><a class="dropdown-item" href="/activity?type=sxyl">主题教育</a></li>
    <li><a class="dropdown-item" href="/activity?type=yxtx">雁翔团校</a></li>
    <li><a class="dropdown-item" href="/activity?type=mzy">梦之翼理论学习社团</a></li>
</ul>
<ul id="dropdown_jctj" class="dropdown-content">
    <li><a class="dropdown-item" href="/community_day">主题团日</a></li>
    <li><a class="dropdown-item" href="/activity?type=tgpx">团干培训</a></li>
    <!-- 团员信息待修改 -->
    @if (Auth::user()->zttr_admin || Auth::user()->isSuperAdmin())
    <li><a class="dropdown-item" href="/community/manage">团员信息管理</a></li>
    <li><a class="dropdown-item" href="/community_day/create">发布主题团日</a></li>
    @endif
    
</ul>
<ul id="dropdown_xywh" class="dropdown-content">
    <li><a class="dropdown-item" href="/activity?type=xywh">校园文化活动</a></li>
</ul>
@endauth


<nav class="nav-extended">
    <div class="nav-wrapper">
        <div class="container">
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

            <ul class="left hide-on-med-and-down active_check">
                <li><a href="{{ config('app.url', '/') }}" class="brand-logo">{{ $title or config('app.name', 'Laravel') }}</a></li>
                @auth
                <li class="sxyl_li"><a class="dropdown-button" href="#!" data-activates="dropdown_sxyl">思想引领<i class="material-icons right" style="margin-left:2px;">arrow_drop_down</i></a></li>
                <li class="jctj_li"><a class="dropdown-button" href="#!" data-activates="dropdown_jctj">基层团建<i class="material-icons right" style="margin-left:2px;">arrow_drop_down</i></a></li>
                <li class="xywh_li"><a class="dropdown-button" href="#!" data-activates="dropdown_xywh">校园文化<i class="material-icons right" style="margin-left:2px;">arrow_drop_down</i></a></li>
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
        <ul class="side-nav" id="mobile-demo">
            @auth
            <li><a href="/user/{{ Auth::user()->id }}">个人主页</a></li>
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('登出') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            <li><a href="/activity?type=sxyl">主题教育</a></li>
            <li><a href="/activity?type=yxtx">雁翔团校</a></li>
            <li><a href="/activity?type=mzy">梦之翼理论学习社团</a></li>
            <li><a href="/community_day">主题团日</a></li>
            <li><a href="/activity?type=tgpx">团干培训</a></li>
            @if (Auth::user()->zttr_admin || Auth::user()->isSuperAdmin())
            <li><a href="/community_day/create">发布主题团日</a></li>
            <li><a href="/community_day/manage">团员信息管理</a></li>
            @endif
            <!-- <li><a href="/activity?type=xywh">校园文化活动</a></li> -->
            @else
            <li><a href="{{ route('login') }}">{{ __('登录') }}</a></li>
            <li><a href="{{ route('register') }}">{{ __('注册') }}</a></li>
            @endauth
        </ul>
    </div>
    @if (isset($extended_nav))
        
        <div class="nav-content">
            <div class="container">
            @switch($extended_nav)
                @case(1)
                <ul class="tabs tabs-transparent active_check_sub">
                    <li class="tab {{ Route::currentRouteName()=='activity.index' ? 'active' : '' }}" ><a href="/activity?type={{ $type }}">活动列表</a></li>
                    @can('createWithType',[\App\Activity::Class,$type])
                    <li class="tab {{ Route::currentRouteName()=='activity.create' ? 'active' : '' }}"><a href="/activity/create?type={{ $type }}">发布活动</a></li>
                    @endcan
                </ul>
                @break
                @case(2)
                <ul class="tabs tabs-transparent active_check_sub">
                    <li class="tab {{ Route::currentRouteName()=='community_day.index' ? 'active' : '' }}" ><a href="/community_day">主题团日列表</a></li>
                    @can('create',\App\CommunityDay::Class)
                    <li class="tab {{ Route::currentRouteName()=='community_day.create' ? 'active' : '' }}"><a href="/community_day/create">创建主题团日</a></li>
                    @endcan
                </ul>
                @break
                @default
            @endswitch
            </div>
        </div>
        
    @endif
</nav>