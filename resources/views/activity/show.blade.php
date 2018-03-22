@extends('layouts.app')

@section('css')
<style>
    .comment {
        border-bottom: 1px solid rgb(200,200,200);
    }
    .comment_clone {
        display: none;
    }
</style>
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
    <hr>
    @include('activity.partials.comment')
    <hr>
    <h4>评论列表</h4>
    @if ($activity->comments()->count()==0)
    <p>暂无评论!</p>
    @else
    <div class="comment_list">
        <div class="comment comment_clone">
        <p><strong><a class="comment_author" href="#"></a></strong>:<span class="comment_content"></span></p>
        </div>
        @foreach ($activity->comments as $comment)
            @can('view',$comment,$activity)
            <div class="comment" data-id="{{ $comment->id }}">
            <p><strong><a class="comment_author" href="#">{{ $comment->user->username }}</a></strong>:<span class="comment_content">{{ $comment->content }}</span></p>
            </div>
            <div class="comment_buttons">
                <span class="timeago">{{ $comment->created_at }}</span>
                @can('update',$activity,$comment)
                &nbsp;|&nbsp;<a href="#" class="comment_update">修改</a>     
                @endcan
                @can('delete',$comment,$activity)
                &nbsp;|&nbsp;<a href="#" class="comment_delete">删除</a>
                @endcan
                @can('moderate',$comment,$activity)
                @if(!$comment->checked)
                &nbsp;|&nbsp;<a href="#" class="comment_moderate">审核通过</a>
                @endif
                @endcan
            </div>
            @endcan
        @endforeach
    @endif
    </div>    
</div>
@stop

@section('js')
<script src="{{ asset('js/timeago.min.js') }}"></script> 
<script>
    var timeagoInstance = timeago();
    timeagoInstance.render(document.querySelectorAll('.timeago'), 'zh_CN');
    
    $(function(){
        $("#comment_submit").click(function(){
            if($("#content").val()=="") $("#content").focus().addClass("invalid");
            else {
                var d = {};
                d.content = $("#content").val();
                $.post("/activity/{{ $activity->id }}/comment",d,function(data){
                    if(data.status!==undefined && data.status == 'success') {
                        Materialize.toast(data.info,3000);
                        var $clone = $(".comment_clone").clone();
                        $clone.removeClass("comment_clone").appendTo(".comment_list");
                        $clone.children(".comment_author").text("{{ Auth::user()->username }}");
                        $clone.children(".comment_content").text($("#content").val());
                        $clone.focus();
                        $("content").val("");
                    } else {
                        console.log(data);
                        Materialize.toast("评论发表失败！",3000);
                    }
                });
            }
        });
    });

</script>
@stop