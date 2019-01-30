
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset('assets/user/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/bootadmin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/user/css/toastr.min.css') }}">

    <script src="{{ asset('assets/user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/user/js/toastr.min.js') }}"></script>


    <title>Create User</title>
</head>
<body class="bg-light">

<div class="d-flex">

    <div class="content p-4">
        <h2 class="mb-4"> Profile Setting </h2>
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold">
                User Create Form
            </div>
            <div class="card-body">
                <form method="POST" action = "{{ route('user.register_submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label for="validationServer01">First name</label>
                            <input type="text" name="firstname" class="form-control form-control-lg is-valid"  placeholder="First Name">

                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="validationServer02">Last name</label>
                            <input type="text" name="lastname" class="form-control form-control-lg is-valid"  placeholder="Last Name">

                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            <label for="validationServer01">Email</label>
                            <input type="text" name="email" class="form-control form-control-lg is-valid"  placeholder="Email">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="validationServerUsername">Username</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="text" name="username" class="form-control form-control-lg is-invalid" placeholder="Username"  aria-describedby="inputGroupPrepend3">

                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="validationServer01">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Chosse a Suitable Password" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-md-6 mb-6">
                            <label for="validationServer02">Address</label>
                            <input type="text" name="address" class="form-control form-control-lg is-valid"  placeholder="Address">

                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="validationServer01">Phone</label>
                            <input type="tel" name="phone" class="form-control form-control-lg is-valid"  placeholder="Phone Number">

                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-md-6 mb-4">
                            <label for="validationServer03">City</label>
                            <input type="text" name="city" class="form-control form-control-lg is-valid" placeholder="City">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label for="validationServer05">Country</label>
                            <input type="text" name="country" class="form-control form-control-lg is-valid" placeholder="Country Name">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-block btn-bg btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
