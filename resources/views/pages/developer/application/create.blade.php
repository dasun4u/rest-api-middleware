@extends('layouts.sidebar')

@section('content')
    <div class="col-sm-9 body-back">
        <form action="{{ url('/developer/applications') }}" method="post">
            {{ csrf_field() }}
            <h3 class="all-news">Create Application</h3>
            <div class="row min-pad">
                {{--Name--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="name">Name<span class="red-text">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" maxlength="50" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                {{--Token Validity--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="token_validity">Token Validity<span class="red-text">*</span> (seconds)</label>
                        <input type="text" id="token_validity" name="token_validity" class="form-control" value="{{ old('token_validity')!=''?old('token_validity'):86400 }}">
                        @if ($errors->has('token_validity'))
                            <span class="help-block">
                            <strong>{{ $errors->first('token_validity') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Description--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" maxlength="1000">{{ old('description')!=''?old('description'):'' }}</textarea>
                        @if($errors->has('description'))
                            <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Production Key--}}
                <div class="col-sm-12 box-wrap">
                    <div class="form-group">
                        <label for="production_key">Production Key<span class="red-text">*</span></label>
                        <input type="text" id="production_key" name="production_key" class="form-control"
                               maxlength="200" value="{{ old('production_key')!=''?old('production_key'):'' }}" readonly>
                        @if ($errors->has('production_key'))
                            <span class="help-block">
                            <strong>{{ $errors->first('production_key') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad">
                {{--Production Secret--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="production_secret">Production Secret<span class="red-text">*</span></label>
                        <input type="text" id="production_secret" name="production_secret" class="form-control"
                               maxlength="200" value="{{ old('production_secret')!=''?old('production_secret'):'' }}" readonly>
                        @if ($errors->has('production_secret'))
                            <span class="help-block">
                            <strong>{{ $errors->first('production_secret') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad form-btn-pad-left form-btn-pad-bottom">
                <button type="button" class="btn btn-primary" onclick="generateKeys('PRODUCTION')">Generate Production Keys</button>
            </div>
            <div class="row min-pad">
                {{--Sandbox Key--}}
                <div class="col-sm-12 box-wrap">
                    <div class="form-group">
                        <label for="sandbox_key">Sandbox Key<span class="red-text">*</span></label>
                        <input type="text" id="sandbox_key" name="sandbox_key" class="form-control" maxlength="200"
                               value="{{ old('sandbox_key')!=''?old('sandbox_key'):'' }}" readonly>
                        @if ($errors->has('sandbox_key'))
                            <span class="help-block">
                            <strong>{{ $errors->first('sandbox_key') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                </div>
            <div class="row min-pad">
                {{--Sandbox Secret--}}
                <div class="col-sm-6 box-wrap">
                    <div class="form-group">
                        <label for="sandbox_secret">Sandbox Secret<span class="red-text">*</span></label>
                        <input type="text" id="sandbox_secret" name="sandbox_secret" class="form-control"
                               maxlength="200" value="{{ old('sandbox_secret')!=''?old('sandbox_secret'):'' }}" readonly>
                        @if ($errors->has('sandbox_secret'))
                            <span class="help-block">
                            <strong>{{ $errors->first('sandbox_secret') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row min-pad form-btn-pad-left form-btn-pad-bottom">
                <button type="button" class="btn btn-primary" onclick="generateKeys('SANDBOX')">Generate Sandbox Keys</button>
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
        // generate keys
        function generateKeys(scope) {
            var upper_scope = scope.toUpperCase();
            $.ajax({
                type: 'get',
                url: '{!! url('developer/applications/generateKeys') !!}/' + upper_scope,
                success: function (data) {
                    if (data["status"] === "SUCCESS") {
                        if(upper_scope==="PRODUCTION"){
                            $("#production_key").val(data["key"]);
                            $("#production_secret").val(data["secret"]);
                            showAlert("SUCCESS", upper_scope+" token generate successful");
                        } else if(upper_scope==="SANDBOX") {
                            $("#sandbox_key").val(data["key"]);
                            $("#sandbox_secret").val(data["secret"]);
                            showAlert("SUCCESS", upper_scope+" token generate successful");
                        } else{
                            showAlert("FAIL", upper_scope+" token generate fail");
                        }

                    } else {
                        showAlert("FAIL", upper_scope+" token generate fail");
                    }
                }, error: function (data) {
                    showAlert("FAIL", upper_scope+" token generate fail");
                }
            });
        }
    </script>
@endsection