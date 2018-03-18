@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <form action="{{ url('/admin/services/'.$service->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">
            <h3 class="all-news">Update Service</h3>
            <div class="row min-pad">
                <div class="col-sm-6 box-wrap">
                    {{--Name--}}
                    <div class="form-group">
                        <label for="name">Name<span class="red-text">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" maxlength="100"
                               value="{{ $service->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6 box-wrap">
                    {{--Description--}}
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control"
                                  maxlength="1000">{{ $service->description }}</textarea>
                        @if($errors->has('description'))
                            <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                <div class="col-sm-6 box-wrap">
                    {{--Service Context--}}
                    <div class="form-group">
                        <label for="context">Service Context<span class="red-text">*</span></label>
                        <input type="text" id="context" name="context" class="form-control" maxlength="200"
                               value="{{ $service->context }}">
                        @if ($errors->has('context'))
                            <span class="help-block">
                            <strong>{{ $errors->first('context') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6 box-wrap">
                    {{--Description--}}
                    <div class="form-group">
                        <label for="description">Description</label>
                        <br><label>(http method of service)</label>
                        <select name="method" id="method" class="form-control">
                            <option value="GET" {{ $service->method=="GET"?"selected":"" }}>GET</option>
                            <option value="POST" {{ $service->method=="POST"?"selected":"" }}>POST</option>
                            <option value="PUT" {{ $service->method=="PUT"?"selected":"" }}>PUT</option>
                            <option value="PATCH" {{ $service->method=="PATCH"?"selected":"" }}>PATCH</option>
                            <option value="DELETE" {{ $service->method=="DELETE"?"selected":"" }}>DELETE</option>
                            <option value="OPTIONS" {{ $service->method=="OPTIONS"?"selected":"" }}>OPTIONS</option>
                        </select>
                        @if ($errors->has('method'))
                            <span class="help-block">
                            <strong>{{ $errors->first('method') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                <div class="col-sm-6 box-wrap">
                    {{--Production URI--}}
                    <div class="form-group">
                        <label for="production_uri">Production URI<span class="red-text">*</span></label>
                        <br><label>(ex:- http://appserver/service-1)</label>
                        <input type="text" id="production_uri" name="production_uri" class="form-control"
                               maxlength="200"
                               value="{{ $service->production_uri }}">
                        @if ($errors->has('production_uri'))
                            <span class="help-block">
                            <strong>{{ $errors->first('production_uri') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6 box-wrap">
                    {{--Sandbox URI--}}
                    <div class="form-group">
                        <label for="sandbox_uri">Sandbox URI<span class="red-text">*</span></label>
                        <br><label>(ex:- http://sandbox.appserver/service-1)</label>
                        <input type="text" id="sandbox_uri" name="sandbox_uri" class="form-control" maxlength="200"
                               value="{{ $service->sandbox_uri }}">
                        @if ($errors->has('sandbox_uri'))
                            <span class="help-block">
                            <strong>{{ $errors->first('sandbox_uri') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                <div class="col-sm-6 box-wrap">
                    {{--Service Group--}}
                    <div class="form-group">
                        <label for="service_group">Service Group<span class="red-text">*</span></label>
                        <select name="service_group" id="service_group" class="form-control">
                            @forelse($service_groups as $service_group)
                                <option value="{{ $service_group->id }}" {{ $service->group->id==$service_group->id?"selected":"" }}>{{ $service_group->name }}</option>
                            @empty
                                <option value="">--No Service Group--</option>
                            @endforelse
                        </select>
                        @if ($errors->has('service_group'))
                            <span class="help-block">
                            <strong>{{ $errors->first('service_group') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6 box-wrap">
                    {{--Active--}}
                    <div class="form-group col-sm-6">
                        <label for="active" class="col-sm-12">Active</label>
                        <input type="checkbox" id="active" name="active"
                               {{ $service->active==1?"checked":"" }} class="toggle-switch-active col-sm-12"
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
                        <input type="submit" class="btn btn-success" value="Update"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection