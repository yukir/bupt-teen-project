@extends('layouts.app')

<link href="{{ asset('css/application-list.css') }}" rel="stylesheet">

@section('content')
<div class="container" id="application-list">
    <h3>{{ $title }}</h3>
    <div class="row">
        <div class="col s12 m4">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title">管理工具</span>
                    <p>您可以点击下面的链接显示二维码，让参与者扫码签到/签退。</p>
                    <p>您也可以使用任意应用扫描<a href="#!" class="amber-text text-accent-4 tooltipped" data-tooltip="让参与者查找他的申请，点击里面的签到/签退按钮">参与者手机上的二维码</a>为他签到/签退。</p>
                </div>
                <div class="card-action">
                    <a href="{{ route('activity.displaySignInQR', [$activity]) }}">扫码签到</a>
                    <a href="{{ route('activity.displaySignOutQR', [$activity]) }}">扫码签退</a>
                </div>
            </div>
        </div>
    </div>
    
    <div id="list-title" class="hide-on-small-only application-list title">
        <div class="">申请人</div>
        <div class="space-between"></div>
        <div class="action-button">批准</div>
        <div class="action-button">已签到</div>
        <div class="action-button">已签退</div>
    </div>
    <div id="list-title-hover" class="hide-on-small-only application-list title hide">
        <div class="">申请人</div>
        <div class="space-between"></div>
        <div class="action-button">批准</div>
        <div class="action-button">已签到</div>
        <div class="action-button">已签退</div>
    </div>
    @foreach ($applications as $application)
    <application-card 
        user-logo="{{ $application->user->avatar }}"
        user-name="{{ $application->user->username }}"
        :is-approved="Boolean({{ $application->status }})"
        :is-signed-in="Boolean({{ $application->sign_in }})"
        :is-signed-out="Boolean({{ $application->sign_out }})"
        application-id="{{ $application->id }}"
        activity-id="{{ $application->activity_id }}"
        update-url="{{ route('application.update', [$application]) }}"
        sign-in-url="{{ route('application.signIn', [$application]) }}"
        sign-out-url="{{ route('application.signOut', [$application]) }}"
    ></application-card>
    @endforeach
</div>
@endsection

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/application.js') }}"></script>
@endsection