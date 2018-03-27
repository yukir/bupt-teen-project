@extends('layouts.app')

@section('content')
<div id="delete_model" class="modal">
    <div class="modal-content">
        <h4>确认要删除吗</h4>
        <p>删除主题团日会删除该团日分类下的所有活动！</p>
    </div>
    <div class="modal-footer">
        <a href="#!" onclick="event.preventDefault();
            document.getElementById('delete_community_day').submit();"  class="modal-action modal-close waves-effect waves-green btn-flat">删除</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">不删除</a>
    </div>
</div>

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
    <a href="#delete_model" class="waves-effect waves-light btn modal-trigger">删除</a>
    <form id="delete_community_day" action="/community_day/{{ $community_day->id }}" method="POST" style="display: none;">
        <input type="hidden" name="_method" value="DELETE">
        @csrf
    </form>
    @endcan
    
    <hr>
    @if($community_day->activities()->count()==0)
    <p>该主题团日下暂无活动！</p>
    @else
    <table class="striped" >
        <thead>
            <tr>
                <th class="maxwidth">标题</th>
                <th class="minwidth">发布时间</th>
            </tr>
            </tr>
        </thead>

        <tbody>
            @foreach ($community_day->activities as $activity)
            <tr>
                <td><a href="/activity/{{ $activity->id }}">{{ str_limit($activity->title,30) }}</a></td>
                <td class="timeago" datetime="{{ date('Y-m-d H:i:s',strtotime($activity->created_at)) }}"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
 
</div>

@stop