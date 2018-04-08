@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <form action="{{ url('/developer/subscriptions') }}" method="post">
            {{ csrf_field() }}
            <h3 class="all-news">New Subscription</h3>
            <div class="row min-pad">
                {{--Application--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="application">Application<span class="red-text">*</span></label>
                        <select name="application" id="application" class="form-control">
                            @forelse($applications as $application)
                                <option value="{{ $application->id }}" {{ old('application')==$application->id?"selected":"" }}>{{ $application->name }}</option>
                            @empty
                                <option value="">--No Application--</option>
                            @endforelse
                        </select>
                        @if ($errors->has('application'))
                            <span class="help-block">
                            <strong>{{ $errors->first('application') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Service Group--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="service_group">Service Group</label>
                        <select name="service_group" id="service_group" class="form-control" onchange="changeServiceGroup()">
                            @if(count($service_groups)>0)
                                <option value="0">-- All --</option>
                            @endif
                            @forelse($service_groups as $service_group)
                                <option value="{{ $service_group->id }}" {{ old('service_group')==$service_group->id?"selected":"" }}>{{ $service_group->name }}</option>
                            @empty
                                <option value="">--No Service Groups--</option>
                            @endforelse
                        </select>
                        @if ($errors->has('service_group'))
                            <span class="help-block">
                            <strong>{{ $errors->first('service_group') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Services--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="service">Service<span class="red-text">*</span></label>
                        <select name="service" id="service" class="form-control">
                            @if(count($services)>0)
                                <option value="0">-- All --</option>
                            @endif
                            @forelse($services as $service)
                                <option value="{{ $service->id }}" {{ old('service')==$service->id?"selected":"" }}>{{ $service->name }}</option>
                            @empty
                                <option value="">--No Services--</option>
                            @endforelse
                        </select>
                        @if ($errors->has('service'))
                            <span class="help-block">
                            <strong>{{ $errors->first('service') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row form-btn-pad-left form-btn-pad-bottom">
                <div class="col-sm-12">
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Create"/>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#application').select2();
            $('#service_group').select2();
            $('#service').select2();
        });


        // Change Service Group AJAX
        function changeServiceGroup() {
            var group_id = $("#service_group").val();
            $.ajax({
                type: 'get',
                url: '{!! url('developer/serviceGroups/getServicesByGroupID') !!}/' + group_id ,
                success: function (data) {
                    if (data["status"] === "SUCCESS") {
                        var service_options ='';
                        if(data["data"].length>0){
                            service_options = '<option value="0">-- All --</option>';
                        } else {
                            service_options = '<option value="">--No Services--</option>';
                        }
                        $.each(data["data"],function (index,value) {
                            service_options+='<option value="'+value.id+'">'+value.name+'</option>'
                        });
                        $("#service").html(service_options);
                    } else {
                        showAlert("FAIL", "Error in Service Loading");
                    }
                }, error: function (data) {
                    showAlert("FAIL", "Error in Service Loading");
                }
            });
        }
    </script>
@endsection
