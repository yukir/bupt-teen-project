@extends('layouts.app')

@section('css')
<link href="{{ asset('css/wangEditor.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container">
    <br><br>
    <form method="POST" action="{{ route('activity.store') }}">
        @csrf
        <div class="input-field">
            <input id="title" type="text" class="validate {{ $errors->has('title') ? ' invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
            <label for="title">活动标题</label>
            @if ($errors->has('title'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div> 
        <input type="hidden" name="type" value="{{ $type }}">
        <p>活动分类:{{ \App\Activity::type_name($type) }}</p>
        <div id="content_wang">
            {!! old('content') !!}
        </div>
        @if ($errors->has('content'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
        @endif
        <textarea type="string" style="display:none" id="content" name="content" value="{{ old('content') }}"></textarea>
        <div class="input-field">
            <input id="start_at" type="datetime" class="validate {{ $errors->has('start_at') ? ' invalid' : '' }}" name="start_at" value="{{ old('start_at') }}" required>
            <label for="password-confirm">活动开始时间</label>
        </div>
        @if ($errors->has('start_at'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('start_at') }}</strong>
            </span>
        @endif
        <p style="margin-top:1px;">
            <input type="checkbox" class="filled-in" id="check_required" name="check_required" {{ old('check_required') ? 'checked' : '' }}/>
            <label for="check_required">是否需要签到/签退</label>
        </p> 
        <div>
            <button class="btn waves-effect waves-light" type="submit" name="action">
                发布活动<i class="material-icons right">send</i>
             </button>
        </div>
    </form>
@stop
    
    
@section('js')
<script src="{{ asset('js/wangEditor.js')}}"></script>
<script src="{{ asset('js/jquery.datetimepicker.full.min.js')}}"></script>
<script>
    $.datetimepicker.setLocale('zh');
    $('#start_at').datetimepicker({
         minDate:'0',//yesterday is minimum date(for today use 0 or -1970/01/01)
    });
    var E = window.wangEditor;
    var editor = new E("#content_wang");
    editor.customConfig.onchange = function(html) {
        $("#content").val(html);
    }
    editor.create();
    $("#content").val(editor.txt.html());
    
    $(function(){
        Materialize.updateTextFields();
    });

</script>
@stop
