@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> Headline Settings </h2>
        <div class="card mb-4">

            <div class="card-body text-center">
                <div class="row">
                    <div class="col-sm-3">
                        <h5 class="text-capitalize">Preference No</h5>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="text-capitalize">Category Id</h5>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="text-capitalize">Category Name</h5>
                    </div>
                    <div class="col-sm-3">
                        <h5 class="text-capitalize">Category Parent</h5>
                    </div>
                </div>
                <form method="post" action="{{route('admin.settings_categories_submit')}}">
                    @csrf
                    @method('put')
                    @for($i=0;$i<count($prioritizedCategoryDetails);$i++)
                    <div class="row">
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-outline-primary">Number {{$i+1}} </button>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="categoryId[]" value="{{$prioritizedCategoryDetails[$i]->id}}" class="form-control" placeholder="Insert News Id">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-lg" value="{{$prioritizedCategoryDetails[$i]->name}}">
                        </div>
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-lg" value="{{$prioritizedCategoryDetails[$i]->name_parent}}">
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
                    "                        <div class=\"col-sm-3\">\n" +
                    "                            <button type=\"button\" class=\"btn btn-outline-primary\">Next Preference</button>\n" +
                    "                        </div>\n" +
                    "                        <div class=\"col-sm-3\">\n" +
                    "                            <input type=\"text\" name=\"categoryId[]\" class=\"form-control\" placeholder=\"Insert Category Id\">\n" +
                    "                        </div>\n" +
                    "                        <div class=\"col-sm-3\">\n" +
                    "                            <input type=\"text\" class=\"form-control\" placeholder=\"Category Name\">\n" +
                    "                        </div>\n" +
                    "                        <div class=\"col-sm-3\">\n" +
                    "                            <input type=\"text\" class=\"form-control\">\n" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                    <br>");
            });
        });
    </script>
@stop