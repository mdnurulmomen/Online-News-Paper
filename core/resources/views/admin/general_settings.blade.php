@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> General Settings </h2>
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold">
                Basic Information
            </div>
            <div class="card-body">
                <form method="post" action = "{{ route('admin.settings.general.submit') }}">
                    @csrf
                    @Method('put')
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label for="validationServer01">Title</label>
                            <input type="text" name="name" class="form-control is-valid" value="{{ $newsPaperName }}" required>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="validationServer02">Color</label>
                            <input type="text" name="color" value="{{ $color }}" class="form-control is-valid" onkeyup="backgroundColor()">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="validationServer02">Post Verification :</label>
                            <input type="checkbox" name="postverification" @if($postverification==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                        </div>
                        <div class="col-sm-3">
                            <label for="validationServer02">User Registration :</label>
                            <input type="checkbox" name="userregistration" @if($userRegistration==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                        </div>
                        <div class="col-md-3">
                            <label for="validationServer02">Email Verification :</label>
                            <input type="checkbox" name="emailverification" @if($emailverification==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                        </div>
                        <div class="col-md-3">
                            <label for="validationServer02">SMS Verification :</label>
                            <input type="checkbox" name="smsverification" @if($smsverification==1) checked @endif data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
    function backgroundColor () {
        var inputSelected = document.getElementsByName("color")[0];
        inputSelected.style.backgroundColor = document.getElementsByName("color")[0].value;
    }
    </script>
@stop