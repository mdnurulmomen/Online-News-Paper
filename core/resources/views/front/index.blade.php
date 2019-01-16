@extends('front.layout.app')

@section('contents')

    <div class="ad-wrapper">Ad Space</div>

    <div class="date-wrapper">
        <div class="container-fluid">
            <div class="row">
                <span class="location"> <i class="fas fa-map-marker-alt"></i> Dhaka </span>
                <span class="date"> {{Carbon\Carbon::now()->format('l jS F Y')}} </span>
            </div>  
        </div>
    </div>
    
    <div class="headlines-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <a href="{{ url('news/'.array_first($headlines)->id) }}"> 
                                @if(file_exists('assets/front/images/news-img/'.array_first($headlines)->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($headlines)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="captionUpper">
                                    {{ array_first($headlines)->title }}
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row  mb-3">
                    @foreach($headlines as $key => $value)
                        @if($key > 0)
                            <div class="col-sm-6">
                                <div class="bg-white">
                                    <a href="{{ url('news/'.$value->id) }}"> 
                                        @if( file_exists('assets/front/images/news-img/'.$value->picpath) )
                                            <img src="{{ asset('assets/front/images/news-img/'.$value->picpath) }}" class="img-fluid" alt="Responsive image">
                                        @else
                                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                        @endif
                                           
                                        <div class="title">
                                           {{ $value->title }}
                                        </div>
                                    </a>
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
                        <a href="{{ url('news/'.$subHeadline->id) }}"> 
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
                        </a>
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

    <div class="ad-wrapper container">Ad Space</div>

    
    <div class="media-wrapper">
        <div class="container-fluid">

            <div class="row categoryName">
                Images & Videos 
            </div>
            
            <div class="row">
                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="">
                            <div class="title">
                                <a href="{{ url('image/'.array_first($allImages)->id) }}"> {{ array_first($allImages)->title }} </a>
                            </div>
                            
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
                            <a href="{{ url('image/'.$value->id) }}">
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
                    <div class="mb-3">
                        <a href="{{ url('video/'.array_first($allVideos)->id) }}"> 
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ array_first($allVideos)->videoaddress }}"  frameborder="0" allowfullscreen></iframe>
                            </div>
                            <div class="title">
                                {{ array_first($allVideos)->title }} 
                            </div>
                        </a>
                    </div>
                    <hr>
                    @foreach($allVideos as $key=>$video)
                    
                    @if($key>0)
                    <a href="{{ url('video/'.$video->id) }}">
                        <div class="parallal">
                            <div class="image">
                               <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ $video->videoaddress }}" allowfullscreen></iframe>
                                </div>   
                            </div>
                            <div class="title">
                                {{ $video->title }}
                            </div>
                        </div>
                    </a>                       
                    <hr>
                    @endif

                    @endforeach
                </div>
            </div>
            
            
        </div>
    </div>

    <div class="break-block"></div>

    <div class="firstPrioritizedCategroy-wrapper">
        <div class="container-fluid">
        <div class="categoryName"> {{ $categoryNames[0]->name }} </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @foreach($categorizedNews[0] as $key => $value)
                        @if($key < 6 )
                        <div class="col-md-4 mb-3">
                            <a href="{{ url('news/'.$value->id) }}"> 
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
                            </a>
                        </div>

                            @if($key>0 && $key%3==0)
                                </div><div class="row">
                            @endif

                        @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 ad-wrapper"> Space for ad images </div>
            </div>
        </div>
    </div>
    
    <div class="secondPrioritizedCategory">
        <div class="container-fluid">
        <div class="categoryName"> {{ $categoryNames[1]->name }} </div>
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ url('news/'.array_first($categorizedNews[1])->id) }}"> 
                                <div class="bg-white"> 
                                @if(file_exists('assets/front/images/news-img/'.array_first($categorizedNews[1])->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($categorizedNews[1])->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->defaultpic) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                    <div class="title">
                                       {{ array_first($categorizedNews[1])->title }} 
                                    </div>
                                    <div class="description">
                                       {{ str_limit(array_first($categorizedNews[1])->description, 60) }} 
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            @foreach($categorizedNews[1] as $key => $value)
                            
                            @if($key>0)
                            <a href="{{ url('news/'.$value->id) }}">     
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
                            </a>
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
        <div class="container-fluid">
            <div class="categoryName"> {{ $categoryNames[2]->name }} </div>
            <div class="row">

            @foreach($categorizedNews[2] as $key => $thirdCategorizedNews)
                
                @if($key < 3)
                <div class="col-md-3">
                    <a href="{{ url('news/'.$thirdCategorizedNews->id) }}"> 
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
                    </a>
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
        <div class="container-fluid">
        <div class="categoryName"> {{ $categoryNames[3]->name }} </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row mb-3">
                    @foreach ($categorizedNews[1] as $key=>$value)
                        <div class="col-sm-6">
                            <a href="{{ url('news/'.$value->id) }}"> 
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
                            </a>
                        </div>
                        @if($key>0 && ($key+1)%2==0)
                            </div><div class="row mb-3">
                        @endif
                        
                        <hr>
                    @endforeach
                    </div>
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

@endsection