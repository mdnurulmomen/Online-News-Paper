@extends('reporter.layout.app')
@section('contents')

    <h2 class=""> Profile Setting </h2>
    <div class="card">
        <legend class="text-center">
            <img src="{{ asset('assets/reporter/images/'.$reporterToUpdate->picpath) }}" class="img-thumbnail text-right" alt="No Image">
        </legend>
        <div class="card-body">
            <form method="POST" action = "{{ route('admin.edited.reporter.submit', $reporterToUpdate->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Full Name:</label>
                    <div class="col-sm-5">
                        <input type="text" name="firstname" value="{{ $reporterToUpdate->firstname }}" class="form-control">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="lastname" value="{{ $reporterToUpdate->lastname }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" value="{{ $reporterToUpdate->username }}" class="form-control" placeholder="Username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{ $reporterToUpdate->email }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Upload New Picture:</label>
                    <div class="col-sm-10">
                        <input type="file" name="picpath" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone / Mobile:</label>
                    <div class="col-sm-10">
                        <input type="tel" name="phone" value="{{ $reporterToUpdate->phone }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputAddress2" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" value="{{ $reporterToUpdate->address }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-md-4">
                        <label for="inputCity" class="col-sm-2 col-form-label">City</label>
                        <input type="text" name="city" value="{{ $reporterToUpdate->city }}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState" class="col-sm-2 col-form-label">State</label>
                        <input type="text" name="state" value="{{ $reporterToUpdate->state }}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip" class="col-sm-2 col-form-label">Country</label>
                        <input type="text" name="country" value="{{ $reporterToUpdate->country }}" class="form-control">
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

@stop