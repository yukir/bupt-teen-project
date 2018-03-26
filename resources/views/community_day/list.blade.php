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
    @if ($community_days->isEmpty())
    <p>暂无主题团日！</p>
    @else  
    <table class="striped" >
        <thead>
            <tr>
                <th class="maxwidth">团日名称</th>
                <th class="minwidth">发布时间</th>
            </tr>
          
        </thead>

        <tbody>
            @foreach ($community_days as $community_day)
            <tr>
                <td><a href="/community_day/{{ $community_day->id }}">{{ str_limit($community_day->name,30) }}</a></td>
                <td class="timeago" datetime="{{ date('Y-m-d H:i:s',strtotime($community_day->created_at)) }}"></td>
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