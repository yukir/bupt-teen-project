@extends('layouts.app')

<link href="{{ asset('css/application-list.css') }}" rel="stylesheet">

@section('content')
<div class="container" id="application-list">
    <h3>{{ $title }}</h3>
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
        approve-url="{{ route('application.update', [$application]) }}"
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