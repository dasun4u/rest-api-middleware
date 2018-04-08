@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <form action="{{ url('/admin/users/'.$user->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <h3 class="all-news">Update User</h3>
            <div class="row min-pad">
                {{--First Name--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" maxlength="50"
                               value="{{ $user->first_name }}">
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Last Name--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" maxlength="50"
                               value="{{ $user->last_name }}">
                        @if ($errors->has('last_name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Username--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="username">Username<span class="red-text">*</span></label>
                        <input type="text" id="username" name="username" class="form-control" maxlength="50"
                               value="{{ $user->username }}" readonly>
                        @if ($errors->has('username'))
                            <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Active--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group col-sm-6">
                        <label for="active" class="col-sm-12">Active</label>
                        <input type="checkbox" id="active" name="active"
                               {{ $user->active==1?"checked":"" }} class="toggle-switch-active col-sm-12"
                               data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success">
                        @if($errors->has('active'))
                            <span class="help-block">
                            <strong>{{ $errors->first('active') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Password--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="password">Password<span class="red-text">*(leave blank to keep previous password)</span></label>
                        <input type="password" id="password" name="password" class="form-control" maxlength="50">
                        @if ($errors->has('password'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Confirm Password--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password<span class="red-text">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" maxlength="50">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Email--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="email">Email<span class="red-text">*</span></label>
                        <input type="email" id="email" name="email" class="form-control" maxlength="50"
                               value="{{ $user->email }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Mobile--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="text" id="mobile" name="mobile" class="form-control" maxlength="20"
                               value="{{ $user->mobile }}">
                        @if ($errors->has('mobile'))
                            <span class="help-block">
                            <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row form-btn-pad-left form-btn-pad-bottom">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Update"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection