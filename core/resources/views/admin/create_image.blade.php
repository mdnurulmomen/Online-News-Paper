
@extends('admin.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Creating Image </h2>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action = "{{ route('admin.created_image_submit') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image Title:</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Title of Image" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image Description:</label>
                    <div class="col-sm-10">
                        <textarea id="textArea" name="description" class="form-control form-control-lg" placeholder="Description of Image" rows="5" required> </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Image Preview:</label>
                    <div class="col-sm-3">
                        <input type="file" name="preview" class="form-control form-control-lg" accept="image/*">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Status:</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="status"  data-toggle="toggle" data-on="Published" data-off="Unpublished" data-onstyle="success" data-offstyle="danger" data>
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

<script>
    $(document).ready(function() {
        bkLib.onDomLoaded(function () {
            new nicEditor({iconsPath: '{{asset('assets/admin/images/nicEditorIcons.gif')}}'}).panelInstance('textArea');
        });
    });
</script>
@stop