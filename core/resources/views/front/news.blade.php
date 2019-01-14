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
        <div class="container">
            <div class="categoryName">
                {{ $categoryName }}
                <hr>
            </div> 
        </div>
    </div>

    <div class="break-block"></div>

	<div class="newsDetails-wrapper mb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="title">
                        {{ $specificNewsDetails->title }}
                    </div>
                    <div class="newsDetails">
                        @if(file_exists('assets/front/images/news-img/'.$specificNewsDetails->picpath))
                            <img src="{{ asset('assets/front/images/news-img/'.$specificNewsDetails->picpath) }}" class="img-fluid" alt="Responsive image">
                        @else
                            <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                        @endif

                        <div class="description">
                            {{ $specificNewsDetails->description }}
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

    <div class="break-block"></div>
    
    <div class="ad-wrapper container mb-3">  
        <div class="row mb-3">
            <div class="col-sm-12">
                Space for ad images
            </div>
        </div>
     </div>


    <div class="comment-wrapper">
        <div class="container">
            <div class="row">
                
                @foreach($allRelatedComments as $comment)

                    <div class="col-sm-12"> 
                        <div class="parallal">
                            <div class="image">
                                @if(file_exists('assets/front/images/users-img/'.$comment->relatedUser->picpath))
                                    <img src="{{ asset('assets/front/images/users-img/'.$comment->relatedUser->picpath) }}" class="img-fluid pull-left" src="" alt="Responsive image">
                                @else
                                    <i class="fas fa-user"></i>
                                @endif
                            </div>
                            <div class="title">
                                {{ $comment->relatedUser->username }}
                            </div>
                            <div class="description">
                                {{ $comment->description }}
                            </div>
                        </div>
                    </div>

                    <hr>
                @endforeach

            </div>
         </div>
    </div>

    <div class="moreRelatedNews">
        <div class="container">
            <div class="row">

                @foreach($moreRelatedNews as $key => $relatedNews)

                    <div class="col-sm-3">
                        <a href="{{ url('news/'.$relatedNews->id) }}">    
                                
                            @if(file_exists('assets/front/images/news-img/'.$relatedNews->picpath))
                                <img src="{{ asset('assets/front/images/news-img/'.$relatedNews->picpath) }}" class="img-fluid pull-left" src="" alt="Responsive image">
                            @else
                                <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                            @endif
                            
                            <div class="title">
                                {{ $relatedNews->title }}
                            </div>
                           
                        </a>
                        <hr>
                    </div>

                    @if($key%4==0)
                    </div>
                    <div class="ad-wrapper"> Ad Space </div>
                    <div class="row">
                    @endif

                @endforeach
                    
            </div>
         </div>
    </div>