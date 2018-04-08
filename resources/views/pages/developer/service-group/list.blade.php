@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <h1>Service Groups</h1>
                    </div>
                    <div class="col-sm-4 btn-div-pad">
                        <a href="{{ url('developer/serviceGroups/create') }}">
                            <button class="btn btn-success pull-right">Create new Service Group</button>
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
                                <th>Context</th>
                                <th>Created Time</th>
                                <th class="text-center">Active</th>
                                <th class="text-center" colspan="3">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($groups as $group)
                                <tr class="{{ $group->active?"success":"default" }}">
                                    <td>{{ $group->id }}</td>
                                    <td>{{ $group->name }}</td>
                                    <td>{{ $group->context }}</td>
                                    <td>{{ \Carbon\Carbon::parse($group->created_at)->toDateTimeString() }}</td>
                                    <td>
                                        <input type="checkbox"
                                               {{ $group->active?"checked":"" }} class="toggle-switch-active"
                                               data-toggle="toggle" data-status-id="{{ $group->id }}"
                                               data-on="Active"
                                               data-off="Inactive" data-onstyle="success">
                                    </td>
                                    <td>
                                        <a href="{{ url('developer/serviceGroups/'.$group->id) }}">
                                            <button class="btn btn-primary" title="Show">
                                                <span class="fa fas fa-eye"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('developer/serviceGroups/'.$group->id.'/edit') }}">
                                            <button class="btn btn-warning" title="Edit">
                                            <span class="fa fas fa-pencil"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger remove-group"
                                                data-delete-id="{{ $group->id }}" title="Delete">
                                            <span class="fa fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No API groups Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $groups->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

        <script>
            // Remove Group Confirmation
            $(document.body).on("click", ".remove-group", function () {
                var group_id = $(this).data('delete-id');
                showConfirm("DELETE", "Do you want to delete this Service Group ?", "deleteGroup(" + group_id + ")");
            });

            // Remove Application AJAX
            function deleteGroup(id) {
                $.ajax({
                    type: 'delete',
                    url: '{!! url('developer/serviceGroups') !!}/' + id,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            $('[data-delete-id="' + id + '"]').closest('tr').remove();
                            showAlert("SUCCESS", "Delete Group successful");
                        } else {
                            showAlert("FAIL", "Delete Group fail");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Delete Group fail");
                    }
                });
            }

            // Active Switch
            $(function () {
                var active_switches = $('.toggle-switch-active');
                active_switches.bootstrapToggle();
                active_switches.change(function () {
                    var checked = $(this).prop('checked');
                    var group_id = $(this).data('status-id');
                    if (checked) {
                        changeStatus(group_id, 1);
                    } else {
                        changeStatus(group_id, 0);
                    }
                })
            });

            // Change Status AJAX
            function changeStatus(id, status) {
                $.ajax({
                    type: 'get',
                    url: '{!! url('developer/serviceGroups/changeStatus/') !!}/' + id + '/' + status,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            var change_row = $('[data-status-id="' + id + '"]').closest('tr');
                            if (status == 1) {
                                change_row.removeClass('default');
                                change_row.addClass('success');
                                showAlert("SUCCESS", "Active Application Status");
                            } else {
                                change_row.removeClass('success');
                                change_row.addClass('default');
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
        </script>

@endsection