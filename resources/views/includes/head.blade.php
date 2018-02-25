<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>DAPI</title>

<link href="{!! asset('css/font-awesome.css') !!}" rel="stylesheet">

<script src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
<script src="{!! asset('js/Moment.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('library/bootstrap-toggle-master/js/bootstrap-toggle.js') !!}"></script>
<script src="{!! asset('js/custom.js') !!}"></script>

<link href="{!! url('https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800') !!}" rel="stylesheet">
<link href="{!! asset('css/bootstrap.min.css') !!}" rel="stylesheet">
<link href="{!! asset('library/bootstrap-toggle-master/css/bootstrap-toggle.css') !!}" rel="stylesheet">
<link href="{!! asset('style.css') !!}" rel="stylesheet">

<!-- Alert Modal -->
<div class="modal fade reset-mdl" id="alert_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center" id="modal_display_icon">
                    {{--alert icon--}}
                </h5>

                <div class="text-center" id="modal_display_text">
                    {{--alert message--}}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showAlert(status,msg) {
        var icon='';
        var color='';
        if (status == "SUCCESS") {
            color = "green-text";
            icon = "fa-check-circle-o fa-5x";
        } else {
            color = "red-text";
            icon = "fa-times-circle-o fa-5x";
        }
        $("#modal_display_text").html('<h4 class="'+color+'">' + msg + '</h4>');
        $("#modal_display_icon").html('<i class="fa ' + icon + ' ' + color + ' text-center" class="close" data-dismiss="modal" aria-label="Close" aria-hidden="true"></i>');
        $('#alert_modal').modal('show');
        setTimeout(function () { $('#alert_modal').modal('hide')}, 3000);
    }
</script>
<!-- End Alert Modal -->

<!-- Confirm Modal -->
<div class="modal fade" id="confirm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center" id="confirm_modal_display_icon">
                    {{--confirm icon--}}
                </h5>
                <div class="text-center" id="confirm_modal_display_text">
                    {{--confirm message--}}
                </div>
                <div class="text-center" id="confirm_modal_display_buttons">
                    {{--confirm buttons--}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showConfirm(status,msg,callback) {
        var icon='';
        var color='';
        if (status == "DELETE") {
            color = "red-text";
            icon = "fa-times-circle-o fa-5x";

            $("#confirm_modal_display_text").html('<h4 class="'+color+'">' + msg + '</h4>');
            $("#confirm_modal_display_icon").html('<i class="fa ' + icon + ' ' + color + ' text-center" data-dismiss="modal" aria-label="Close" aria-hidden="true"></i>');
            $("#confirm_modal_display_buttons").html('<input class="btn btn-danger" onclick="'+callback+'" type="button" value="Delete" data-dismiss="modal"><input class="col-sm-offset-1 btn" type="button" value="Cancel" data-dismiss="modal">');
            $('#confirm_modal').modal('show');
        }
    }
</script>
<!-- End Confirm Alert Modal -->

@if(session()->has('action') && session()->has('status_success') && session()->has('alert_message'))
    <script>
        var alert_message = '{{ session()->get('alert_message') }}';
        {{ sessionClear(['action','status_success','alert_message']) }}
        showAlert("SUCCESS", alert_message);
    </script>
@elseif(session()->has('action') && session()->has('status_error') && session()->has('alert_message')))
<script>
    var alert_message = '{{ session()->get('alert_message') }}';
    {{ sessionClear(['action','status_success','alert_message']) }}
    showAlert("FAIL", alert_message);
</script>
@endif