<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

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

        .headlines-wrapper{
            margin-top: 16px;
        }

        .row{
            margin-bottom: 30px;
        }

        .col-sm-4, .col-sm-3, .col-md-3, .col-md-4{
            /*background: #fff;*/
            /*margin-right: 20px;*/
        }

        .captionUpper{
            color : yellow;
            margin-top: -3rem;
            font-weight: bold;
            font-size: 23px;
            word-wrap: break-word;
        }

        .caption{
            color : #000;
            font-weight: bold;
            font-size: 18px;
            line-height: 26px;
            word-wrap: break-word;
        }

        .description{
            font-weight: bold;
            word-wrap: break-word;
            font-size: 16px;
        }

        .categoryName{
            color: #4a4a4a;
            font-size: 26px;
            line-height: 32px;
            font-weight: 400;
            font-weight: 400;
            margin-bottom: 15px;
        }

        .break-block{
            margin-bottom: 16px;
        }

        .ad-wrapper{
            background-color: #fff;
            padding-top: 100px;
            padding-bottom: : 30px;
        }

        .jumbotron-fluid, .footer-wrapper{
            background-color:#545252;
        }

        .jumbotron-fluid .categoryName{
            color:#FFC107;
        }

        .jumbotron-fluid .caption, .jumbotron-fluid .description{
            color:#fff;
        }

        .Video{
            background-color: #111;
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
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#"> <span class="sr-only">(current)</span></a>
                                </li>
                                @foreach($headerCategories as $headerCategory)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('category/'.$headerCategory->url) }}">{{ $headerCategory->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                                <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        
        <div class="ad-wrapper">Ad Space</div>

        
        <div class="headlines-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
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

                        <div class="row">
                        @foreach($headlines as $key => $value)
                            @if($key > 0)
                                <div class="col-sm-6">
                                        
                                    @if( file_exists('assets/front/images/news-img/'.$value->picpath) )
                                        <img src="{{ asset('assets/front/images/news-img/'.$value->picpath) }}" class="img-fluid" alt="Responsive image">
                                    @else
                                        <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                    @endif
                                       
                                    <div class="caption">
                                       {{ $value->title }}
                                    </div>
                                </div>

                        @if($key%2==0)
                        </div><div class="row">
                        @endif
                              
                            @endif
                        @endforeach
                          </div>
                            <!-- <ul style="list-style: none;">
                                <li>
                                    <span>
                                        <img class="img-fluid img-left" src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}"/>
                                    </span>
                                    <span>
                                        Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                    </span>
                                </li>
                            </ul> -->
                    </div>

                    <div class="col-md-4">
                        @foreach($subHeadlines as $subHeadline)
                        <div class="row">
                            <div class="col-sm-5">
                                @if(file_exists('assets/front/images/news-img/'.$subHeadline->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$subHeadline->picpath) }}" class="img-fluid pull-left" src="" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-sm-7 caption">
                                {{ $subHeadline->title }}
                            </div>
                        </div>
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
            <div class="jumbotron jumbotron-fluid">
                
                    <div class="categoryName"> Images & Videos </div>
                    <div class="row">
                        <div class="col-md-8 Image">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="caption">
                                        <a href=""> {{ array_first($allImages)->title }} </a>
                                    </div>
                                    <div class="description">
                                      {{ array_first($allImages)->description }}  
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    @if(file_exists('assets/front/images/image-img/'.array_first($allImages)->preview))
                                        <img src="{{ asset('assets/front/images/image-img/'.array_first($allImages)->preview) }}" class="img-fluid" alt="Responsive image">
                                    @else
                                        <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                @foreach($allImages as $key=>$value)
                                @if($key > 0)
                                <div class="col-md-3">
                                    <a href="">
                                        @if(file_exists('assets/front/images/image-img/'.$value->preview))
                                            <img src="{{ asset('assets/front/images/image-img/'.$value->preview) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                        
                                        <div class="caption">
                                            {{ $value->title }}
                                        </div>
                                    </a>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4 Video">
                            <div class="row">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ array_first($allVideos)->videoaddress }}"  frameborder="0" allowfullscreen></iframe>
                                </div>
                                <div class="caption">
                                    {{ array_first($allVideos)->title }} 
                                </div>
                            </div>
                            <hr>
                            @foreach($allVideos as $key=>$video)
                            @if($key>0)
                            <div class="row">
                                <div class="col-md-4 caption">
                                    {{ $video->title }}
                                </div>
                                <div class="col-md-8">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{ $video->videoaddress }}" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endif
                            @endforeach
                            <div class="row"></div>
                            <div class="row"></div>
                        </div>
                    </div>
                
            </div>
        </div>

        
        <div class="firstPrioritizedCategroy-wrapper">
            <div class="container">
            <div class="categoryName"> {{ $categoryNames[0]->name }} </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            @foreach($categorizedNews[0] as $key => $value)
                            <div class="col-md-4">
                                @if(file_exists('assets/front/images/news-img/'.$value->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$value->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="caption">
                                    {{ $value->title }}
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
                                @if(file_exists('assets/front/images/news-img/'.array_first($categorizedNews[1])->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedNews[2])->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="caption">
                                   {{ array_first($categorizedNews[1])->title }} 
                                </div>
                            </div>

                            <div class="col-md-6">
                                @foreach($categorizedNews[1] as $key => $value)
                                @if($key>0)      
                                <div class="row">
                                    <div class="col-md-4">
                                        @if(file_exists('assets/front/images/news-img/'.$value->picpath))
                                            <img src="{{ asset('assets/front/images/news-img/'.$value->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="col-md-8 caption">
                                        <h6>{{ $value->title }}</h6>
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

        **** Third Prioritized Category
        <div class="thirdPrioritizedCategory">
            <div class="container">
            <div class="categoryName"> {{ $categoryNames[2]->name }} </div>
                <div class="row">
                    @foreach($categorizedNews[2] as $key => $thirdCategorizedNews)
                    @if($key<3)
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-4">
                                @if(file_exists('assets/front/images/news-img/'.$thirdCategorizedNews->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$thirdCategorizedNews->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-md-8 caption">
                                <h6>{{ $thirdCategorizedNews->title }}</h6>
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

        
        <div class="fourthPrioritizedCategory">
            <div class="container">
            <div class="categoryName"> {{ $categoryNames[3]->name }} </div>
                <div class="row">
                    <div class="col-sm-4">
                        @foreach ($categorizedNews[1] as $key=>$value)
                        <div class="row">
                            <div class="col-sm-4">
                                @if(file_exists('assets/front/images/news-img/'.$value->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$value->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-sm-8 caption">
                                <h6>{{ $value->title }}</h6>
                            </div>
                        </div>
                        
                        @if($key>0 && ($key+1)%4==0)
                            </div><div class="col-sm-4">
                        @endif

                        @endforeach
                    </div>
                    <hr>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="ad-wrapper">
                                Ad Space
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        **** ad space 
        <div class="ad-wrapper">Ad Space</div>

        
        <div class="footer-wrapper">
            <div class="jumbotron-fluid">
                <div class="row">
                    <div class="col-sm-2">
                        <ul style="list-style: none;">
                        @foreach($footerCategories as $key=>$category)
                            <li class="caption">
                               {{$category->name}}
                            </li>
                        
                            @if($key>0 && ($key+1)%4==0)
                                </ul></div><div class="col-sm-2"><ul style="list-style: none;">
                           @endif

                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row">{{ $allSettings->footer }}</div>
            </div>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>