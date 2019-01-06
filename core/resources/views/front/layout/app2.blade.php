<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <title>News Paper</title>
      <style>

      </style>
  </head>

  <body>
        <div class="header-wrapper">
            <div class="container">
                <div class="row">
                    <nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
                        <a class="navbar-brand" href="#">
                            <img src="{{asset('assets/front/images/setting-img/'.$allSettings->logo)}}">
                        </a>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Category-1 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Category-2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Category-3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Category-4</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Category-5</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Category-6</a>
                                </li>

                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        **** ad space
        <div class="ad-wrapper"></div>

        **** Headlines
        <div class="headlines-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-8">
                                    @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                        <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                    @else
                                        <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                    @endif
                                <div class="caption">
                                    <p>{{ array_first($headlines)->title }}</p>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                                <img class="img-fluid pull-left" src="" alt="Responsive image">
                                            @else
                                                <img class="img-fluid pull-left" src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" alt="Responsive image">
                                            @endif
                                        </div>
                                        <div class="col-sm-8">
                                            <p>Donec id elit non mi porta gravida at eget metus. </p>
                                        </div>
                                    </div>

                                {{--<ul style="list-style: none;">
                                    <li>
                                        <span>
                                            <img class="img-fluid img-left" src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}"/>
                                        </span>
                                        <span>
                                            Donec id elit non mi porta gravida at eget metus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.
                                        </span>
                                    </li>
                                </ul>--}}

                                <div class="row">
                                    <div class="col-sm-4">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="col-sm-8">
                                        {{ array_first($headlines)->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-sm-12">
                                Space for ad images
                            </div>
                        </div>
                    </div>
                </div>

                <div class="break-block"></div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">

                                    <div class="col-sm-12 col-md-6">
                                            @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                                <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                            @else
                                                <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                            @endif
                                        <div class="caption">
                                            <p>{{ array_first($headlines)->title }}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                        <div class="caption">
                                            <p>{{ array_first($headlines)->title }}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                        <div class="caption">
                                            <p>{{ array_first($headlines)->title }}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                        <div class="caption">
                                            <p>{{ array_first($headlines)->title }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="col-xs-8 col-sm-8">
                                        <p>{{ array_first($headlines)->title }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4 col-sm-4">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="col-xs-8 col-sm-8">
                                        <p>{{ array_first($headlines)->title }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4 col-sm-4">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="col-xs-8 col-sm-8">
                                        <p>{{ array_first($headlines)->title }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-4 col-sm-4">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="col-xs-8 col-sm-8">
                                        <p>{{ array_first($headlines)->title }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($headlines)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-xs-8 col-sm-8">
                                <p>{{ array_first($headlines)->title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="break-block"></div>

        **** ad space
        <div class="ad-wrapper"></div>

        **** Images and Video
        <div class="media-wrapper">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 Image">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                        <div class="col-md-4 Video">
                            <div class="row">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ array_first($allVideos)->videopath }}" allowfullscreen></iframe>
                                </div>
                                <div class="caption">{{ array_first($allVideos)->title }} </div>
                            </div>
                            <hr>
                            @foreach($allVideos as $video)
                            <div class="row">
                                <div class="col-md-4">
                                    {{ $video->title }}
                                </div>
                                <div class="col-md-8">
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <iframe class="embed-responsive-item" src="{{ $video->videopath }}" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                            <div class="row"></div>
                            <div class="row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        ****** First Prioritized Category
        <div class="categoryName"></div>
        <div class="firstPrioritizedCategroy-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="caption">
                                    {{ array_first($categorizedFrontNews)->title }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="caption">
                                    {{ array_first($categorizedFrontNews)->title }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4"> Space for ad images </div>
                </div>
            </div>
        </div>

        ****** Second Prioritized Category
        <div class="categoryName"></div>
        <div class="secondPrioritizedCategory">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="caption">
                                    {{ array_first($categorizedFrontNews)->title }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        {{ array_first($categorizedFrontNews)->title }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        {{ array_first($categorizedFrontNews)->title }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                            <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                    </div>
                                    <div class="col-md-8">
                                        {{ array_first($categorizedFrontNews)->title }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">Space for ad images</div>
                </div>
            </div>
        </div>

        **** Third Prioritized Category
        <div class="categoryName"></div>
        <div class="thirdPrioritizedCategory">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-4">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-md-8">
                                {{ array_first($categorizedFrontNews)->title }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-4">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-md-8">
                                {{ array_first($categorizedFrontNews)->title }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-4">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-md-8">
                                {{ array_first($categorizedFrontNews)->title }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        Space for Ad Image
                    </div>
                </div>
            </div>
        </div>

        **** Fourth Prioritized Category
        <div class="categoryName"></div>
        <div class="fourthPrioritizedCategory">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-4">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-sm-8">
                                {{ array_first($categorizedFrontNews)->title }}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-4">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-sm-8">
                                {{ array_first($categorizedFrontNews)->title }}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-4">
                        <div class="row">
                            <div class="col-sm-4">
                                @if(file_exists(asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath)))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedFrontNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="col-sm-8">
                                {{ array_first($categorizedFrontNews)->title }}
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>

        **** ad space
        <div class="ad-wrapper"></div>

        ****** Footer
        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <ul style="list-style: none;">
                        <li>
                            CategoryName-1
                        </li>
                            <li>
                            CategoryName-2
                        </li><li>
                            CategoryName-3
                        </li><li>
                            CategoryName-4
                        </li><li>
                            CategoryName-5
                        </li><li>
                            CategoryName-6
                        </li>
                        </ul>
                    </div>

                    <div class="col-sm-2">
                        <ul style="list-style: none;">
                            <li>
                                CategoryName-1
                            </li><li>
                                CategoryName-2
                            </li><li>
                                CategoryName-3
                            </li><li>
                                CategoryName-4
                            </li><li>
                                CategoryName-5
                            </li><li>
                                CategoryName-6
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-2">
                        <ul style="list-style: none;">
                            <li>
                                CategoryName-1
                            </li><li>
                                CategoryName-2
                            </li><li>
                                CategoryName-3
                            </li><li>
                                CategoryName-4
                            </li><li>
                                CategoryName-5
                            </li><li>
                                CategoryName-6
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-2">
                        <ul style="list-style: none;">
                            <li>
                                CategoryName-1
                            </li><li>
                                CategoryName-2
                            </li><li>
                                CategoryName-3
                            </li><li>
                                CategoryName-4
                            </li><li>
                                CategoryName-5
                            </li><li>
                                CategoryName-6
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-2">
                        <ul style="list-style: none;">
                            <li>
                                CategoryName-1
                            </li><li>
                                CategoryName-2
                            </li><li>
                                CategoryName-3
                            </li><li>
                                CategoryName-4
                            </li><li>
                                CategoryName-5
                            </li><li>
                                CategoryName-6
                            </li>
                        </ul>
                    </div>

                    <div class="col-sm-2">
                        <ul style="list-style: none;">
                            <li>
                                CategoryName-1
                            </li><li>
                                CategoryName-2
                            </li><li>
                                CategoryName-3
                            </li><li>
                                CategoryName-4
                            </li><li>
                                CategoryName-5
                            </li><li>
                                CategoryName-6
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>