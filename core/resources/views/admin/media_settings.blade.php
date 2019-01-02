@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> Media Settings </h2>
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold">
                Media Information
            </div>
            <div class="card-body">
                <form method="post" action = "{{ route('admin.settings.media.submit') }}" enctype="multipart/form-data">
                    @csrf
                    @Method('put')
                    <div class="row text-center">
                        <div class="col-md-6 mb-">
                            <label for="validationServer01">Logo</label>
                            <img src="{{ asset('assets/front/images/'.$logo) }}" class="img-thumbnail text-left" alt="No Image">
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="validationServer02">Default Icon:</label>
                            <img src="{{ asset('assets/front/images/'.$defaultIcon) }}" class="img-thumbnail text-right" alt="No Image">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label for="validationServer01">Upload New Logo</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="validationServer02">Upload New Icon:</label>
                            <input type="file" name="defaultIcon" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="validationServer02">Post Verification :</label>
                            <input type="checkbox" name="newsverification" @if($newsverification==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
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
@stop