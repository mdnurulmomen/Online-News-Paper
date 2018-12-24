@extends('editor.layout.app')
@section('contents')

    <h2 class=""> Profile Setting </h2>
    <div class="card">
        <legend class="text-center">
            <img src="{{ asset('assets/editor/images/'.$editorToUpdate->picpath) }}" class="img-thumbnail text-right" alt="No Image">
        </legend>
        <div class="card-body">
            <form method="POST" action = "{{ route('admin.edited.editor.submit', $editorToUpdate->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Full Name:</label>
                    <div class="col-sm-5">
                        <input type="text" name="firstname" value="{{ $editorToUpdate->firstname }}" class="form-control">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="lastname" value="{{ $editorToUpdate->lastname }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" value="{{ $editorToUpdate->username }}" class="form-control" placeholder="Username" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" value="{{ $editorToUpdate->email }}" class="form-control">
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Categories Selection:</legend>
                        <div class="col-sm-10">
                            @foreach($allCategories as $category)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="gridRadios1">
                                        <input type="checkbox" class="form-check-input" name="categories[]" value="{{$category->id}}" @if(in_array($category->id, $editorToUpdate->editor_categories->pluck('id')->toArray())) checked @endif> {{$category->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Upload New Picture:</label>
                    <div class="col-sm-10">
                        <input type="file" name="picpath" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone / Mobile:</label>
                    <div class="col-sm-10">
                        <input type="tel" name="phone" value="{{ $editorToUpdate->phone }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputAddress2" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" name="address" value="{{ $editorToUpdate->address }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-group col-md-4">
                        <label for="inputCity" class="col-sm-2 col-form-label">City</label>
                        <input type="text" name="city" value="{{ $editorToUpdate->city }}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState" class="col-sm-2 col-form-label">State</label>
                        <input type="text" name="state" value="{{ $editorToUpdate->state }}" class="form-control">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip" class="col-sm-2 col-form-label">Country</label>
                        <input type="text" name="country" value="{{ $editorToUpdate->country }}" class="form-control">
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