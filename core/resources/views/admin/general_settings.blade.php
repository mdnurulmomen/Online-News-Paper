@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> General Settings </h2>
        <div class="card mb-4">
            <div class="card-header bg-white font-weight-bold">
                Basic Information
            </div>
            <div class="card-body">
                <form method="post" action = "{{ route('admin.settings_general_submit') }}">
                    @csrf
                    @Method('put')
                    <div class="form-group row">
                        <div class="col-md-6 mb-6">
                            <label class="col-form-label" for="validationServer01">Name</label>
                            <input type="text" name="name" class="form-control form-control-lg is-valid" value="{{ $settings->name }}" required>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="col-form-label" for="validationServer02">Color</label>
                            <input type="text" name="color" value="{{ $settings->color }}" class="form-control form-control-lg is-valid" onkeyup="backgroundColor()">
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <label class="col-form-label" for="validationServer03">Set Footer:</label>
                            <textarea name="footer" class="form-control is-valid" rows="7" id="textArea"> {{ $settings->footer }} </textarea>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-block btn-lg btn-primary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        function backgroundColor () {
            var inputSelected = document.getElementsByName("color")[0];
            inputSelected.style.backgroundColor = document.getElementsByName("color")[0].value;
        }
    
        $(document).ready(function() {
            bkLib.onDomLoaded(function () {
                new nicEditor({iconsPath: '{{asset('assets/admin/images/nicEditorIcons.gif')}}'}).panelInstance('textArea');
            });
        });
    </script>
@stop