@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <h1>Users</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive table-pad">
                        <table class="table main-table">
                            <thead>
                            <tr class="info">
                                <th>#</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>Username</th>
                                <th>Mobile</th>
                                <th>Status</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr class="{{ $user->active?"success":"default" }}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>
                                        <input type="checkbox" {{ $user->active?"checked":"" }} class="toggle-switch"
                                               data-toggle="toggle" data-status-id="{{ $user->id }}" data-on="Active"
                                               data-off="Inactive" data-onstyle="success">
                                    </td>
                                    <td>
                                        <button class="btn btn-danger remove-user col-sm-8"
                                                data-delete-id="{{ $user->id }}">
                                            <span class="fa fas fa-trash"></span> Delete
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
                    </div>
                </div>
            </div>
        </div>


        @if(Session::has('action'))
            @if(Session::get('action')=="create")
                @if(Session::has('status_success'))
                    <script>showAlert("SUCCESS", "Agent creation successful");</script>
                @elseif(Session::has('status_error')))
                <script>showAlert("FAIL", "Agent creation fail");</script>
                @endif
            @elseif(Session::get('action')=="update")
                @if(Session::has('status_success'))
                    <script>showAlert("SUCCESS", "Agent update successful");</script>
                @elseif(Session::has('status_error')))
                <script>showAlert("FAIL", "Agent update fail");</script>
                @endif
            @endif

        @endif

        <script>
            // Remove User Confirmation
            $(document.body).on("click", ".remove-user", function () {
                var user_id = $(this).data('delete-id');
                showConfirm("DELETE", "Do you want to delete this User ?", "deleteUser(" + user_id + ")");
            });

            // Remove User AJAX
            function deleteUser(id) {
                $.ajax({
                    type: 'delete',
                    url: '{!! url('admin/users') !!}/' + id,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            $('[data-delete-id="' + id + '"]').closest('tr').remove();
                            showAlert("SUCCESS", "Delete User successful");
                        } else {
                            showAlert("FAIL", "Delete User fail");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Delete User fail");
                    }
                });
            }

            // Switch
            $(function () {
                var switches = $('.toggle-switch');
                switches.bootstrapToggle();
                switches.change(function () {
                    var checked = $(this).prop('checked');
                    var user_id = $(this).data('status-id');
                    if (checked) {
                        changeStatus(user_id, 1);
                    } else {
                        changeStatus(user_id, 0);
                    }
                })
            });

            // Change Status AJAX
            function changeStatus(id, status) {
                $.ajax({
                    type: 'get',
                    url: '{!! url('admin/users/changeStatus/') !!}/' + id + '/' + status,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            if (status == 1) {
                                $('[data-status-id="' + id + '"]').closest('tr').removeClass('default');
                                $('[data-status-id="' + id + '"]').closest('tr').addClass('success');
                                showAlert("SUCCESS", "Active User Status");
                            } else {
                                $('[data-status-id="' + id + '"]').closest('tr').removeClass('success');
                                $('[data-status-id="' + id + '"]').closest('tr').addClass('default');
                                showAlert("SUCCESS", "Inactive User Status");
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