@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <form action="{{ url('/admin/messages') }}" method="post">
            {{ csrf_field() }}
            <h3 class="all-news">New Message</h3>
            <div class="row min-pad">
                {{--Title--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="title">Title<span class="red-text">*</span></label>
                        <input type="text" id="title" name="title" class="form-control" value="">
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--To--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="to">To<span class="red-text">*</span></label>
                        <select name="to[]" id="to" class="form-control" multiple="multiple">
                            @forelse($users as $user)
                                <option value="{{ $user->id }}" {{ old('to')==$user->id?"selected":"" }}>{{ $user->username }}</option>
                            @empty
                                <option value="">--No Users--</option>
                            @endforelse
                        </select>
                        @if ($errors->has('to'))
                            <span class="help-block">
                                <strong>{{ $errors->first('to') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Message--}}
                <div class="col-sm-12 box-wrap">
                    <div class="form-group">
                        <label for="description">Message<span class="red-text">*</span></label>
                        <textarea id="message" name="message" class="form-control"></textarea>
                        @if ($errors->has('message'))
                            <span class="help-block">
                                <strong>{{ $errors->first('message') }}</strong>
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
    <script>
        $(document).ready(function () {
            $('#to').select2();
        });

    </script>
@endsection
