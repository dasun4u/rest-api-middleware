@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">

        <h3 class="all-news">User</h3>
        <div class="row min-pad">
            {{--First Name--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" readonly
                           value="{{ $user->first_name }}">
                </div>
            </div>
            {{--Last Name--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" readonly
                           value="{{ $user->last_name }}">
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--Username--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" readonly
                           value="{{ $user->username }}">
                </div>
            </div>
            {{--Active--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group col-sm-6">
                    <label for="active" class="col-sm-12">Active</label>
                    <p>{{ $user->active==1?"Active":"Inactive" }}</p>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--Email--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" readonly
                           value="{{ $user->email }}">
                </div>
            </div>
            {{--Mobile--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input type="text" id="mobile" name="mobile" class="form-control" readonly
                           value="{{ $user->mobile }}">
                </div>
            </div>
        </div>
        <div class="row form-btn-pad-left form-btn-pad-bottom">
            <div class="col-sm-12">
                <div class="form-group">
                    <a href="{{ url()->previous() }}"><button type="button" class="btn btn-success">BACK</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection