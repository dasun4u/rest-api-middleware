@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <h1>Subscriptions</h1>
                    </div>
                    <div class="col-sm-4 btn-div-pad">
                        <a href="{{ url('/developer/subscriptions/create') }}">
                            <button class="btn btn-success pull-right">Add new subscription</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive table-pad">
                        <table class="table main-table">
                            <thead>
                            <tr class="info">
                                <th>#</th>
                                <th>Application</th>
                                <th>Service</th>
                                <th>Subscribed By</th>
                                <th class="text-center">Created Time</th>
                                <th class="text-center">Approved</th>
                                <th class="text-center">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($subscriptions as $subscription)
                                <tr class="{{ $subscription->approved?"success":"default" }}">
                                    <td>{{ $subscription->id }}</td>
                                    <td>
                                        <a href="{{ url('developer/application/'.$subscription->application->id) }}">
                                            {{ $subscription->application->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('developer/service/'.$subscription->service->id) }}">
                                            {{ $subscription->service->name }}
                                        </a>
                                    </td>
                                    <td>{{ $subscription->subscribedBy->username }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($subscription->created_at)->toDateTimeString() }}</td>
                                    <td class="text-center">
                                        {{ $subscription->approved?"Approved":"Not Approved" }}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger remove-subscription"
                                                data-delete-id="{{ $subscription->id }}" title="Delete">
                                            <span class="fa fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Subscriptions Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $subscriptions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script>
            // Remove Subscription Confirmation
            $(document.body).on("click", ".remove-subscription", function () {
                var subscription_id = $(this).data('delete-id');
                showConfirm("DELETE", "Do you want to delete this Subscription ?", "deleteSubscription(" + subscription_id + ")");
            });

            // Remove Subscription AJAX
            function deleteSubscription(id) {
                $.ajax({
                    type: 'delete',
                    url: '{!! url('developer/subscriptions') !!}/' + id,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            $('[data-delete-id="' + id + '"]').closest('tr').remove();
                            showAlert("SUCCESS", "Delete Subscription successful");
                        } else {
                            showAlert("FAIL", "Delete Subscription fail");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Delete Subscription fail");
                    }
                });
            }

        </script>

@endsection