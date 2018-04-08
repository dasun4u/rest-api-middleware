@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-1">
                        <h1>Logs of Application - {{ $application->name }}</h1>
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
                                <th class="text-center">Download</th>
                                <th class="text-center">Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($log_files as $file)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $file->getFilename() }}</td>
                                    <td class="text-center">
                                        <a href="{{  url('admin/logs/logFileDownload?application_id='.$application->id.'&file_name='.$file->getFilename())}}">
                                            <button class="btn btn-warning" title="Download">
                                                <span class="fa fas fa-download"></span>
                                            </button>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger clear-log"
                                                data-clear-name="{{ $file->getFilename() }}"
                                                data-clear-application-id="{{ $application->id }}" title="Delete">
                                            <span class="fa fas fa-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No File Found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#date').select2();
            });
            // Clear Log Confirmation
            $(document.body).on("click", ".clear-log", function () {
                var application_id = $(this).data('clear-application-id');
                var file_name = $(this).data('clear-name');
                showConfirm("DELETE", "Do you want to delete this log file ?", "deleteLogFileByName(" + application_id + ",'" + file_name + "')");
            });

            // Clear Log AJAX
            function deleteLogFileByName(application_id, file_name) {
                $.ajax({
                    type: 'delete',
                    url: '{!! url('admin/logs/deleteLogFileByName') !!}?application_id='+application_id+'&file_name=' + file_name,
                    success: function (data) {
                        if (data["status"] == "SUCCESS") {
                            $('[data-clear-name="' + file_name + '"]').closest('tr').remove();
                            showAlert("SUCCESS", "Clear log file successful");
                        } else {
                            showAlert("FAIL", "Clear log file fail");
                        }
                    }, error: function (data) {
                        showAlert("FAIL", "Clear log file fail");
                    }
                });
            }
        </script>

@endsection