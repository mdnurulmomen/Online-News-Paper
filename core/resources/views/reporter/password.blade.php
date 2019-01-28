
@extends('reporter.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> Password Setting </h2>
        <div class="card mb-4">
            <div class="card-body">
                <form method="post" action = "{{ route('reporter.updated.password.submit') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="validationServer02" class="col-sm-2 col-form-label"> Current Password: </label>
                        <div class="col-sm-10">
                            <input type="password" name="currentPassword" class="form-control form-control-lg" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="validationServer02" class="col-sm-2 col-form-label"> New Password: </label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control form-control-lg"  required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="validationServer02" class="col-sm-2 col-form-label"> Confirm Password: </label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" class="form-control form-control-lg"  required>
                        </div>
                    </div>
                    <br>
                    <br>
                    
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-bg btn-block btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop