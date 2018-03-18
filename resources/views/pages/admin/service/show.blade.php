@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <h3 class="all-news">Service</h3>
        <div class="row min-pad">
            {{--Name--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $service->name }}"
                           readonly>
                </div>
            </div>
            {{--Description--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control"
                              readonly>{{ $service->description }}</textarea>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--Service Context--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="context">Service Context</label>
                    <input type="text" id="context" name="context" class="form-control" value="{{ $service->context }}"
                           readonly>
                </div>
            </div>
            {{--Method--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="method">Method</label>
                    <input type="text" id="method" name="method" class="form-control" value="{{ $service->method }}"
                           readonly>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--Production URI--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="production_uri">Production URI</label>
                    <input type="text" id="production_uri" name="production_uri" class="form-control" value="{{ $service->production_uri }}"
                           readonly>
                </div>
            </div>
            {{--Sandbox URI--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="sandbox_uri">Sandbox URI</label>
                    <input type="text" id="sandbox_uri" name="sandbox_uri" class="form-control" value="{{ $service->sandbox_uri }}"
                           readonly>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--Service Group--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="service_group">Service Group</label>
                    <input type="text" id="service_group" name="service_group" class="form-control" value="{{ $service->group->name }}"
                           readonly>
                </div>
            </div>
            {{--Active--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group col-sm-6">
                    <label for="active" class="col-sm-12">Active Status</label>
                    <p>{{ $service->active==1?'Active':'Inactive' }}</p>
                </div>
            </div>
        </div>
        <div class="row form-btn-pad-left form-btn-pad-bottom">
            <div class="col-sm-12">
                <div class="form-group">
                    <a href="{{ url('admin/services') }}"><button type="button" class="btn btn-success">BACK</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection