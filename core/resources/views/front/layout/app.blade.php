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

        /*.navbar-light > ul > li:first-child a {
            background-color: red;
            color: #d40909;
            text-shadow: -3px 0px 3px yellow, 3px 0px 3px yellow, 6px 0px 6px yellow, -6px 0px 6px yellow;
            animation: blinker .7s linear 4 forwards;
        }*/
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
            margin-top: -15%;
            margin-bottom: 15%;
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
            padding: 0 0 0px 5px;
            margin-top: -25%;
            margin-right: 15px;
            margin-bottom: 1rem;
            font-weight: bold;
            font-size: 17px;
            word-wrap: break-word;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.8) 100%);
            /*position: absolute;*/
        }

        .captionUpperSecond:hover{
            color : #fff;
        }



        .categoryName{
            margin-top: 25px;
            margin-bottom: 20px;
            color: #4a4a4a;
            font-size: 26px;
            line-height: 32px;
            font-weight: 400;
            border-left: 5px solid red;
            padding-left: 5px;
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
        }

        .media-wrapper .title a{
            color:#fff;
        }

        .media-wrapper .parallal{
            background-color: inherit;
        }

        .Image{
            display: flex;
            clear: both;
            justify-content: center;
            flex-direction: column;
            
        }

        .Image .title{
            flex: 50%;
        }

        .Image img{
            flex: 50%;
        }

        .Video{
            background-color: #000;
        }

        .date-wrapper{
            text-align: left;
            
            background-color: #fff;
        }

        .parallal {
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
            /*padding-top: 2%;*/
        }


        .title{
            color : #000;
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

        .footer-wrapper{
            background: #282828;
            color: #ccc;
            padding: 3% 3% 0 3% ;
        }

        .footer-wrapper a{
            color: #ccc;
            float: left;
            display: block;
            text-decoration: none;
            font-size: 18px;
            line-height: 40px;
            font-weight: bold;
        }

        .footer-wrapper a:hover{
            color: #FFC107;
        }

        .footer{
            background-color: #000;
            text-align: center;
            width: 100%;
        }

        #searchForm{
            display:none;
            width:100%;
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
    </style>

  </head>

  <body>
        <div class="header-wrapper">
            <div class="container">
                <div class="row">
                    <nav class="navbar sticky-top navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{asset('assets/front/images/setting-img/'.$allSettings->logo)}}">
                        </a>

                        <div class="collapse navbar-collapse">
                            <ul class="navbar-nav" id="navbar">
                                @foreach($headerCategories as $headerCategory)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('category/'.$headerCategory->url) }}">{{ $headerCategory->name }}</a>
                                </li>
                                @endforeach
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);"> <i class="fas fa-bars" onclick="openMenuList(this)"></i> </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="javascript:void(0);"><i class="fa fa-search" aria-hidden="true" onclick="openSerachBox()"></i></a>
                                </li>
                            </ul>
                        </div>
                    </nav>

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
                <div class="row" id="menuList">    
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

        <div class="break-block"></div>
        <div class="break-block"></div>
        <div class="break-block"></div>
        
        @yield('contents')


        <div class="break-block"></div>

        <div class="ad-wrapper container mb-3">Ad Space</div>
   
        <div class="footer-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <ul style="list-style: none;">
                        @foreach($footerCategories as $key=>$category)
                            <a href="{{$category->url}}">
                            <li class="">
                               {{$category->name}}
                            </li>
                            </a>
                            @if($key>0 && ($key+1)%3==0)
                                </ul></div><div class="col-sm-2"><ul style="list-style: none;">
                           @endif

                        @endforeach
                        </ul>
                    </div>
                </div>
                
                <div class="break-block"></div> 
            </div>

            <div class="footer">
                <div class="text-center">
                    
                    <p>{{ $allSettings->footer }}</p>
                    
                </div>
            </div>
        </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script type="text/javascript">
        /* Set the width of the side navigation to 100% */
        function openMenuList(element) {
            document.getElementById("menuList").style.width = "100%";
            element.className = element.className.replace("fa-bars", "fa-times");
            element.setAttribute( "onClick", "javascript: closeMenuList(this, 'close');" );
        }

        /* Set the width of the side navigation to 0 */
        function closeMenuList(element) {
            document.getElementById("menuList").style.width = "0";
            element.className = element.className.replace("fa-times", "fa-bars");
            element.setAttribute( "onClick", "javascript: openMenuList(this);" );
        }

        function openSerachBox(){

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

        function currentDiv(n) {
            showDivs(slideIndex = n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            if (n > x.length) {slideIndex = 1}
            if (n < 1) {slideIndex = x.length}
            for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
            }
            x[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " w3-opacity-off";
        }
    </script>
  </body>
</html>