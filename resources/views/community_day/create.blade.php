@extends('layouts.app')

@section('css')
<link href="{{ asset('css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
@stop
@section('content')
<div class="container">
    <br><br>
    <form method="POST" action="{{ route('community_day.store') }}">
        @csrf
        <div class="input-field">
            <input id="title" type="text" class="validate {{ $errors->has('name') ? ' invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
            <label for="title">团日名称</label>
            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div> 
        <div class="input-field">
            <input id="start_at" type="text" class="validate {{ $errors->has('start_at') ? ' invalid' : '' }}" name="start_at" value="{{ old('start_at') }}">
            <label for="password-confirm">团日开始时间</label>
        </div>
        @if ($errors->has('start_at'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('start_at') }}</strong>
            </span>
        @endif
        <div class="input-field">
            <input id="end_at" type="text" class="validate {{ $errors->has('end_at') ? ' invalid' : '' }}" name="end_at" value="{{ old('end_at') }}">
            <label for="password-confirm">团日结束时间</label>
        </div>
        @if ($errors->has('end_at'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('end_at') }}</strong>
            </span>
        @endif
        <div>
            <button class="btn waves-effect waves-light" type="submit" name="action">
                发布主题团日<i class="material-icons right">send</i>
             </button>
        </div>
    </form>
@stop
    
    
@section('js')
<script src="{{ asset('js/jquery.datetimepicker.full.min.js')}}"></script>
<script>
    $.datetimepicker.setLocale('zh');
    var logic = function() {
        Materialize.updateTextFields();
    }
    $('#start_at').datetimepicker({
         minDate:'0',//yesterday is minimum date(for today use 0 or -1970/01/01)
        onChangeDateTime:logic,
        onShow:logic,
    });
    $('#end_at').datetimepicker({
         minDate:'0',//yesterday is minimum date(for today use 0 or -1970/01/01)
        onChangeDateTime:logic,
        onShow:logic,
    });
    $(function(){
        Materialize.updateTextFields();
    });

</script>
@stop
