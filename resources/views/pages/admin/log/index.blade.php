@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <h1>Logs</h1>
                    </div>
                    <div class="col-sm-4 btn-div-pad"></div>
                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive table-pad">
                        <table class="table main-table">
                            <thead>
                            <tr class="info">
                                <th>#</th>
                                <th>Name</th>
                                <th class="text-center">Active</th>
                                <th class="text-center">Approve</th>
                                <th class="text-center">Daily Log File Count</th>
                                <th class="text-center" colspan="2">Options</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($applications as $application)
                                <tr class="{{ $application->active?"success":"default" }}">
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->name }}</td>
                                    <td class="text-center">{{ $application->active?"Active":"Inactive" }}</td>
                                    <td class="text-center">{{ $application->approved?"Approved":"Not Approved" }}</td>
                                    <td class="text-center log_count">{{ $application->log_count }}</td>
                                    <td>
                                        <a {!! ($application->log_count==0)?'':'href="'.url('admin/logs/application/'.$application->id).'"' !!}} class="show_log_anchor">
                                            <button class="btn btn-primary show_log_btn" title="Show" {{ ($application->log_count==0)?"disabled":"" }}>
                                            <span class="fa fas fa-eye"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger clear-log"
                                                data-clear-id="{{ $application->id }}" title="Delete">
                                            <span class="fa fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Applications Found</td>
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
            // Clear Log Confirmation
            $(document.body).on("click", ".clear-log", function () {
                var application_id = $(this).data('clear-id');
                showConfirm("DELETE", "Do you want to clear all daily log files ?", "deleteDailyLogsByApplicationId(" + application_id + ")");
            });

            // Clear Log AJAX
            function deleteDailyLogsByApplicationId(id) {
                $.ajax({
                    type: 'delete',
                    url: '{!! url('admin/logs/deleteDailyLogsByApplicationId') !!}/' + id,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            $('[data-clear-id="' + id + '"]').closest('tr').find('.log_count').html("0");
                            $('[data-clear-id="' + id + '"]').closest('tr').find('.show_log_btn').attr("disabled", true);
                            $('[data-clear-id="' + id + '"]').closest('tr').find('.show_log_anchor').removeAttr("href");
                            showAlert("SUCCESS", "Clear daily log files successful");
                        } else {
                            showAlert("FAIL", "Clear log files fail");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Clear log files fail");
                    }
                });
            }
        </script>

@endsection