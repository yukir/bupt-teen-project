@extends('layouts.app')
@section('css')
<style>
    
</style>
@stop
@section('content')
<div class="container content">
    <br>
    <h2>北邮青年 - 测试用主页</h2>

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
        <p> {{ \App\User::count() }}</p>
    </div>
</div>
@stop


