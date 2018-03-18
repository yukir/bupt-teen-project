@extends('layouts.app')

@section('css')
@stop

@section('content')
<div class="container">
    <h3>{{ $activity->title }}</h3>
    <p>活动分类： {{ \App\Activity::type_name($activity->type) }}</p>
    <hr>
    <div class="main">
        {!! $activity->content !!}
    </div>
    <hr>
    <p>活动开始时间:{{ $activity->start_at }}</p>
    <p>是否需要签到、签退:{{ $activity->check_required ? "是" : "否" }}</p>
</div>
@stop