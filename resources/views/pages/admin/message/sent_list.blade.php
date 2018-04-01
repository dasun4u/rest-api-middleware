@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <h1>Sent Messages</h1>
                    </div>
                    <div class="col-sm-4 btn-div-pad">
                        <a href="{{ url('/admin/messages') }}" class="pull-left">
                            <button class="btn btn-warning pull-right">Received messages</button>
                        </a>
                        <a href="{{ url('/admin/messages/create') }}">
                            <button class="btn btn-success pull-right">Create new message</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive table-pad">
                        <table class="table main-table">
                            <thead>
                            <tr class="info">
                                <th>To</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th class="text-center">Send Time</th>
                                <th class="text-center">View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($send_messages as $send_message)
                                <tr>
                                    @php
                                        $receivers_ids = explode(",",$send_message->receivers_id);
                                        $receivers_names_array = [];
                                        foreach ($receivers_ids as $receiver_id){
                                            $receiver_user = \App\User::find($receiver_id);
                                            $receivers_names_array[] = $receiver_user->first_name . " ". $receiver_user->last_name;
                                        }
                                    @endphp
                                    <td>{{ implode(", ",$receivers_names_array) }}</td>
                                    <td>{{ $send_message->title }}</td>
                                    <td>{{ str_limit($send_message->message,20,"...") }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($send_message->created_at)->toDateTimeString() }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('admin/messages/sendMessages/'.$send_message->id) }}">
                                            <button class="btn btn-primary" title="Show">
                                                <span class="fa fas fa-eye"></span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Messages Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $send_messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection