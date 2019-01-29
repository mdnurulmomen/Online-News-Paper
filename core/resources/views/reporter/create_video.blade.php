
@extends('reporter.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Creating Video </h2>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action = "{{ route('reporter.created.video.submit') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Video Title:</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Title of Video" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Video Preview:</label>
                    <div class="col-sm-3">
                        <input type="file" name="preview" class="form-control form-control-lg" accept="image/*">
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Video Link:</label>
                    <div class="col-sm-3">
                        <select class="form-control form-control-lg" onchange="document.getElementById('displayValue').value=this.options[this.selectedIndex].value" required>
                            <option selected disabled>--Please Select an Option--</option>
                            <option value="https://www.youtube.com/">YouTube</option>
                            <option value="https://vimeo.com/">Vimeo</option>
                        </select>
                    </div>
                    <div class="col-sm-7">
                        <input type="text" id="displayValue" name="url" class="form-control form-control-lg" placeholder="video Identifier Text" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-block btn-lg btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop