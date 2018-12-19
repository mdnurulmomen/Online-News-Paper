
@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Profile Setting </h2>
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Profile Updating Form
        </div>
        <div class="card-body">
            <form method="POST" action = "{{ route('admin.createdReporterSubmit') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Editor Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="editorName" class="form-control" placeholder="Full Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="editorUserName" class="form-control" placeholder="Username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" name="editorPassword" class="form-control" placeholder="Chosse a Suitable Password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" name="reporterEmail" class="form-control" placeholder="Email Address">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone / Mobile:</label>
                    <div class="col-sm-10">
                        <input type="tel" name="reporterPhone" class="form-control" placeholder="Phone or Mobile Number">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputAddress2" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" name="reporterAddress" class="form-control" placeholder="Apartment, studio, or floor">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-md-4">
                        <label for="inputCity" class="col-sm-2 col-form-label">City</label>
                        <input type="text" name="reporterCity" class="form-control" placeholder="City Name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState" class="col-sm-2 col-form-label">State</label>
                        <input type="text" name="reporterState" class="form-control" placeholder="State Name">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip" class="col-sm-2 col-form-label">Country</label>
                        <input type="text" name="reporterCountry" class="form-control" placeholder="Country Name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-block btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop