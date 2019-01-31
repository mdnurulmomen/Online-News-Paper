<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/front/css/custom.css') }}">

    <title>News Paper</title>
    <style>

        body {
            font-family: Kiron, SolaimanLipi, Arial, Vrinda, FallbackBengaliFont, Helvetica, sans-serif !important;
            font-size: 16px;
            background: #f0f0ed;
            color: #333;
            cursor: default;
            line-height: 24px;
            min-height: 100%;
        }
        
        .container-fluid{
            padding-left: 5%;
            padding-right: 5%;
            margin: 0 auto;
            width: 80%;
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

        .navbar-nav li:hover, .nav-item:active {
            background-color: #f0f0ed;
            border-bottom: 1px solid red;
        }

        hr{
            margin: 10px 0;
        }

        .headlines-wrapper{
            margin-top: 16px;
        }

        .description{
            text-align: justify;
            padding: 28px 10px 10px 0px;
            text-indent: 10px;
        }

        .captionUpper{
            color: #FFC107;
            margin-top: -36px;
            margin-bottom: -3%;
            font-weight: bold;
            font-size: 23px;
            word-wrap: break-word;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
            position: absolute;
            padding: 0px 5px 8px 8px;
            margin-right: 15px;
        }

        .captionUpper:hover{
            color : #fff;
        }

        .captionUpperSecond{
            color: #fff;
            margin-top: -40px; 
            font-weight: bold;
            font-size: 20px;
            word-wrap: break-word;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
            position: absolute;
            padding: 0px 5px 8px 8px;
            margin-right: 15px;
        }

        .captionUpperSecond:hover{
            color : #fff;
        }

        .categoryName{
            margin-top: 35px;
            margin-bottom: 20px;
            color: #4a4a4a;
            font-size: 26px;
            line-height: 32px;
            font-weight: 400;
            border-left: 5px solid red;
            padding-left: 10px;
        }

        .break-block{
            margin: 20px;
        }

        .ad-wrapper {
            width: 100%;
            background-color: #fff;
            padding: 72px;
            padding-bottom: : 30px;
            margin-left: auto;
            text-align: center;
        }

        .media-wrapper {
            background-color:#212121;
        }

        .media-wrapper .categoryName{
            color:#FFC107;
        }

        .media-wrapper .title{
            color:#fff;
            text-align: center; 
        }

        .media-wrapper .title a{
            color:#fff;
        }

        .media-wrapper .parallal{
            background-color: inherit;
        }

        .Video{
            background-color: #000;
        }

        .date-wrapper{
            text-align: left;
            
            background-color: #fff;
        }

        .parallal {
            padding: 2%;
            display: flex;
            margin-right: 5px;
            align-self: flex-start;
            background-color: #fff;
            clear: both;
        }

        .parallal .title {
            flex: 67%;
            
        }

        .parallal .image{
            float: left;
            flex: 33%;
            margin-right: 10px;
            position: relative;
            overflow: hidden;
            /* padding-top: 2%; */
            justify-content: center;
            align-self: center;
        }

        .imageDiv{
            display: flex;
            align-self: flex-start;
            clear: both;
        }

        .imageDiv .title {
            flex: 33%;
            
        }

        .imageDiv .image{
            float: left;
            flex: 67%;
            margin-right: 10px;
            position: relative;
            overflow: hidden;
            /*padding-top: 2%;*/
        }

        .title{
            color : #000;
            justify-content: center;
            align-self: center;
            font-weight: bold;
            font-size: 18px;
            line-height: 26px;
            word-wrap: break-word;
            margin-bottom: 0;
            padding: 10px;
        }

        .title:hover{
            color : #FFC107;
        }

        .location{
            margin-right: 16px;
            line-height: 24px;
            color: #666;
        }

        .date{
            margin-right: 16px;
            line-height: 24px;
            color: #666;
        }

        .footer-menu{
            background: #282828;
            color: #ccc;
            padding: 3% 5% 3% 5%;
        }

        .footer-menu li{
            padding: 6%;
        }

        .footer-menu a{
            color: #ccc;
            float: left;
            display: block;
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
        }

        .footer-menu a:hover{
            color: #FFC107;
        }

        .footer{
            background-color: #000;
            text-align: center;
            width: 100%;
            color: #ccc;
            padding: 10px;
        }

        #searchForm{
            display:none;
            width:100%;
            /*width: 0;*/
        }

        #menuList {
            height: 30%;
            width: 0;
            position: fixed;
            z-index: 99;
            top: 74px;
            left: 0;
            background-color: #282828;
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
            color: #fff;
            display: block;
            transition: 0.3s;
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

        .newsDetails-wrapper .container-fluid{
            background-color: #fff;
            color:#000;
        }

        .item-box-light-lg {
            padding: 3rem 3.5rem;
            -webkit-box-shadow: 0 1px 0 0 rgba(225, 225, 225, .75);
            -moz-box-shadow: 0 1px 0 0 rgba(225, 225, 225, .75);
            box-shadow: 0 1px 0 0 rgba(225, 225, 225, .75);
        }

        .commentTitle{
            color: #424242;
            font-size: 24px;
            line-height: 30px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .forum-list-item {
            padding-left: 5px;
            border-bottom: 1px solid #eee;
        }
        
        .user{
            font-size: 20px;
            font-weight: bold;
        }

        .comment-list-item .fa-user{
            font-size: 28px;
        }

        .menuBar .fa-user{
            top: 5px;
            position: relative;
            font-size: 20px;
        }

        .menuBar {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: justify;
            flex-flow: row nowrap;
            -ms-flex-pack: start;
            justify-content: flex-start;
            padding: .5rem 1rem;
            background-color: #f8f9fa!important;    
        }

        .menuBar ul {
            margin: 0;
            padding: 0;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: row;
            flex-direction: row;
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
        }

        .menuBar li {
            float: left;
            display: list-item;
        }

        .menuBar li a {
            font-weight: bold;
            display: inline-block;
            color: #05691c;
        }
    </style>

  </head>

    <div id="menuList">
        <div class="container">
            <div class="row">
                
                <div class="col-md-2">
                @foreach($allCategories as $key=>$category) 
                <a href="{{ url('category/'.$category->url) }}"> {{ $category->name }} </a>

                @if($key>0 && $key%3==0)
                    </div><div class="col-md-2">
                @endif

                @endforeach
                </div>

            </div>
        </div>
    </div>

    <body>
        <div class="header-wrapper">
            <div class="container-fluid">
                <div class="row text-center">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="menuNav"> 
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{asset('assets/front/images/setting/'.$allSettings->logo)}}">
                        </a>

                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav">
                                @foreach($headerCategories as $headerCategory)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('category/'.$headerCategory->url) }}">{{ $headerCategory->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </nav>
                    
                    <div class="menuBar">
                        <ul>
                            <li>
                                <a class="nav-link" href="javascript:void(0);">
                                    <i class="fas fa-bars" onclick="openMenuList(this)"></i>
                                </a>
                            </li>
                            
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Not Fixed</a>

                                    <div class="dropdown-divider"></div>

                                    @if(Auth::check())
                                    <a href="{{route('user.logout')}}" class="dropdown-item">Logout</a>
                                    @else
                                    <a href="{{ route('user.login') }}" class="dropdown-item">Login</a>
                                    <a href="{{ route('user.register') }}" class="dropdown-item">Register</a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    {{--
                    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="barNav"> 
                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);">
                                        <i class="fas fa-bars" onclick="openMenuList(this)"></i>
                                    </a>
                                </li>
                                
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Not Fixed</a>

                                        <div class="dropdown-divider"></div>

                                        @if(Auth::check())
                                        <a href="{{route('user.logout')}}" class="dropdown-item">Logout</a>
                                        @else
                                        <a href="{{ route('user.login') }}" class="dropdown-item">Login</a>
                                        <a href="{{ route('user.register') }}" class="dropdown-item">Register</a>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    --}}  
                </div>

                <div class="row">
                    <div id="searchForm">    
                        <form class="col-sm-12 form-horizontal" action="">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="inputPassword3" placeholder="Plaese Search Here" required>
                                </div>
                                <button class="btn btn-outline-success col-sm-2" type="submit">Search</button>
                            </div>
                        </form>
                    </div>                    
                </div>
            </div>
        </div>

        <div class="break-block"></div>
        
        @yield('contents')


        <div class="break-block"></div>
   
        <div class="footer-menu">
            <div class="container">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-2 ">
                        <ul style="list-style-type: circle;">
                        @foreach($footerCategories as $key=>$category)
                            <li>
                                <a href="{{$category->url}}">
                                   {{$category->name}}
                                </a>
                            </li>
                            @if($key>0 && ($key+1)%3==0)
                                </ul></div><div class="col-6 col-sm-6 col-md-2"><ul style="list-style-type: circle;">
                           @endif

                        @endforeach
                        </ul>
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="footer">
            <div class="text-center">  
                {{ $allSettings->footer }}
            </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script type="text/javascript">
        /* Set the width of the side navigation to 100% */
        function openMenuList(element) 
        {
            document.getElementById("menuList").style.width = "100%";
            element.className = element.className.replace("fa-bars", "fa-times");
            element.setAttribute( "onClick", "javascript: closeMenuList(this, 'close');" );
        }

        /* Set the width of the side navigation to 0 */
        function closeMenuList(element) 
        {
            document.getElementById("menuList").style.width = "0";
            element.className = element.className.replace("fa-times", "fa-bars");
            element.setAttribute( "onClick", "javascript: openMenuList(this);" );
        }

        $(document).mouseup(function(e) 
        {
            var menuContainer = $("#menuList");
            // if the target of the click isn't the container nor a descendant of the container
            if (!menuContainer.is(e.target) && menuContainer.has(e.target).length === 0 && menuContainer.width() > 200) {
                menuContainer.width(0);
                $(".fa-times").toggleClass('fa-times fa-bars');
                $(".fa-bars").attr('onClick', 'javascript: openMenuList(this);');
            }
        });


        function openSerachBox()
        {
            var x = document.getElementById("searchForm");
            // var y = document.getElementById('navbar');
            if (x.style.display === "none")
            {
                // y.style.display = "none";
                x.style.display = "block";
            }else {
                x.style.display = "none";
                // y.style.display = "block";
            }
        }

        $(function() {
           $("li").click(function() {
              // remove classes from all
              $("li").removeClass("active");
              // add class to the one we clicked
              $(this).addClass("active");
           });
        });

        $(document).ready(function () {
            var url = window.location;
            $('ul.nav a[href="'+ url +'"]').parent().addClass('active');
            $('ul.nav a').filter(function() {
                 return this.href == url;
            }).parent().addClass('active');
        });

    </script>
    </body>
</html>