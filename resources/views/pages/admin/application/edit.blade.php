@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <form action="{{ url('/admin/applications/'.$application->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <h3 class="all-news">Update Application</h3>
            <div class="row min-pad">
                {{--Name--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="name">Name<span class="red-text">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" maxlength="50" value="{{ $application->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Token Validity--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="token_validity">Token Validity<span class="red-text">*</span> (seconds)</label>
                        <input type="text" id="token_validity" name="token_validity" class="form-control" value="{{ $application->token_validity }}">
                        @if ($errors->has('token_validity'))
                            <span class="help-block">
                            <strong>{{ $errors->first('token_validity') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                <div class="col-sm-6 box-wrap">
                    {{--Active--}}
                    <div class="form-group col-sm-6">
                        <label for="active" class="col-sm-12">Active</label>
                        <input type="checkbox" id="active" name="active" {{ $application->active==1?"checked":"" }} class="toggle-switch-active col-sm-12"
                               data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success">
                        @if($errors->has('active'))
                            <span class="help-block">
                            <strong>{{ $errors->first('active') }}</strong>
                        </span>
                        @endif
                    </div>
                    {{--Approve--}}
                    <div class="form-group col-sm-6">
                        <label for="approved" class="col-sm-12">Approve</label>
                        <input type="checkbox" id="approved" name="approved" {{ $application->approved==1?"checked":"" }} class="toggle-switch-approve col-sm-12"
                               data-toggle="toggle" data-on="Approved" data-off="Not Approved" data-onstyle="success">
                        @if($errors->has('approved'))
                            <span class="help-block">
                            <strong>{{ $errors->first('approved') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Description--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" maxlength="1000">{{ $application->description }}</textarea>
                        @if($errors->has('description'))
                            <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Production Key--}}
                <div class="col-sm-12 box-wrap">
                    <div class="form-group">
                        <label for="production_key">Production Key</label>
                        <input type="text" id="production_key" name="production_key" class="form-control"
                               maxlength="200" value="{{ $application->production_key }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Production Secret--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="production_secret">Production Secret</label>
                        <input type="text" id="production_secret" name="production_secret" class="form-control"
                               maxlength="200" value="{{ $application->production_secret }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Sandbox Key--}}
                <div class="col-sm-12 box-wrap">
                    <div class="form-group">
                        <label for="sandbox_key">Sandbox Key</label>
                        <input type="text" id="sandbox_key" name="sandbox_key" class="form-control" maxlength="200"
                               value="{{ $application->sandbox_key }}" readonly>
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Sandbox Secret--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="sandbox_secret">Sandbox Secret</label>
                        <input type="text" id="sandbox_secret" name="sandbox_secret" class="form-control"
                               maxlength="200" value="{{ $application->sandbox_secret }}" readonly>
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