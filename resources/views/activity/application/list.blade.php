@extends('layouts.app')

<link href="{{ asset('css/application-list.css') }}" rel="stylesheet">

@section('content')
<div class="container" id="application-list">
    <h3>{{ $title }}</h3>
    <div class="hide-on-small-only application-list title">
        <div class="">申请人</div>
        <div class="space-between"></div>
        <div class="action-button">批准</div>
        <div class="action-button">已签到</div>
        <div class="action-button">已签退</div>
    </div>
    @foreach ($applications as $application)
    <application-card 
        user-logo="{{ asset('img/UserProfileTest.jpg') }}"
        user-name="LinkinYoung"
        :is-approved="{{ $application->status }}"
        :is-signed-in="{{ $application->sign_in }}"
        :is-signed-out="{{ $application->sign_out }}"
        application-id="2"
        activity-id="2"
        approve-url="www.baidu.com"
        sign-in-url="www.baidu.com"
        sign-out-url="www.baidu.com"
    ></application-card>
    @endforeach
</div>
@endsection

@section('js')
<script src="{{ asset('js/application.js') }}"></script>
@endsection