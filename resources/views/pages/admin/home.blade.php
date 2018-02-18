@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
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
                                                               href="{{ url('admin/users') }}">View More</a>
                                                        </td>
                                                    </tr>
                                                    @break
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">All Users are in active state
                                                    </td>
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
                                                               href="{{ url('admin/applications') }}">View More</a>
                                                        </td>
                                                    </tr>
                                                    @break
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">All Users are in active state
                                                    </td>
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
