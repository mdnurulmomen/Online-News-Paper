@extends('editor.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Profile Setting </h2>
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Profile Updating Form
        </div>
        <div class="card-body">
            <form method="POST" action = "{{ route('editor.edited.post.submit', $postToUpdate->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <fieldset class="form-group">
                    <div class="row">
                        <legend class="col-form-label col-sm-2 pt-0">Categories Selection:</legend>
                        <div class="col-sm-10">
                            <select name="categoryId" class="form-control">
                                @foreach($allCategories as $category)
                                    <option value="{{ $category->id }}" @if($category->id==$postToUpdate->category_id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Post's Title:</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{$postToUpdate->title}}" placeholder="First Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" rows="5" id="textArea"> {{$postToUpdate->description}} </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status:</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="status" @if($postToUpdate->status==1) checked @endif  data-toggle="toggle" data-on="Published" data-off="Unpublished" data-onstyle="success" data-offstyle="danger">
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