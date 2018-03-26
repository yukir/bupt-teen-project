@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ $community_day->name }}</h3>
    <p>开始时间: {{ $community_day->start_at or '暂无' }}</p>
    <p>结束时间: {{ $community_day->end_at or '暂无' }}</p>
    
    @can('createActivity',$community_day)
    <a href="/activity/create?type=zttr&community_day_id={{ $community_day->id }}" class="waves-effect waves-light btn">创建活动</a>
    @endcan
    
    @can('update',$community_day)
    <a href="/community_day/{{ $community_day->id }}/edit" class="waves-effect waves-light btn">编辑</a>
    @endcan
    
    @can('delete',$community_day)
    <a href="#" onclick="event.preventDefault();
            document.getElementById('delete_community_day').submit();" class="waves-effect waves-light btn">删除</a>
    <form id="delete_community_day" action="/community_day/{{ $community_day->id }}" method="POST" style="display: none;">
        <input type="hidden" name="_method" value="DELETE">
        @csrf
    </form>
    @endcan
    
    <hr>
    {{ $community_day->activities()->count() }}
    
    <!-- TODO -->
    
    
</div>

@stop