@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <form action="{{ url('/admin/serviceGroups/'.$group->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <h3 class="all-news">Update Service Group</h3>
            <div class="row min-pad">
                <div class="col-sm-6 box-wrap">
                    {{--Name--}}
                    <div class="form-group">
                        <label for="name">Name<span class="red-text">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" maxlength="100"
                               value="{{ $group->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
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
                        <input type="checkbox" id="active" name="active"
                               {{ $group->active==1?"checked":"" }} class="toggle-switch-active col-sm-12"
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
                <div class="col-sm-6 box-wrap">
                    {{--Description--}}
                    <div class="col-sm-6 box-wrap">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" class="form-control"
                                      maxlength="1000">{{ $group->description }}</textarea>
                            @if($errors->has('description'))
                                <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                            @endif
                        </div>
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