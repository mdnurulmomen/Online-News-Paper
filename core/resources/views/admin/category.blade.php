
@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Profile Setting </h2>
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Profile Updating Form
        </div>
        <div class="card-body">
            <form method="POST" action = "{{ route('admin.created.category.submit') }}" enctype="multipart/form-data">
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
                    <label for="inputCategory" class="col-sm-2 col-form-label">Choose Parent Name:</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="categoryParent" required>
                            <option selected value="0"> -- select a parent name -- </option>
                            @foreach($allCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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