@extends('front.layout.app')

@section('contents')

    <div class="ad-wrapper container mt-5 pt-5">
        
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
            <div class="row mb-5">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-sm-8 mb-4">
                            <a href="{{ url('news/'.array_first($allRelatedNews)->id) }}"> 
                                @if(file_exists('assets/front/images/news/'.array_first($allRelatedNews)->preview))
                                    <img src="{{ asset('assets/front/images/news/'.array_first($allRelatedNews)->preview) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="captionUpper">
                                    {{ str_limit(array_first($allRelatedNews)->title, 25) }}
                                </div>
                            </a>
                        </div>

                        <div class="col-sm-4">
                            @foreach($allRelatedNews as $key => $nextNews)

                            @if($key>0 && $key < 3)
                            <a href="{{ url('news/'.$nextNews->id) }}" class="mb-4"> 
                                @if(file_exists('assets/front/images/news/'.$nextNews->preview))
                                    <img src="{{ asset('assets/front/images/news/'.$nextNews->preview) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="captionUpperSecond">
                                    {{ str_limit($nextNews->title, 25) }} 
                                </div>
                            </a>
                            <hr>
                            @endif

                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
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
            
            <div class="break-block"></div>

            <div class="row mb-3">
                @foreach($allRelatedNews as $key => $nextNews)
                    @if($key>2 && $key < 7)
                    <div class="col-md-3 mb-3">
                        <div class="bg-white">
                            <a href="{{ url('news/'.$nextNews->id) }}"> 
                                @if(file_exists('assets/front/images/news/'.$nextNews->preview))
                                    <img src="{{ asset('assets/front/images/news/'.$nextNews->preview) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="title">
                                    {{ str_limit($nextNews->title, 25) }} 
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
                    <div class="col-md-3 mb-3">
                        <div class="bg-white">
                            <a href="{{ url('news/'.$nextNews->id) }}"> 
                                @if(file_exists('assets/front/images/news/'.$nextNews->preview))
                                    <img src="{{ asset('assets/front/images/news/'.$nextNews->preview) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="title">
                                    {{ str_limit($nextNews->title, 25) }}
                                </div>
                            </a>
                        </div>
                    </div>
                    @endif

                @endforeach
            </div>          
        </div>
    </div>

    <div class="ad-wrapper container">
        
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

                    @if($key>10 && $key < 19)
                    <div class="col-sm-6">
                        <a href="{{ url('news/'.$moreRelatedNews->id) }}"> 
                            <div class="parallal">
                                <div class="image">
                                    @if(file_exists('assets/front/images/news/'.$moreRelatedNews->preview))
                                        <img src="{{ asset('assets/front/images/news/'.$moreRelatedNews->preview) }}" class="img-fluid pull-left" src="" alt="Responsive image">
                                    @else
                                        <img src="{{ asset('assets/front/images/setting/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                    @endif
                                </div>
                                <div class="title">
                                    {{ str_limit($moreRelatedNews->title, 25) }} 
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