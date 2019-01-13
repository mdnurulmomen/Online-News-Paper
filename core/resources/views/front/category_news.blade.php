@extends('front.layout.app')

@section('contents')

	<div class="categoryName-wrapper mt-5 pt-5">
        <div class="container">
    		<div class="categoryName">
                {{ $categoryName }}
            </div> 
        </div>
	</div>

    <div class="break-block"></div>

	<div class="categoryNews-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row mb-5">
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
                            <a href="{{ url('news/'.$nextNews->id) }}"> 
                                @if(file_exists('assets/front/images/news-img/'.$nextNews->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$nextNews->picpath) }}" class="img-fluid" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                                <div class="captionUpper">
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
        </div>
    </div>