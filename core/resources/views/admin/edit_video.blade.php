
@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Post Setting </h2>
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            Video Updating Form
        </div>

        <div class="card-body">
            <form method="POST" action = "{{ route('admin.edited.video.submit', $videoToUpdate->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Video Title:</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" value="{{$videoToUpdate->title}}" placeholder="Title of Post" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Link Address:</label>
                    <div class="col-sm-10">
                        <input type="text" name="videoaddress" class="form-control" value="{{$videoToUpdate->videoaddress}}" placeholder="Title of Post" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Picture:</label>
                    <div class="col-sm-10">
                        <img src="{{ asset('assets/front/images/video-img/'.$videoToUpdate->preview) }}" width="100px" class="img-thumbnail img-fluid" alt="No Image">
                        <input type="file" name="preview" class="form-control" accept="image/*" placeholder="choose new preview">
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
                        <button type="submit" class="btn btn-block btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop