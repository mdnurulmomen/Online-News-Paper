@extends('admin.layout.app')
@section('contents')

    <h2 class=""> Profile Setting </h2>
    <div class="card">
        <legend class="text-center">
            <img src="{{ asset('assets/editor/images/'.$editorToUpdate->profile_pic) }}" class="img-thumbnail text-right" alt="No Image">
        </legend>
        <div class="card-body">
            <form method="post" action = "{{ route('admin.edited_editor_submit', $editorToUpdate->id) }}" enctype="multipart/form-data">
                @csrf
                @Method('put')
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">First name</label>
                        <input type="text" name="firstname" class="form-control form-control-lg is-valid"  placeholder="First name" value="{{ $editorToUpdate->firstname }}">

                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServer02">Last name</label>
                        <input type="text" name="lastname" class="form-control form-control-lg is-valid"  placeholder="First name" value="{{ $editorToUpdate->lastname }}">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-6 mb-6">
                        <label for="validationServer01">Email</label>
                        <input type="text" name="email" class="form-control form-control-lg is-valid"  placeholder="Email" value="{{ $editorToUpdate->email }}">
                    </div>
                    <div class="col-md-6 mb-6">
                        <label for="validationServerUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" name="username" class="form-control form-control-lg is-invalid" placeholder="Username" value="{{ $editorToUpdate->username }}" aria-describedby="inputGroupPrepend3">

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
                        <input type="tel" name="phone" class="form-control is-valid form-control-lg"  placeholder="Phone Number" value="{{ $editorToUpdate->phone }}">
                    </div>
                </div>
                <br>
                <div class="form-row">
                    <div class="col-md-4 mb-6">
                        <label for="validationServer02">Address</label>
                        <input type="text" name="address" class="form-control form-control-lg is-valid"  placeholder="Address" value="{{ $editorToUpdate->address }}">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer03">City</label>
                        <input type="text" name="city" value="{{ $editorToUpdate->city }}" class="form-control form-control-lg is-valid" placeholder="City">

                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="validationServer05">Country</label>
                        <input type="text" name="country" value="{{ $editorToUpdate->country }}" class="form-control form-control-lg is-valid" placeholder="Zip">
                    </div>
                </div>
                <br>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2">Categories Selection:</legend>
                        <div class="col-sm-10">
                            @foreach($allCategories as $category)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label form-control-lg" for="gridRadios1">
                                        <input type="checkbox" class="form-check-input" name="categories[]" value="{{$category->id}}" @if(in_array($category->id, $editorToUpdate->editor_categories->pluck('id')->toArray())) checked @endif> {{$category->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </fieldset>
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