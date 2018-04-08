@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <h1>Users</h1>
                    </div>
                    <div class="col-sm-4 btn-div-pad">
                        <a href="{{ url('/admin/users/create') }}">
                            <button class="btn btn-success pull-right">Create New User</button>
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th class="text-center">Active</th>
                                <th class="text-center" colspan="3">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($users as $user)
                                <tr class="{{ $user->active?"success":"default" }}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name ." ". $user->last_name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td>
                                        <input type="checkbox" {{ $user->active?"checked":"" }} class="toggle-switch"
                                               data-toggle="toggle" data-status-id="{{ $user->id }}" data-on="Active"
                                               data-off="Inactive" data-onstyle="success">
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/users/'.$user->id) }}">
                                            <button class="btn btn-primary" title="Show">
                                                <span class="fa fas fa-eye"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/users/'.$user->id.'/edit') }}">
                                            <button class="btn btn-warning" title="Edit">
                                                <span class="fa fas fa-pencil"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger remove-user"
                                                data-delete-id="{{ $user->id }}" title="Delete"><span
                                                    class="fa fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">No Users Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            var change_row = $('[data-status-id="' + id + '"]').closest('tr');
                            if (status == 1) {
                                change_row.removeClass('default');
                                change_row.addClass('success');
                                showAlert("SUCCESS", "Active User Status");
                            } else {
                                change_row.removeClass('success');
                                change_row.addClass('default');
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