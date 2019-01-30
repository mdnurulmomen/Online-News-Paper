@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> Media Settings </h2>
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold">
                Media Information
            </div>
            <div class="card-body">
                <form method="post" action = "{{ route('admin.settings_media_submit') }}" enctype="multipart/form-data">
                    @csrf
                    @Method('put')
                    <div class="form-row row">
                        <div class="col-md-6 mb-6">
                            <label class="col-form-label" for="validationServer01">Logo</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$settings->logo) }}" class="img-thumbnail" alt="No Image"> 
                            </div>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="col-form-label" for="validationServer02">Default Icon:</label>
                            <div>
                                <img src="{{ asset('assets/front/images/setting/'.$settings->default_icon) }}" class="img-thumbnail" alt="No Image">
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label class="col-form-label" for="validationServer01">Upload New Logo</label>
                            <input type="file" name="logo" class="form-control form-control-lg" accept="image/*">
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="col-form-label" for="validationServer02">Upload New Icon:</label>
                            <input type="file" name="default_icon" class="form-control form-control-lg" accept="image/*">
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label class="col-form-label" for="validationServer02">News Verification :</label>
                            <input type="checkbox" name="news_verification" @if($settings->news_verification==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                        </div>
                        <div class="col-sm-3">
                            <label class="col-form-label" for="validationServer02">User Registration :</label>
                            <input type="checkbox" name="user_registration" @if($settings->user_registration==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label" for="validationServer02">Email Verification :</label>
                            <input type="checkbox" name="email_verification" @if($settings->email_verification==1) checked @endif  data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                        </div>
                        <div class="col-md-3">
                            <label class="col-form-label" for="validationServer02">SMS Verification :</label>
                            <input type="checkbox" name="sms_verification" @if($settings->sms_verification==1) checked @endif data-toggle="toggle" data-on="Allowed" data-off="Not Allowed" data-onstyle="success" data-offstyle="danger">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-block btn-lg btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@stop