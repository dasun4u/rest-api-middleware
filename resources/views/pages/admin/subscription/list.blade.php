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
                        <a href="{{ url('/admin/subscriptions/create') }}">
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
                                        <a href="{{ url('admin/application/'.$subscription->application->id) }}">
                                            {{ $subscription->application->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/service/'.$subscription->service->id) }}">
                                            {{ $subscription->service->name }}
                                        </a>
                                    </td>
                                    <td>{{ $subscription->subscribedBy->username }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($subscription->created_at)->toDateTimeString() }}</td>
                                    <td class="text-center">
                                        <input type="checkbox"
                                               {{ $subscription->approved?"checked":"" }} class="toggle-switch-approve"
                                               data-toggle="toggle" data-approve-id="{{ $subscription->id }}"
                                               data-on="Approved"
                                               data-off="Not Approved" data-onstyle="success">
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
                    url: '{!! url('admin/subscriptions') !!}/' + id,
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

            // Approve Switch
            $(function () {
                var approve_switches = $('.toggle-switch-approve');
                approve_switches.bootstrapToggle();
                approve_switches.change(function () {
                    var checked = $(this).prop('checked');
                    var subscription_id = $(this).data('approve-id');
                    if (checked) {
                        changeApprove(subscription_id, 1);
                    } else {
                        changeApprove(subscription_id, 0);
                    }
                })
            });

            // Change Approve AJAX
            function changeApprove(id, status) {
                $.ajax({
                    type: 'get',
                    url: '{!! url('admin/subscriptions/changeApprove') !!}/' + id + '/' + status,
                    success: function (data) {
                        if (data["status"] === "SUCCESS") {
                            if (status == 1) {
                                $('[data-approve-id="' + id + '"]').closest('tr').removeClass('default');
                                $('[data-approve-id="' + id + '"]').closest('tr').addClass('success');
                                showAlert("SUCCESS", "Subscription Approved");
                            } else {
                                $('[data-approve-id="' + id + '"]').closest('tr').removeClass('success');
                                $('[data-approve-id="' + id + '"]').closest('tr').addClass('default');
                                showAlert("SUCCESS", "Subscription change Approve");
                            }
                        } else {
                            showAlert("FAIL", "Error in Subscription Approve");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Error in Subscription Approve");
                    }
                });
            }
        </script>

@endsection