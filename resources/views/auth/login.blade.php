@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        <h3>{{ __('登录') }}</h3>
        <div>
            <form method="POST" action="{{ route('login') }}">
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
                    <div class="col s3">
                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            {{ __('登录') }}<i class="material-icons right">send</i>
                         </button>
                    </div>
                    <div class="col s3">
                        <p style="text-align:right;margin-top:1px;">
                            <input type="checkbox" class="filled-in" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                            <label for="remember"> {{ __('记住我') }}</label>
                        </p>   
                    </div>
                </div>
            </form>
        </div>
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
