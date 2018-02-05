@extends('layouts.cms.sidebar')
@section('content')
    <style>
        #thumbwrap {
            position:relative;
        //margin:75px auto;
            width:40px; height:40px;
        }
        .thumb img {
            border:1px solid #000;
            margin:3px;
            float:left;
        }
        .thumb span {
            position:absolute;
            visibility:hidden;
        }
        .thumb:hover, .thumb:hover span {
            visibility:visible;
            top:0; left:250px;
            z-index:1;
        }
    </style>

    <div class="col-sm-9 body-back">
        <div class="col-sm-12 content-pad">
            <div class="col-sm-12 con-pad-main">
                <div class="row">
                    <div class="col-sm-4 col-xs-4 xs-prom-pad">
                        <h4 class="xs-center list_title qr-lbl">Agents</h4>
                    </div>
                    <div class="col-sm-12 text-right">
                        <a href="{{ url('/agents/create') }}" class="btn btn-success">
                            Create Agent
                        </a>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12 table-responsive tbl-main-pad col-sm-offset-0 col-xs-10 col-xs-offset-1">
                        <table class="table table-striped datatable list_table" id="feature_table">
                            <thead>
                            <tr class="list_table_va">
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Contact Number</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

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