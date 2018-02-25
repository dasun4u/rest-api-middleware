@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <h3 class="all-news">Show Application</h3>
        <div class="row min-pad">
            {{--Name--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $application->name }}"
                           readonly>
                </div>
            </div>
            {{--Token Validity--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="token_validity">Token Validity (seconds)</label>
                    <input type="text" id="token_validity" name="token_validity" class="form-control"
                           value="{{ $application->token_validity }}" readonly>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            <div class="col-sm-6 box-wrap">
                {{--Active--}}
                <div class="form-group col-sm-6">
                    <label for="active" class="col-sm-12">Active Status</label>
                    <p>{{ $application->active==1?'Active':'Inactive' }}</p>
                </div>
                {{--Approve--}}
                <div class="form-group col-sm-6">
                    <label for="approved" class="col-sm-12">Approve Status</label>
                    <p>{{ $application->approved==1?'Approved':'Not Approved' }}</p>
                </div>
            </div>
            {{--Description--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" readonly>{{ $application->description }}</textarea>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--Production Key--}}
            <div class="col-sm-12 box-wrap">
                <div class="form-group">
                    <label for="production_key">Production Key</label>
                    <input type="text" id="production_key" name="production_key" class="form-control"
                           value="{{ $application->production_key }}" readonly>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--Production Secret--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="production_secret">Production Secret</label>
                    <input type="text" id="production_secret" name="production_secret" class="form-control"
                           value="{{ $application->production_secret }}" readonly>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--Sandbox Key--}}
            <div class="col-sm-12 box-wrap">
                <div class="form-group">
                    <label for="sandbox_key">Sandbox Key</label>
                    <input type="text" id="sandbox_key" name="sandbox_key" class="form-control"
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
                           value="{{ $application->sandbox_secret }}" readonly>
                </div>
            </div>
        </div>
    </div>
@endsection