@extends('layouts.app')

@section('content')

<div class="container center-align">
    <br>
    <img width="300" height="300" class=" circle" src="{{ $user->avatar }}">
    <h2>{{ $user->username }}</h2>
    <p>加入时间: <span class="timeago" >{{ $user->created_at }}</span></p>
    
    
</div>
@endsection

@section('js')
<script src="{{ asset('js/timeago.min.js') }}"></script> 
<script>
    var timeagoInstance = timeago();
    timeagoInstance.render(document.querySelectorAll('.timeago'), 'zh_CN');
</script>
@stop