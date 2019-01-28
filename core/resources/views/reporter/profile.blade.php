@extends('reporter.layout.app')
@section('contents')

    <h2 class=""> Profile Setting </h2>
    <div class="card">
        <legend class="text-center">
            <img src="{{ asset('assets/reporter/images/'.$reporter->profile_pic) }}" class="img-thumbnail text-right" alt="No Image">
        </legend>
        <div class="card-body">
            <form method="POST" action = "{{ route('reporter.updated.profile.submit') }}" enctype="multipart/form-data">
                @csrf
                @Method('put')
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">First name</label>
                        <input type="text" name="firstname" class="form-control is-valid form-control-lg"  placeholder="First Name" value="{{ $reporter->firstname }}">
                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServer02">Last name</label>
                        <input type="text" name="lastname" class="form-control is-valid form-control-lg"  placeholder="Last Name" value="{{ $reporter->lastname }}">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">Email</label>
                        <input type="text" name="email" class="form-control is-valid form-control-lg"  placeholder="Email" value="{{ $reporter->email }}">

                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServerUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" name="username" class="form-control is-invalid form-control-lg" placeholder="Username" value="{{ $reporter->username }}" aria-describedby="inputGroupPrepend3" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer02">Picture</label>
                        <input type="file" name="profile_pic" class="form-control form-control-lg" accept="image/*">

                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">Phone</label>
                        <input type="tel" name="phone" class="form-control is-valid form-control-lg"  placeholder="Phone Number" value="{{ $reporter->phone }}">

                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-4 mb-6">
                        <label for="validationServer02">Address</label>
                        <input type="text" name="address" class="form-control is-valid form-control-lg"  placeholder="Address" value="{{ $reporter->address }}">

                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer03">City</label>
                        <input type="text" name="city" value="{{ $reporter->city }}" class="form-control is-valid form-control-lg" placeholder="City">

                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer05">Country</label>
                        <input type="text" name="country" value="{{ $reporter->country }}" class="form-control is-valid form-control-lg" placeholder="Country Name">
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

@stop