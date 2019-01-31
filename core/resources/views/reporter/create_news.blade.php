
@extends('reporter.layout.app')
@section('contents')
<div class="content p-4">
    <h2 class="mb-4"> Creating News </h2>
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action = "{{ route('reporter.created_news_submit') }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <fieldset class="form-group">
                    <div class="row">
                        <label class="col-form-label col-sm-2">Categories Selection:</label>
                        <div class="col-sm-10">
                            <select name="category" class="form-control form-control-lg">
                                <option value="0" selected disabled>--Please Choose a Category--</option>
                                @foreach($allCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </fieldset>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Post's Title:</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control form-control-lg" placeholder="Title of News">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Description:</label>
                    <div class="col-sm-10">
                        <textarea name="description" class="form-control" rows="7" id="textArea"> </textarea>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Picture:</label>
                    <div class="col-sm-10">
                        <input type="file" name="preview" class="form-control form-control-lg" accept="image/*">
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-block btn-lg btn-primary">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    bkLib.onDomLoaded(function () {
        new nicEditor({iconsPath: '{{asset('assets/reporter/images/nicEditorIcons.gif')}}'}).panelInstance('textArea');
    });
</script>
@stop