@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> Headline Settings </h2>
        <div class="card mb-4">

            <div class="card-body text-center">
                <div class="row">
                    <div class="col-sm-3">
                        <h5 class="text-capitalize">Choose Preference</h5>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="text-capitalize">News Id</h5>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="text-capitalize">News Title</h5>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="text-capitalize">Category Name</h5>
                    </div>
                </div>
                <form method="post" action="{{ route('admin.settings_sub_headlines_submit') }}">
                    @csrf
                    @method('put')
                    @for($i=0; $i < count($allNews); $i++)
                    <div class="row">
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-block btn-warning btn-arrow-right">Number {{$i+1}} </button>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="news_id[]" value="{{ $allNews[$i]->id }}" class="form-control form-control-lg" placeholder="Insert News Id">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-lg" value="{{ $allNews[$i]->title }}">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-lg" value="{{ $allNews[$i]->category->name }}">
                        </div>
                    </div>
                    <br>
                    @endfor
                    <div id="appendingPoint"></div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <button type="button" id="addPreference" class="btn btn-success">Add More Preference</button>
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
    <script>
        $(document).ready(function(){
            $("#addPreference").click(function(){
                $("#appendingPoint").append("<div class=\"row\">\n" +
                    "   <div class=\"col-sm-3\">\n" +
                    "       <button type=\"button\" class=\"btn btn-block btn-warning btn-arrow-right\">Next Preference</button>\n" +
                    "   </div>\n" +
                    "   <div class=\"col-sm-3\">\n" +
                    "       <input type=\"text\" name=\"news_id[]\" class=\"form-control form-control-lg is-invalid\" placeholder=\"Insert News Id\">\n" +
                    "   </div>\n" +
                    "   <div class=\"col-sm-3\">\n" +
                    "       <input type=\"text\" class=\"form-control form-control-lg is-valid\" placeholder=\"Leave this empty\">\n" +
                    "   </div>\n" +
                    "   <div class=\"col-sm-3\">\n" +
                    "       <input type=\"text\" class=\"form-control form-control-lg is-valid\" placeholder=\"Leave this empty\">\n" +
                    "   </div>\n" +
                    "</div>\n" +
                    "<br>");
            });
        });
    </script>
@stop