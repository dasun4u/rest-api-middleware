@extends('layouts.cms.sidebar')
@section('content')


    <div class="col-sm-9 body-back">
        {!! Form::model($agent, ['method' => 'PATCH', 'url' => ['agents',$agent->id], 'files' => true]) !!}
        <h3 class="all-news">Edit Agent</h3>
        <div class="row min-pad">
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name<span class="red-text">*</span></label>
                    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 100] ) !!}
                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Number<span class="red-text">*</span></label>
                    {!! Form::text('mobile', null, ['class' => 'form-control','maxlength' => 11] ) !!}
                    @if ($errors->has('mobile'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success"/>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="row">

    </div>
    {!! Form::close() !!}
@endsection