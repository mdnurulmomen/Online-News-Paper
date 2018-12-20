
@extends('editor.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Profile Setting </h2>
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Profile Updating Form
        </div>
        <div class="card-body">
            <form method="POST" action = "{{ route('editor.updatedProfileSubmit') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">First Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="firstName" class="form-control"  value="{{ $firstname }}" style="text-transform: capitalize;" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Last Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="lastName" class="form-control"  value="{{ $lastname }}" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Username:</label>
                    <div class="col-sm-10">
                        <input type="text" name="userName" class="form-control"  value="{{ $username }}" style="text-transform: capitalize;" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" class="form-control"  value="{{ $email }}" style="text-transform: capitalize;">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Profile Picture:</label>
                    <div class="col-sm-10">
                        <!--asset path always counts from index.php (usually inside public) -->
                        <img src="{{ asset('assets/editor/images/'.$picpath) }}" class="img-thumbnail" alt="No Image">
                        <input type="file" name="profilePic" accept="image/*">
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