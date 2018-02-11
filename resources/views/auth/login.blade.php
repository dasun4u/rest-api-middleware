@extends('layouts.default')

@section('content')
<div class="row login_bg">
    <div class="col-sm-4 col-sm-offset-4 pad-login">
        <div class="row">
            <div class="col-sm-12 login-shadow">
                <img src="{!! url('images/new_logo.png') !!}" height="40px" class="logo" style="margin: 20px auto 0;display: block">
                <h3 class="login-text text-center">Login</h3>
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}
                    <div class="form-group set_margin_0">
                        <label for="username" class="form-lable">Username</label>
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                        @if ($errors->has('username'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group set_margin_0">
                        <label for="password" class="form-lable">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                        <br>
                        <div class="checkbox">
                            <label class="rememberme_check">
                                <input type="checkbox" value="">
                                <span>&nbsp;Remember me</span>
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-12 login-btn-pad">
                        <button type="submit" class="btn btn-primary col-sm-12 login-btn">
                            Login
                        </button>
                        {{--<a class="btn btn-link" href="{{ url('/password/reset') }}">
                            Forgot Your Password?
                        </a>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
