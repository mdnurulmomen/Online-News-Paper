
@extends('editor.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Video Setting </h2>
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Video Updating Form
        </div>

        <div class="card-body">
            <form method="POST" action = "{{ route('editor.edited_video_submit', $videoToUpdate->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Video Title:</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control form-control-lg" value="{{$videoToUpdate->title}}" placeholder="Title of Post" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Link Address:</label>
                    <div class="col-sm-10">
                        <input type="text" name="url" class="form-control form-control-lg" value="{{$videoToUpdate->url}}" placeholder="Title of Post" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Picture:</label>
                    <div class="col-sm-3">
                        <img src="{{ asset('assets/front/images/video/'.$videoToUpdate->preview) }}" class="img-thumbnail img-fluid" alt="No Image">
                    </div>
                    <div class="col-sm-3">
                        <input type="file" name="preview" class="form-control form-control-lg" accept="image/*" placeholder="choose new preview">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status:</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="status" @if($videoToUpdate->status==1) checked @endif  data-toggle="toggle" data-on="Published" data-off="Unpublished" data-onstyle="success" data-offstyle="danger">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-block btn-lg btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop