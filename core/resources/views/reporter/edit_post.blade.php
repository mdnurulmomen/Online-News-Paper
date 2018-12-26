
@extends('reporter.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Post Edit </h2>
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Post Updating Form
        </div>
        <legend class="text-center">
            <img src="{{ asset('assets/front/images/'.$postToUpdate->picpath) }}" class="img-thumbnail" alt="No Image">
        </legend>
        <div class="card-body">
            <form method="POST" action = "{{ route('reporter.edited.post.submit', $postToUpdate->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <fieldset class="form-group">
                    <div class="row">
                        <label class="col-form-label col-sm-2 pt-0">Categories Selection:</label>
                        <div class="col-sm-10">
                            <select name="category" class="form-control">
                            @foreach($allCategories as $category)
                                <option value="{{$category->id}}" @if($category->id==$postToUpdate->category->id) selected @endif>{{$category->name}}
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Picture:</label>
                    <div class="col-sm-10">
                        <input type="file" name="picpath" class="form-control" accept="image/*">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status:</label>
                    <div class="col-sm-10">
                        <label class="checkbox-inline"><input type="checkbox" @if($postToUpdate->status==1) checked @endif disabled>Published</label>
                        <label class="checkbox-inline"><input type="checkbox" @if($postToUpdate->status==0) checked @endif disabled>Unpublished</label>
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