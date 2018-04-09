@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <h1>Services</h1>
                    </div>
                    <div class="col-sm-4 btn-div-pad">
                        <a href="{{ url('/admin/services/create') }}">
                            <button class="btn btn-success pull-right">Create new Service</button>
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
                                <th>Service Group</th>
                                <th>Method</th>
                                <th>Created Time</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Approve</th>
                                <th class="text-center" colspan="3">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($services as $service)
                                <tr class="{{ $service->active?"success":"default" }}">
                                    <td>{{ $service->id }}</td>
                                    <td>{{ $service->name }}</td>
                                    <td>{{ $service->group->name }}</td>
                                    <td>{{ $service->method }}</td>
                                    <td>{{ \Carbon\Carbon::parse($service->created_at)->toDateTimeString() }}</td>
                                    <td>
                                        <input type="checkbox"
                                               {{ $service->active?"checked":"" }} class="toggle-switch-active"
                                               data-toggle="toggle" data-status-id="{{ $service->id }}"
                                               data-on="Active"
                                               data-off="Inactive" data-onstyle="success">
                                    </td>
                                    <td>
                                        <input type="checkbox"
                                               {{ $service->approved?"checked":"" }} class="toggle-switch-approve"
                                               data-toggle="toggle" data-approve-id="{{ $service->id }}"
                                               data-on="Approved"
                                               data-off="Not Approved" data-onstyle="success">
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/services/'.$service->id) }}">
                                            <button class="btn btn-primary" title="Show">
                                                <span class="fa fas fa-eye"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/services/'.$service->id.'/edit') }}">
                                            <button class="btn btn-warning" title="Edit">
                                            <span class="fa fas fa-pencil"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger remove-service"
                                                data-delete-id="{{ $service->id }}" title="Delete">
                                            <span class="fa fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No Services Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script>
            // Remove Group Confirmation
            $(document.body).on("click", ".remove-service", function () {
                var service_id = $(this).data('delete-id');
                showConfirm("DELETE", "Do you want to delete this Service ?", "deleteService(" + service_id + ")");
            });

            // Remove Service AJAX
            function deleteService(id) {
                $.ajax({
                    type: 'delete',
                    url: '{!! url('admin/services') !!}/' + id,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            $('[data-delete-id="' + id + '"]').closest('tr').remove();
                            showAlert("SUCCESS", "Delete Service successful");
                        } else {
                            showAlert("FAIL", "Delete Service fail");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Delete Service fail");
                    }
                });
            }

            // Active Switch
            $(function () {
                var active_switches = $('.toggle-switch-active');
                active_switches.bootstrapToggle();
                active_switches.change(function () {
                    var checked = $(this).prop('checked');
                    var service_id = $(this).data('status-id');
                    if (checked) {
                        changeStatus(service_id, 1);
                    } else {
                        changeStatus(service_id, 0);
                    }
                })
            });

            // Change Status AJAX
            function changeStatus(id, status) {
                $.ajax({
                    type: 'get',
                    url: '{!! url('admin/services/changeStatus/') !!}/' + id + '/' + status,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            if (status == 1) {
                                $('[data-status-id="' + id + '"]').closest('tr').removeClass('default');
                                $('[data-status-id="' + id + '"]').closest('tr').addClass('success');
                                showAlert("SUCCESS", "Active Service Status");
                            } else {
                                $('[data-status-id="' + id + '"]').closest('tr').removeClass('success');
                                $('[data-status-id="' + id + '"]').closest('tr').addClass('default');
                                showAlert("SUCCESS", "Inactive Service Status");
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
                    var service_id = $(this).data('approve-id');
                    if (checked) {
                        changeApprove(service_id, 1);
                    } else {
                        changeApprove(service_id, 0);
                    }
                })
            });

            // Change Approve AJAX
            function changeApprove(id, status) {
                $.ajax({
                    type: 'get',
                    url: '{!! url('admin/services/changeApprove') !!}/' + id + '/' + status,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            if (status == 1) {
                                showAlert("SUCCESS", "Service Approved");
                            } else {
                                showAlert("SUCCESS", "Service change Approve");
                            }
                        } else {
                            showAlert("FAIL", "Error in Service Approve");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Error in Service Approve");
                    }
                });
            }
        </script>

@endsection