@extends('layouts.app')

<link href="{{ asset('css/application-list.css') }}" rel="stylesheet">

@section('content')
<div class="container">
    <h3>{{ $title }}</h3>
    <div class="row valign-wrapper hide-on-small-only">
        <div class="col m2 s2">申请人</div>
        <div class="col m7"></div>
        <div class="col m1 s2">批准</div>
        <div class="col m1 s2">已签到</div>
        <div class="col m1 s2">已签退</div>
    </div>
    <div class="hoverable row valign-wrapper application-list">
        <div class="col m1 s2">
            <img src="{{ asset('img/UserProfileTest.jpg') }}" alt="" class="responsive-img circle">
        </div>
        <div class="col m1 s2">Linkin</div>
        <div class="col m7 s2"></div>
        <div class="col m1 s2">批准申请</div>
        <div class="col m1 s2">标记为已签到</div>
        <div class="col m1 s2">标记为已签退</div>
    </div>
</div>
@endsection