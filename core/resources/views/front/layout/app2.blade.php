<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/custom.css') }}">

    <title>News Paper</title>
    <style>

        body {
            font-size: 14px;
            background: #f0f0ed;
            color: #333;
            cursor: default;
            line-height: 24px;
            min-height: 100%;
        }
        
        .header-wrapper{
            box-shadow: rgb(0, 0, 0) 0px 5px 5px -5px;
            border-bottom: 0px none;
            background: #fff;
            position: fixed;
            z-index: 999;
            color:#fff;
            top: 0;
            right: 0;
            left: 0;
        }

        .navbar-light .navbar-nav .nav-link{
            font-weight: bold;
            display: inline-block;
            color: #05691c;
        }

        .navbar-light > ul > li:first-child a {
            color: #d40909;
            text-shadow: -3px 0px 3px yellow, 3px 0px 3px yellow, 6px 0px 6px yellow, -6px 0px 6px yellow;
            animation: blinker .7s linear 4 forwards;
        }

        .headlines-wrapper{
            margin-top: 16px;
        }

        .captionUpper{
            color : yellow;
            margin-top: -3rem;
            font-weight: bold;
            font-size: 23px;
            word-wrap: break-word;
        }

        .categoryName{
            margin-top: 25px;
            margin-bottom: 20px;
            color: #4a4a4a;
            font-size: 26px;
            line-height: 32px;
            font-weight: 400;
        }

        .break-block{
            margin-bottom: 16px;
        }

        .ad-wrapper{
            background-color: #fff;
            padding-top: 100px;
            padding-bottom: : 30px;
            margin-left: auto;
            text-align: center;
        }

        .media-wrapper{
            background-color:#212121;
        }

        .media-wrapper .container{
            background-color: #545252;
        }

        .media-wrapper .categoryName{
            color:#FFC107;
            background-color: #212121;
        }

        .media-wrapper .title a, .media-wrapper .description{
            color:#369;
        }

        .media-wrapper .title{
            color:#fff;
        }

        .media-wrapper .image{
            width: 100%;
            display: block;
            width: 66%;
            float: right;
            margin-left: 15px;
        }


        .Video{
            background-color: #000;
        }

        .Video .image{
            float: left;
            margin-right: 16px;
            width: 30%;
            position: relative;
            overflow: hidden;
        }

        .date-wrapper{
            text-align: left;
            background-color: #fff;
        }

        .parallal {
            display: flex;
            margin-right: 2px;
            align-self: flex-start;
            background-color: #fff;
            clear: both;
        }

        .title{
            color : #000;
            font-weight: bold;
            font-size: 18px;
            line-height: 26px;
            word-wrap: break-word;
        }

        .parallal .title {
            flex: 1;
        }

        .image{
            float: left;
            margin-right: 16px;
            width: 30%;
            position: relative;
            overflow: hidden;
        }

        .footer-wrapper{
            background: #282828;
            color: #ccc;
        }

        .footer-wrapper a{
            color: #ccc;
            float: left;
            display: block;
            text-decoration: none;
            font-size: 18px;
            line-height: 40px;
        }

        #searchForm{
            display:none;
            /*width: 0;*/
        }

        #menuList {
            height: 30%;
            /*width:95%;*/
            /*display: none;*/
            width: 0;
            position: fixed;
            z-index: 99;
            top: 74px;
            left: 0;
            /*background-color: #155724;*/
            background-color: #fff;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 10px;
        }
        
        a, a:hover{
            text-decoration: none;
            /*color:Ivory;*/
            color: #155724;
        }
        
        #menuList a {
            padding: 0px 0px 0px 5px;
            margin-top:28px;
            text-decoration: none;
            font-size: 15px;
            color: #000;
            display: block;
            transition: 0.3s;
            font-weight: bold;
            font-size: 18px;
            line-height: 40px;
        }

        #menuList a:hover {
            /*background-color: #4c0000;*/
        }

        .closebtn {
            position: absolute;
            top: -30px;
            right: 5px;
            font-size: 25px;
        }

        @media screen and (max-height: 450px) {
          #menuList {padding-top: 15px;}
          #menuList a {font-size: 16px;}
        }
    </style>

  </head>

  <body>
        <div class="header-wrapper">
            <div class="container">
                <div class="row">
                    <nav class="navbar sticky-top navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="#">
                            <img src="{{asset('assets/front/images/setting-img/'.$allSettings->logo)}}">
                        </a>
                        <div class='animate' id="searchForm">    
                            <form >
                                <div class="form-group row">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Plaese Search Here">
                                    </div>
                                    <button class="btn btn-outline-success col-sm-2" type="submit">Search</button>
                                </div>
                            </form>
                        </div>
                        <div class="collapse navbar-collapse" id="navbar">
                            <ul class="navbar-nav">
                                @foreach($headerCategories as $headerCategory)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('category/'.$headerCategory->url) }}">{{ $headerCategory->name }}</a>
                                </li>
                                @endforeach
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> <i class="fas fa-bars" onclick="openMenuList()"></i> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fa fa-search" aria-hidden="true" onclick="openSerachBox()"></i></a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="row" id="menuList">
                    <div class="sidenav">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeMenuList()">&times;</a>
                        
                        <div class="col-md-3">
                            @foreach($allCategories as $key=>$category) 
                            <a href="{{ url('category/'.$category->url) }}"> {{ $category->name }} </a>

                            @if($key>0 && $key%3==0)
                                </div><div class="col-md-3">
                            @endif

                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        
        <div class="ad-wrapper">Ad Space</div>
        
        <div class="date-wrapper">
            <div class="container">
                <div class="title">
                    {{Carbon\Carbon::now()->toDateString()}}
                </div>  
            </div>
        </div>
        
        <div class="headlines-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-sm-12">
                                @if(file_exists('assets/front/images/news-img/'.array_first($headlines)->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="captionUpper">
                                    {{ array_first($headlines)->title }}
                                </div>
                            </div>
                        </div>

                        <div class="row  mb-3">
                        @foreach($headlines as $key => $value)
                            @if($key > 0)
                                <div class="col-sm-6">
                                    <div class="bg-white"> 
                                        @if( file_exists('assets/front/images/news-img/'.$value->picpath) )
                                            <img src="{{ asset('assets/front/images/news-img/'.$value->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                           
                                        <div class="title">
                                           {{ $value->title }}
                                        </div>
                                    </div>
                                </div>

                        @if($key%2==0)
                        </div><div class="row mb-3">
                        @endif
                              
                            @endif
                        @endforeach
                          </div>
                    </div>

                    <div class="col-md-4">
                        @foreach($subHeadlines as $subHeadline)
                        <div class="row">
                            <div class="parallal">
                                <div class="image">
                                    @if(file_exists('assets/front/images/news-img/'.$subHeadline->picpath))
                                        <img src="{{ asset('assets/front/images/news-img/'.$subHeadline->picpath) }}" class="img-fluid pull-left" src="" alt="Responsive image">
                                    @else
                                        <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                    @endif
                                </div>
                                <div class="title">
                                    {{ $subHeadline->title }}
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>

                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-sm-12 ad-wrapper">
                                Space for ad images
                            </div>
                        </div>
                    </div>
                </div>             
            </div>
        </div>

        <div class="break-block"></div>

        
        <div class="ad-wrapper">Ad Space</div>

        
        <div class="media-wrapper">
            <div class="container">

                <div class="row categoryName">
                    Images & Videos 
                </div>
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="title">
                                <a href=""> {{ array_first($allImages)->title }} </a>
                                <br>
                                {{ array_first($allImages)->description }} 
                            </div>
                            <div class="image">
                                @if(file_exists('assets/front/images/image-img/'.array_first($allImages)->preview))
                                    <img src="{{ asset('assets/front/images/image-img/'.array_first($allImages)->preview) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>

                        </div>
                        <div class="row mb-3">
                            @foreach($allImages as $key=>$value)
                            @if($key > 0)
                            <div class="col-md-3">
                                <a href="">
                                    @if(file_exists('assets/front/images/image-img/'.$value->preview))
                                        <img src="{{ asset('assets/front/images/image-img/'.$value->preview) }}" class="img-fluid" alt="Responsive image">
                                    @else
                                        <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                    @endif
                                    
                                    <div class="title">
                                        {{ $value->title }}
                                    </div>
                                </a>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 Video">
                        <div class="row mb-3">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ array_first($allVideos)->videoaddress }}"  frameborder="0" allowfullscreen></iframe>
                            </div>
                            <div class="title">
                                {{ array_first($allVideos)->title }} 
                            </div>
                        </div>
                        <hr>
                        @foreach($allVideos as $key=>$video)
                        @if($key>0)
                        <div class="row">
                            <div class="image">
                               <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ $video->videoaddress }}" allowfullscreen></iframe>
                                </div>   
                            </div>
                            <div class="title">
                                {{ $video->title }}
                                
                            </div>
                        </div>
                        <hr>
                        @endif
                        @endforeach
                    </div>
                </div>
                
                
            </div>
        </div>

        <div class="break-block"></div>

        <div class="firstPrioritizedCategroy-wrapper">
            <div class="container">
            <div class="categoryName"> {{ $categoryNames[0]->name }} </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            @foreach($categorizedNews[0] as $key => $value)
                            <div class="col-md-4 mb-3">
                                <div class="bg-white"> 
                                @if(file_exists('assets/front/images/news-img/'.$value->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$value->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                    <div class="title">
                                        {{ $value->title }}
                                    </div>
                                </div>
                            </div>

                            @if($key==1 && $key%3==0)
                                </div><div class="row">
                            @endif

                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4 ad-wrapper"> Space for ad images </div>
                </div>
            </div>
        </div>

        
        <div class="secondPrioritizedCategory">
            <div class="container">
            <div class="categoryName"> {{ $categoryNames[1]->name }} </div>
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="bg-white"> 
                                @if(file_exists('assets/front/images/news-img/'.array_first($categorizedNews[1])->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedNews[2])->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                    <div class="title">
                                       {{ array_first($categorizedNews[1])->title }} 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                @foreach($categorizedNews[1] as $key => $value)
                                @if($key>0)      
                                <div class="parallal">
                                    <div class="image">
                                        @if(file_exists('assets/front/images/news-img/'.$value->picpath))
                                            <img src="{{ asset('assets/front/images/news-img/'.$value->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="title">
                                        {{ $value->title }}
                                    </div>
                                </div>
                                <hr>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ad-wrapper">Space for ad images</div>
                </div>
            </div>
        </div>

        <div class="break-block"></div>

        
        <div class="thirdPrioritizedCategory">
            <div class="container">
                <div class="categoryName"> {{ $categoryNames[2]->name }} </div>
                <div class="row">

                @foreach($categorizedNews[2] as $key => $thirdCategorizedNews)
                    
                    @if($key < 3)
                    <div class="col-md-3">
                        <div class="parallal">
                            <div class="image">
                            @if(file_exists('assets/front/images/news-img/'.$thirdCategorizedNews->picpath))
                                <img src="{{ asset('assets/front/images/news-img/'.$thirdCategorizedNews->picpath) }}" class="img-fluid" alt="Responsive image">
                            @else
                                <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                            @endif
                            </div>
                            <div class="title">
                                {{ $thirdCategorizedNews->title }}
                            </div>
                        </div>
                    </div>
                    @endif

                @endforeach

                    <div class="col-md-3 ad-wrapper">
                        Space for Ad Image
                    </div>

                </div>
            </div>
        </div>

        <div class="break-block"></div>

       
        <div class="fourthPrioritizedCategory">
            <div class="container">
            <div class="categoryName"> {{ $categoryNames[3]->name }} </div>
                <div class="row">
                    <div class="col-sm-4">
                        @foreach ($categorizedNews[1] as $key=>$value)
                        <div class="row mb-3 mr-1">
                            <div class="parallal">
                                <div class="image">
                                    @if(file_exists('assets/front/images/news-img/'.$value->picpath))
                                        <img src="{{ asset('assets/front/images/news-img/'.$value->picpath) }}" class="img-fluid" alt="Responsive image">
                                    @else
                                        <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                    @endif
                                </div>
                                <div class="title">
                                    {{ $value->title }}
                                </div>
                            </div>
                        </div>
                        <hr>
                        @if($key>0 && ($key+1)%4==0)
                            </div><div class="col-sm-4">
                        @endif

                        @endforeach
                    </div>
                    
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="ad-wrapper">
                                Ad Space
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="break-block"></div>

        **** ad space 
        <div class="ad-wrapper">Ad Space</div>

        
        <div class="footer-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <ul style="list-style: none;">
                        @foreach($footerCategories as $key=>$category)
                            <a href="">
                            <li class="">
                               {{$category->name}}
                            </li>
                            </a>
                            @if($key>0 && ($key+1)%4==0)
                                </ul></div><div class="col-sm-3"><ul style="list-style: none;">
                           @endif

                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="break-block"></div>
                <div class="row text-center">{{ $allSettings->footer }}</div>
            </div>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script type="text/javascript">
        /* Set the width of the side navigation to 250px */
        function openMenuList() {
            document.getElementById("menuList").style.width = "100%";
            // document.getElementById("menuList").style.display = "block";
        }

        /* Set the width of the side navigation to 0 */
        function closeMenuList() {
          document.getElementById("menuList").style.width = "0";
          // document.getElementById("menuList").style.display = "none";
        }

        function openSerachBox(){
            // 
            // document.getElementById('searchForm').style.display='block';

            var x = document.getElementById("searchForm");
            var y = document.getElementById('navbar');

            if (x.style.display === "none") {
                y.style.display = "none";
                x.style.display = "block";
            } else {
                x.style.display = "none";
                x.style.display = "block";
            }
        }
    </script>
  </body>
</html>