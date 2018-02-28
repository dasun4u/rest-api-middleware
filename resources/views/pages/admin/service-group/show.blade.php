@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <h3 class="all-news">Service Group</h3>
        <div class="row min-pad">
            {{--Name--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $group->name }}"
                           readonly>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--Description--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control"
                              readonly>{{ $group->description }}</textarea>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            <div class="col-sm-6 box-wrap">
                {{--Active--}}
                <div class="form-group col-sm-6">
                    <label for="active" class="col-sm-12">Active Status</label>
                    <p>{{ $group->active==1?'Active':'Inactive' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection