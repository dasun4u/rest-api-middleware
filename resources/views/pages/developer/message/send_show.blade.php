@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <h3 class="all-news">Show Message</h3>
        <div class="row min-pad">
            {{--Title--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ $message->title }}"
                           readonly>
                </div>
            </div>
        </div>
        <div class="row min-pad">
            {{--To--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="sender">To</label>
                    @php
                        $receivers_ids = explode(",",$message->receivers_id);
                        $receivers_names_array = [];
                        foreach ($receivers_ids as $receiver_id){
                            $receiver_user = \App\User::find($receiver_id);
                            $receivers_names_array[] = $receiver_user->first_name . " ". $receiver_user->last_name;
                        }
                    @endphp
                    <input type="text" id="sender" name="sender" class="form-control"
                           value="{{ implode(", ",$receivers_names_array) }}" readonly>
                </div>
            </div>
            {{--Send Time--}}
            <div class="col-sm-6 box-wrap">
                <div class="form-group">
                    <label for="time">Send Time</label>
                    <input type="text" id="time" name="time" class="form-control"
                           value="{{ $message->created_at }}" readonly>
                </div>
            </div>

        </div>
        <div class="row min-pad">
            {{--Message--}}
            <div class="col-sm-12 box-wrap">
                <div class="form-group">
                    <label for="description">Message</label>
                    <textarea id="message" name="message" class="form-control" readonly>{{ $message->message }}</textarea>
                </div>
            </div>
        </div>
        <div class="row form-btn-pad-left form-btn-pad-bottom">
            <div class="col-sm-12">
                <div class="form-group">
                    <a href="{{ url('developer/messages/sendMessages/showList') }}"><button type="button" class="btn btn-success">BACK</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection