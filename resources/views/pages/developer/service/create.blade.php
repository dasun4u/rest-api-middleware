@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <form action="{{ url('/developer/services') }}" method="post">
            {{ csrf_field() }}
            <h3 class="all-news">Create Service</h3>
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
                {{--Service Context--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="context">Service Context<span class="red-text">*</span></label>
                        <br><label>(ex:- http://{your domain}/api/{group context}/{service context}/XXXXXXXXXX)</label>
                        <input type="text" id="context" name="context" class="form-control" maxlength="200"
                               value="{{ old('context') }}">
                        @if ($errors->has('context'))
                            <span class="help-block">
                            <strong>{{ $errors->first('context') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Method--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="method">Method<span class="red-text">*</span></label>
                        <br><label>(http method of service)</label>
                        <select name="method" id="method" class="form-control">
                            <option value="GET" {{ old('method')=="GET"?"selected":"" }}>GET</option>
                            <option value="POST" {{ old('method')=="POST"?"selected":"" }}>POST</option>
                            <option value="PUT" {{ old('method')=="PUT"?"selected":"" }}>PUT</option>
                            <option value="PATCH" {{ old('method')=="PATCH"?"selected":"" }}>PATCH</option>
                            <option value="DELETE" {{ old('method')=="DELETE"?"selected":"" }}>DELETE</option>
                            <option value="OPTIONS" {{ old('method')=="OPTIONS"?"selected":"" }}>OPTIONS</option>
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
                {{--Production URI--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="production_uri">Production URI<span class="red-text">*</span></label>
                        <br><label>(ex:- http://appserver/service-1)</label>
                        <input type="text" id="production_uri" name="production_uri" class="form-control"
                               maxlength="200"
                               value="{{ old('production_uri') }}" title="Please enter here resource base URI">
                        @if ($errors->has('production_uri'))
                            <span class="help-block">
                            <strong>{{ $errors->first('production_uri') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Sanadbox URI--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="sandbox_uri">Sandbox URI<span class="red-text">*</span></label>
                        <br><label>(ex:- http://sandbox.appserver/service-1)</label>
                        <input type="text" id="sandbox_uri" name="sandbox_uri" class="form-control" maxlength="200"
                               value="{{ old('sandbox_uri') }}" title="Please enter here resource sandbox base URI">
                        @if ($errors->has('sandbox_uri'))
                            <span class="help-block">
                            <strong>{{ $errors->first('sandbox_uri') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Service Group--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="service_group">Service Group<span class="red-text">*</span></label>
                        <select name="service_group" id="service_group" class="form-control">
                            @forelse($service_groups as $service_group)
                                <option value="{{ $service_group->id }}" {{ old('service_group')==$service_group->id?"selected":"" }}>{{ $service_group->name }}</option>
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