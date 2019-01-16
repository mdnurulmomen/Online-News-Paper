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
                <hr>
            </div> 
        </div>
    </div>

    <div class="break-block"></div>

	<div class="newsDetails-wrapper mb-3">
        <div class="container-fluid">
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
                            {!! $specificNewsDetails->description !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="row mb-3">
                        <div class="col-sm-12 ad-wrapper">
                            Space for ad images
                        </div>
                    </div>
                    
                    @foreach($moreRelatedNews as $key => $relatedNews)
                       
                    @if($key < 4)
                    <a href="{{ url('news/'.$relatedNews->id) }}"> 
                        <div class="parallal">
                            <div class="image">
                                @if(file_exists('assets/front/images/news-img/'.$relatedNews->picpath))
                                    <img src="{{ asset('assets/front/images/news-img/'.$relatedNews->picpath) }}" class="img-fluid pull-left" src="" alt="Responsive image">
                                @else
                                    <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                                @endif
                            </div>
                            <div class="title">
                                {{ $relatedNews->title }}
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

    <div class="comment-wrapper">
        <div class="container-fluid">
                
            @if(Auth::check())
            <div class="row">
                <div class="leave-comments">
                    <h2 class="title mb-40 pb-20">Leave Comments</h2>
                    <div class="item-box-light-lg">
                        <form action="{{ route('submit.comment.form') }}" method="post">
                                
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="news_id" value="{{ $specificNewsDetails->id }}">

                            <div class="form-group">
                                <textarea placeholder="Message*" class="textarea form-control" name="message" id="form-message" rows="8" cols="20"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                       
                            <div class="form-group mb-none">
                                <button type="submit" class="btn-ftg-ptp-45"> Comment</button>
                            </div>
                                
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                @foreach($specificNewsDetails->comments as $comment)
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
                                {{ $comment->body }}
                            </div>
                        </div>
                    </div>

                    <hr>
                @endforeach
            </div>

         </div>
    </div>

    <div class="moreRelatedNews">
        <div class="container-fluid">
            <div class="row">
            @foreach($moreRelatedNews as $key => $relatedNews)

                @if($key > 3)
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


                @if($key>4 && ($key+1)%4==0)
                </div>
                <div class="ad-wrapper"> Ad Space </div>
                <div class="row">
                @endif


                @endif
            @endforeach   
            </div>
         </div>
    </div>