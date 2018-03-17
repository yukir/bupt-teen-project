@extends('layouts.app')

<link href="{{ asset('css/application-list.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <h3>{{ $title }}</h3>
    <div class="hide-on-small-only application-list title">
        <div class="">申请人</div>
        <div class="space-between"></div>
        <div class="action-button">批准</div>
        <div class="action-button">已签到</div>
        <div class="action-button">已签退</div>
    </div>
    <div class="hoverable application-list rejected">
        <div class="user-logo">
            <img src="{{ asset('img/UserProfileTest.jpg') }}" alt="" class="responsive-img circle">
        </div>
        <div class="">Linkin</div>
        <div class="space-between"></div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" id="filled-in-box1" />
            <label for="filled-in-box1"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" id="filled-in-box2" />
            <label for="filled-in-box2"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" id="filled-in-box3" />
            <label for="filled-in-box3"></label>
        </div>
        <div class="action-button hide-on-med-and-up">批准申请</div>
        <div class="action-button hide-on-med-and-up">标记为已签到</div>
        <div class="action-button hide-on-med-and-up">标记为已签退</div>
    </div>
    <div class="hoverable application-list">
        <div class="user-logo">
            <img src="{{ asset('img/UserProfileTest.jpg') }}" alt="" class="responsive-img circle">
        </div>
        <div class="">Linkin</div>
        <div class="space-between"></div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" id="filled-in-box4" />
            <label for="filled-in-box4"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" id="filled-in-box5" />
            <label for="filled-in-box5"></label>
        </div>
        <div class="action-button hide-on-small-only">
            <input type="checkbox" class="filled-in" id="filled-in-box6" />
            <label for="filled-in-box6"></label>
        </div>
        <div class="action-button hide-on-med-and-up">批准申请</div>
        <div class="action-button hide-on-med-and-up">标记为已签到</div>
        <div class="action-button hide-on-med-and-up">标记为已签退</div>
    </div>
</div>
@endsection