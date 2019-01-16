@extends('front.layout.app')

@section('contents')

    <div class="ad-wrapper container-fluid mt-5 pt-5">
        
        <div class="row mb-3">
            <div class="col-sm-12">
                Space for ad images
            </div>
        </div>
        
     </div>

	<div class="categoryName-wrapper">
        <div class="container-fluid">
    		<div class="categoryName">
                {{ $categoryName }}
            </div> 
        </div>
	</div>

    <div class="break-block"></div>

	<div class="categoryNews-wrapper">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-8">
                            <a href="{{ url('news/'.array_first($allRelatedNews)->id) }}"> 
                                @if(file_exists('assets/front/images/news-img/'.array_first($allRelatedNews)->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.array_first($allRelatedNews)->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="captionUpper">
                                    {{ array_first($allRelatedNews)->title }}
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-4">
                            @foreach($allRelatedNews as $key => $nextNews)

                            @if($key>0 && $key < 3)
                            <a href="{{ url('news/'.$nextNews->id) }}" class="mb-3"> 
                                @if(file_exists('assets/front/images/news-img/'.$nextNews->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$nextNews->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="captionUpperSecond">
                                    {{ $nextNews->title }}
                                </div>
                            </a>
                            @endif

                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="row">
                        <div class="col-sm-12 ad-wrapper">
                            Space for ad images
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                @foreach($allRelatedNews as $key => $nextNews)
                    @if($key>2 && $key < 7)
                    <div class="col-md-3">
                        <div class="bg-white">
                            <a href="{{ url('news/'.$nextNews->id) }}"> 
                                @if(file_exists('assets/front/images/news-img/'.$nextNews->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$nextNews->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="title">
                                    {{ $nextNews->title }}
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif

                @endforeach
            </div>

            <div class="row mb-3">
                @foreach($allRelatedNews as $key => $nextNews)
                    
                    @if($key>6 && $key < 11)
                    <div class="col-md-3">
                        <div class="bg-white">
                            <a href="{{ url('news/'.$nextNews->id) }}"> 
                                @if(file_exists('assets/front/images/news-img/'.$nextNews->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$nextNews->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="title">
                                    {{ $nextNews->title }}
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif

                @endforeach
            </div>          
        </div>
    </div>

    <div class="ad-wrapper container-fluid">
        
        <div class="row mb-3">
            <div class="col-sm-12">
                Space for ad images
            </div>
        </div>
        
     </div>

     <div class="break-block"></div>

    <div class="moreRelatedNews">
        <div class="container-fluid">
            <div class="row mb-3">

                @foreach($allRelatedNews as $key => $moreRelatedNews)

                    @if($key>10)
                    <div class="col-sm-6">
                        <a href="{{ url('news/'.$moreRelatedNews->id) }}"> 
                            <div class="parallal">
                                <div class="image">
                                    @if(file_exists('assets/front/images/news-img/'.$moreRelatedNews->picpath))
                                        <img src="{{ asset('assets/front/images/news-img/'.$moreRelatedNews->picpath) }}" class="img-fluid pull-left" src="" alt="Responsive image">
                                    @else
                                        <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                    @endif
                                </div>
                                <div class="title">
                                    {{ $moreRelatedNews->title }}
                                </div>
                            </div>
                        </a>
                        <hr>
                    </div>

                        @if($key%2==0)
                        </div><div class="row mb-3">
                        @endif
                    @endif
                @endforeach
                    
            </div>
         </div>
    </div>