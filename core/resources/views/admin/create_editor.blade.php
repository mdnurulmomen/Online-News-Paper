@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Profile Setting </h2>
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Editor Creating Form
        </div>
        <div class="card-body">
            <form method="POST" action = "{{ route('admin.created.editor.submit') }}" enctype="multipart/form-data">
                @csrf
                @Method('put')
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">First name</label>
                        <input type="text" name="firstname" class="form-control is-valid"  placeholder="First Name">

                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServer02">Last name</label>
                        <input type="text" name="lastname" class="form-control is-valid"  placeholder="Last Name">

                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-4 mb-4">
                        <label for="validationServer01">Email</label>
                        <input type="text" name="email" class="form-control is-valid"  placeholder="Email">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServerUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" name="username" class="form-control is-invalid" placeholder="Username"  aria-describedby="inputGroupPrepend3">

                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer01">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Chosse a Suitable Password" required>
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer02">Picture</label>
                        <input type="file" name="picpath" class="form-control" accept="image/*">

                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">Phone</label>
                        <input type="tel" name="phone" class="form-control is-valid"  placeholder="Phone Number">

                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-4 mb-6">
                        <label for="validationServer02">Address</label>
                        <input type="text" name="address" class="form-control is-valid"  placeholder="Address">

                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer03">City</label>
                        <input type="text" name="city" class="form-control is-valid" placeholder="City">

                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer05">Country</label>
                        <input type="text" name="country" class="form-control is-valid" placeholder="Country Name">
                    </div>
                </div>
                <br>
                <fieldset class="form-group">
                    <div class="row">
                        <label class="col-form-label col-sm-2 pt-0">Categories Selection:</label>
                        <div class="col-sm-10">
                            @foreach($allCategories as $category)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="gridRadios1">
                                        <input type="checkbox" class="form-check-input" name="categories[]" value="{{$category->id}}">{{$category->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </fieldset>
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