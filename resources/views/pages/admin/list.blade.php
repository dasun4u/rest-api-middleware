@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <h1>Dashboard</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="panel panel-info">
                                <div class="panel-heading">User accounts to Approve</div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="success">
                                                <th>#</th>
                                                <th>First name</th>
                                                <th>Last name</th>
                                                <th>Username</th>
                                                <th>Mobile</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($users as $user)
                                                @if($loop->index<5)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->first_name }}</td>
                                                        <td>{{ $user->last_name }}</td>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ $user->mobile }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <a class="btn btn-primary pull-right"
                                                               href="{{ url('users') }}">View More</a>
                                                        </td>
                                                    </tr>
                                                    @break
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">All Users are in active state</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="panel panel-info">
                                <div class="panel-heading">Applications to Approve</div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="success">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Date / Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($applications as $application)
                                                @if($loop->index<5)
                                                    <tr>
                                                        <td>{{ $application->id }}</td>
                                                        <td>{{ $application->name }}</td>
                                                        <td>{{ str_limit($application->description, 50) }}</td>
                                                        <td>{{ $application->created_at }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="5">
                                                            <a class="btn btn-primary pull-right"
                                                               href="{{ url('applications') }}">View More</a>
                                                        </td>
                                                    </tr>
                                                    @break
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">All Users are in active state</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="panel panel-info">
                                <div class="panel-heading">Subscriptions</div>
                                <div class="panel-body">Panel Content</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@if(Session::has('action'))
        @if(Session::get('action')=="create")
            @if(Session::has('status_success'))
                <script>showAlert("SUCCESS","Agent creation successful");</script>
            @elseif(Session::has('status_error')))
            <script>showAlert("FAIL","Agent creation fail");</script>
            @endif
        @elseif(Session::get('action')=="update")
            @if(Session::has('status_success'))
                <script>showAlert("SUCCESS","Agent update successful");</script>
            @elseif(Session::has('status_error')))
            <script>showAlert("FAIL","Agent update fail");</script>
            @endif
        @endif

    @endif

    <script>

        $(document).ready(function(){
            $('#feature_table').dataTable({
                "columnDefs": [
                    {"className": "dt-center", "targets": "_all"}
                ],
                processing: true,
                serverSide: true,
                ajax : '{!! url('/load-agents') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });

        $(document.body).on("click",".remove-agent", function () {

            var agent_id = $(this).data('id');
            showConfirm("DELETE", "Do you want to delete this Agent ?","deleteAgent("+agent_id+")");
        });

        function deleteAgent(id){
            $.ajax({
                type: 'get',
                url: '{!! url('delete-agent') !!}',
                data: {agent_id: id},
                success: function (data) {
                    if (data == "SUCCESS") {
                        $('[data-id="' + id + '"]').closest('tr').remove();
                        showAlert("SUCCESS","Delete Agent successful");
                    }
                }, error: function (data) {

                    showAlert("FAIL","Delete Agent fail");
                }
            });
        }
    </script>

@endsection