@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s12 m6">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">测试</span>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        您已成功登录！
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
