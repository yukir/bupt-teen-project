@extends('layouts.app')

@section('content')
<div class="container">
    <h3>{{ __('注册') }}</h3>
    <div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="input-field col s6">
                    <input id="username" type="text" class="validate {{ $errors->has('username') ? ' invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                    <label for="username">{{ __('用户名') }}</label>
                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>    
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="password" type="password" class="validate {{ $errors->has('password') ? ' invalid' : '' }}" name="password"  value="{{ old('password') }}" required>
                    <label for="password">{{ __('密码') }}</label>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>      
            <div class="row">
                <div class="input-field col s6">
                    <input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
                    <label for="password-confirm">{{ __('确认密码') }}</label>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <button class="btn waves-effect waves-light" type="submit" name="action">
                        {{ __('注册') }}<i class="material-icons right">send</i>
                     </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function(){
        Materialize.updateTextFields();
    });

</script>
@stop
