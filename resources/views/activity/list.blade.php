@extends('layouts.app')
@section('css')
<style>
    .activity {
        border-bottom: 1px solid rgb(200,200,200);
    }
    .activity a {
        text-decoration: none;
    }
    .activity p {
        text-align: right;
    }
    .maxwidth {
        width:90%;
    }
    .minwidth {
        width:30px;
    }
</style>
@stop
@section('content')
<div class="container">
    @if ($activities->isEmpty())
    <p>暂无活动！</p>
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
            @foreach ($activities as $activity)
            <tr>
                <td><a href="/activity/{{ $activity->id }}">{{ str_limit($activity->title,30) }}</a></td>
                <td class="timeago">{{ $activity->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    @endif
</div>
@stop
@section('js')
<script src="{{ asset('js/timeago.min.js') }}"></script> 
<script>
    var timeagoInstance = timeago();
    timeagoInstance.render(document.querySelectorAll('.timeago'), 'zh_CN');
</script>
@stop