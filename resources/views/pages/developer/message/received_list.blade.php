@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <h1>Received Messages</h1>
                    </div>
                    <div class="col-sm-4 btn-div-pad">
                        <a href="{{ url('/developer/messages/sendMessages/showList') }}" class="pull-left">
                            <button class="btn btn-warning pull-right">Sent messages</button>
                        </a>
                        <a href="{{ url('/developer/messages/create') }}" class="pull-right">
                            <button class="btn btn-success pull-right">Create new message</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive table-pad">
                        <table class="table main-table">
                            <thead>
                            <tr class="info">
                                <th>Sender Name</th>
                                <th>Title</th>
                                <th>Message</th>
                                <th class="text-center">Received Time</th>
                                <th class="text-center">View</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($receive_messages as $receive_message)
                                <tr class="{{ $receive_message->is_read?"warning":"default" }}">
                                    <td>{{ $receive_message->sendMessage->sender->first_name ." ". $receive_message->sendMessage->sender->last_name }}</td>
                                    <td>{{ $receive_message->sendMessage->title }}</td>
                                    <td>{{ str_limit($receive_message->sendMessage->message,20,"...") }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($receive_message->created_at)->toDateTimeString() }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('developer/messages/'.$receive_message->id) }}">
                                            <button class="btn btn-primary" title="Show">
                                                <span class="fa fas fa-eye"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger remove-message"
                                                data-delete-id="{{ $receive_message->id }}" title="Delete">
                                            <span class="fa fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Messages Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $receive_messages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script>
            // Remove Message Confirmation
            $(document.body).on("click", ".remove-message", function () {
                var message_id = $(this).data('delete-id');
                showConfirm("DELETE", "Do you want to delete this message ?", "deleteMessage(" + message_id + ")");
            });

            // Remove Message AJAX
            function deleteMessage(id) {
                $.ajax({
                    type: 'delete',
                    url: '{!! url('developer/messages') !!}/' + id,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            $('[data-delete-id="' + id + '"]').closest('tr').remove();
                            showAlert("SUCCESS", "Delete Message successful");
                        } else {
                            showAlert("FAIL", "Delete Message fail");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Delete Message fail");
                    }
                });
            }
        </script>

@endsection