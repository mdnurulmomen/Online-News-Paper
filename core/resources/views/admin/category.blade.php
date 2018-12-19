
@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Profile Setting </h2>
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Profile Updating Form
        </div>
        <div class="card-body">
            <form method="POST" action = "{{ route('admin.createdCategorySubmit') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category / Sub Category Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="categoryName" class="form-control" placeholder="Category / Sub Category Name" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Choose URL:</label>
                    <div class="col-sm-10">
                        <input type="text" name="categoryURl" class="form-control" placeholder="Browsing URL" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Choose Sub Category:</label>
                    <div class="col-sm-10">
                        <input type="text" name="categoryParent" class="form-control" placeholder="Parent Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Color:</label>
                    <div class="col-sm-1">
                        <input type="color" name="color" value="" class="form-control" required>
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