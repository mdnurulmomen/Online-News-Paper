@extends('admin.layout.app')
@section('contents')

    <h2 class=""> Updating Category </h2>
    <div class="card">
        <div class="card-body">
            <form method="POST" action = "{{ route('admin.edited_category_submit', $categoryToUpdate->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category Name:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" value="{{ $categoryToUpdate->name }}" class="form-control form-control-lg" readonly="true">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category Url</label>
                    <div class="col-sm-10">
                        <input type="text" name="url" value="{{ $categoryToUpdate->url }}" class="form-control form-control-lg" required>
                    </div>
                </div>
                <fieldset class="form-group">
                    <div class="row">
                        <label class="col-form-label col-sm-2 pt-0">Parent Selection:</label>
                        <div class="col-sm-10">
                            <select name="parent" class="form-control form-control-lg">
                                <option value="0" selected disabled>Select an Option</option>
                                @foreach($allCategories as $category)
                                    <option value="{{ $category->id }}" @if($category->id==$categoryToUpdate->parent) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-block btn-lg btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop