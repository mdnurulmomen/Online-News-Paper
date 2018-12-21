@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> General Settings </h2>
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold">
                Basic Information
            </div>
            <div class="card-body">
                <form method="post" action = "{{ route('admin.settingsGeneralSubmit') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Title:</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" style="text-transform: capitalize;"  value="{{ $newsPaperName }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Color:</label>
                        <div class="col-sm-1">
                            <input type="color" name="color" value="{{ $color }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Post Verification :</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" name="registration" @if($postverification==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">User Registration :</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" name="registration" @if($userRegistration==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Email Verification :</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" name="emailverification" @if($emailverification==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">SMS Verification :</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input type="checkbox" name="smsverification" @if($smsverification==1) checked @endif data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop