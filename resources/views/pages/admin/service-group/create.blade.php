@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <form action="{{ url('/admin/serviceGroups') }}" method="post">
            {{ csrf_field() }}
            <h3 class="all-news">Create Service Groups</h3>
            <div class="row min-pad">
                {{--Name--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="name">Name<span class="red-text">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" maxlength="100"
                               value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Description--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control"
                                  maxlength="1000">{{ old('description')!=''?old('description'):'' }}</textarea>
                        @if($errors->has('description'))
                            <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Active--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group col-sm-6">
                        <label for="active" class="col-sm-12">Active</label>
                        <input type="checkbox" id="active" name="active"
                               {{ old('active')=='on'?"checked":"" }} class="toggle-switch-active col-sm-12"
                               data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success">
                        @if($errors->has('active'))
                            <span class="help-block">
                            <strong>{{ $errors->first('active') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row form-btn-pad-left form-btn-pad-bottom">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Create"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection