@extends('layouts.default')

@section('content')
    <div class="row login_bg">
        <div class="col-sm-4 col-sm-offset-4 pad-register">
            <div class="row">
                <div class="col-sm-12 login-shadow">
                    {{--<img src="{!! url('images/new_logo.png') !!}" height="40px" class="logo" style="margin: 20px auto 0;display: block">--}}
                    <h3 class="login-text text-center">Register</h3>
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        {{--AVATAR--}}
                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-1 col-xs-12 col-xs-offset-0">
                                <div class="row">
                                    <div class="col-sm-12 login_icon text-center">
                                        <div style="background-image: url({{url('images/user.png')}});"
                                             id="uploaded_propic" onclick="$('#register_profile_picture').click();">
                                            <i class="fa fa-upload" aria-hidden="true"></i>
                                        </div>
                                        @if ($errors->has('avatar'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('avatar') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input onchange="readURL(this);" type="file" name="avatar" id="register_profile_picture"
                               class="pro_uploader">

                        {{--FIRST NAME--}}
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-8">
                                <input id="first_name" type="text" class="form-control" name="first_name"
                                       value="{{ old('first_name') }}"
                                       required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--LAST NAME--}}
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-8">
                                <input id="last_name" type="text" class="form-control" name="last_name"
                                       value="{{ old('last_name') }}"
                                       required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--USERNAME--}}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username <span
                                        class="red-text">*</span></label>

                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control" name="username"
                                       value="{{ old('username') }}"
                                       required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--EMAIL--}}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address <span
                                        class="red-text">*</span></label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--MOBILE--}}
                        <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            <label for="mobile" class="col-md-4 control-label">Mobile Number</label>

                            <div class="col-md-8">
                                <input id="mobile" type="text" class="form-control" name="mobile"
                                       value="{{ old('mobile') }}"
                                       required autofocus>

                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--PASSWORD--}}
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password <span
                                        class="red-text">*</span></label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--PASSWORD-CONFIRM--}}
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password <span
                                        class="red-text">*</span></label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
