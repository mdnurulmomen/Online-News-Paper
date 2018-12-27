@extends('admin.layout.app')
@section('contents')
    <div class="content p-4">
        <h2 class="mb-4"> Headline Settings </h2>
        <div class="card mb-4">

            <div class="card-body text-center">
                <div class="row">
                    <div class="col-sm-4">
                        <h5 class="text-capitalize">Choose Preference</h5>
                    </div>
                    <div class="col-sm-4">
                        <h5 class="text-capitalize">News Id</h5>
                    </div>
                    <div class="col-sm-4">
                        <h5 class="text-capitalize">News Title</h5>
                    </div>
                </div>
                <form method="post" action="{{route('admin.settings.news.submit')}}">
                    @csrf
                    @method('put')
                    @for($i=0;$i<count($allNews);$i++)
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-outline-primary">Number {{$i+1}} </button>
                        </div>
                        <div class="col-sm-4">
                            <input type="text" name="newsId[]" value="{{$allNews[$i]->id}}" class="form-control" placeholder="Insert News Id">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" value="{{$allNews[$i]->title}}">
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
                            <button type="submit" class="btn btn-block btn-primary">Update</button>
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
                    "                        <div class=\"col-sm-4\">\n" +
                    "                            <button type=\"button\" class=\"btn btn-outline-primary\">Next Preference</button>\n" +
                    "                        </div>\n" +
                    "                        <div class=\"col-sm-4\">\n" +
                    "                            <input type=\"text\" name=\"newsId[]\" class=\"form-control\" placeholder=\"Insert News Id\">\n" +
                    "                        </div>\n" +
                    "                        <div class=\"col-sm-4\">\n" +
                    "                            <input type=\"text\" class=\"form-control\">\n" +
                    "                        </div>\n" +
                    "                    </div>\n" +
                    "                    <br>");
            });
        });
    </script>
@stop