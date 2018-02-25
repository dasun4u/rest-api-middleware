@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <h1>Applications</h1>
                    </div>
                    <div class="col-sm-4 btn-div-pad">
                        <a href="{{ url('/admin/applications/create') }}">
                            <button class="btn btn-success pull-right">Create new Application</button>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive table-pad">
                        <table class="table main-table">
                            <thead>
                            <tr class="info">
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created By</th>
                                <th>Created Time</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Approve</th>
                                <th class="text-center" colspan="3">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($applications as $application)
                                <tr class="{{ $application->active?"success":"default" }}">
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->name }}</td>
                                    <td>{{ str_limit($application->description,50) }}</td>
                                    <td>{{ $application->createdBy->username }}</td>
                                    <td>{{ \Carbon\Carbon::parse($application->created_at)->toDateTimeString() }}</td>
                                    <td>
                                        <input type="checkbox"
                                               {{ $application->active?"checked":"" }} class="toggle-switch-active"
                                               data-toggle="toggle" data-status-id="{{ $application->id }}"
                                               data-on="Active"
                                               data-off="Inactive" data-onstyle="success">
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                               {{ $application->approved?"checked":"" }} class="toggle-switch-approve"
                                               data-toggle="toggle" data-approve-id="{{ $application->id }}"
                                               data-on="Approved"
                                               data-off="Not Approved" data-onstyle="success">
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/applications/'.$application->id) }}">
                                            <button class="btn btn-primary" title="Show">
                                            <span class="fa fas fa-eye"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/applications/'.$application->id.'/edit') }}">
                                            <button class="btn btn-warning" title="Edit">
                                            <span class="fa fas fa-pencil"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger remove-application"
                                                data-delete-id="{{ $application->id }}" title="Delete">
                                            <span class="fa fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Users Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $applications->links() }}
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Remove Application Confirmation
            $(document.body).on("click", ".remove-application", function () {
                var application_id = $(this).data('delete-id');
                showConfirm("DELETE", "Do you want to delete this Application ?", "deleteApplication(" + application_id + ")");
            });

            // Remove Application AJAX
            function deleteApplication(id) {
                $.ajax({
                    type: 'delete',
                    url: '{!! url('admin/applications') !!}/' + id,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            $('[data-delete-id="' + id + '"]').closest('tr').remove();
                            showAlert("SUCCESS", "Delete Application successful");
                        } else {
                            showAlert("FAIL", "Delete Application fail");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Delete Application fail");
                    }
                });
            }

            // Active Switch
            $(function () {
                var active_switches = $('.toggle-switch-active');
                active_switches.bootstrapToggle();
                active_switches.change(function () {
                    var checked = $(this).prop('checked');
                    var application_id = $(this).data('status-id');
                    if (checked) {
                        changeStatus(application_id, 1);
                    } else {
                        changeStatus(application_id, 0);
                    }
                })
            });

            // Change Status AJAX
            function changeStatus(id, status) {
                $.ajax({
                    type: 'get',
                    url: '{!! url('admin/applications/changeStatus/') !!}/' + id + '/' + status,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            if (status == 1) {
                                $('[data-status-id="' + id + '"]').closest('tr').removeClass('default');
                                $('[data-status-id="' + id + '"]').closest('tr').addClass('success');
                                showAlert("SUCCESS", "Active Application Status");
                            } else {
                                $('[data-status-id="' + id + '"]').closest('tr').removeClass('success');
                                $('[data-status-id="' + id + '"]').closest('tr').addClass('default');
                                showAlert("SUCCESS", "Inactive Application Status");
                            }
                        } else {
                            showAlert("FAIL", "Change status fail");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Change status fail");
                    }
                });
            }

            // Approve Switch
            $(function () {
                var approve_switches = $('.toggle-switch-approve');
                approve_switches.bootstrapToggle();
                approve_switches.change(function () {
                    var checked = $(this).prop('checked');
                    var application_id = $(this).data('approve-id');
                    if (checked) {
                        changeApprove(application_id, 1);
                    } else {
                        changeApprove(application_id, 0);
                    }
                })
            });

            // Change Approve AJAX
            function changeApprove(id, status) {
                $.ajax({
                    type: 'get',
                    url: '{!! url('admin/applications/changeApprove/') !!}/' + id + '/' + status,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            if (status == 1) {
                                showAlert("SUCCESS", "Application Approved");
                            } else {
                                showAlert("SUCCESS", "Application Status");
                            }
                        } else {
                            showAlert("FAIL", "Error in Application Approve");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Error in Application Approve");
                    }
                });
            }

        </script>

@endsection