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
                <hr>
            </div> 
        </div>
    </div>

    <div class="break-block"></div>

	<div class="newsDetails-wrapper mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="title">
                        {{ $specificNewsDetails->title }} {{ $specificNewsDetails->id }}
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

                <div class="col-md-5">

                    <div class="row mb-3">
                        <div class="col-sm-12 ad-wrapper">
                            Space for ad images
                        </div>
                    </div>
                    
                    @foreach($moreRelatedNews as $key => $relatedNews)
                       
                    @if($key < 6)
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

                     <div class="row mb-3">
                        <div class="col-sm-12 ad-wrapper">
                            Space for ad images
                        </div>
                    </div>

                </div>
            </div>         
        </div>
    </div>

    <div class="break-block"></div>

    <div class="comment-wrapper mb-5">

        <div class="container-fluid"> 
            <div class="row">
                <div class="col-sm-3">
                    <div class="commentTitle">
                        Comments ( {{ $specificNewsDetails->comments->count() }} )
                    </div>
                </div>

                <div class="col-sm-9">  

                    @if(Auth::check())
                    <div class="leave-comments">
                        <div class="item-box-light-lg">
                            <h2 class="title">Leave Your Comment</h2>

                            <form action="{{ route('user.comment.submit') }}" method="post">
                                @csrf  
                                <input type="hidden" name="user" value="{{ Auth::user()->id }}">

                                <div class="form-group">
                                    <textarea placeholder="Your Message*" class="textarea form-control" name="body" id="form-message" rows="8" cols="20"></textarea>
                                    <div class="help-block with-errors" required></div>
                                </div>
                           
                                <div class="form-group mb-none">
                                    <button type="submit" class="btn btn-success"> Comment</button>
                                </div>         
                            </form>
                        </div>
                    </div>

                    @else
                    <div class="title pt-5 pb-5">
                        Please  <a href="{{ route('user.login') }}" class="btn btn-success" role="button">Login</a>  or  <a href="{{ route('user.register') }}" class="btn btn-primary" role="button">Sign up</a> to Comment
                    </div>
                    @endif


                    @foreach($specificNewsDetails->comments as $comment)
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
                    <hr>
                    @endforeach

                </div>
            </div>

           
            
                
            

            

            <div class="row">
                
            </div>

         </div>
    </div>

    <div class="moreRelatedNews">
        <div class="container-fluid">
            <div class="row">
            @foreach($moreRelatedNews as $key => $relatedNews)

                @if($key > 5 && $key < 14)
                <div class="col-sm-3">
                    <div class="bg-white">
                        
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

                    </div>       
                    <hr>
                </div>


                @if(($key-5)%4==0)
                </div>
                <div class="ad-wrapper"> Ad Space </div>
                <div class="break-block"></div>
                <div class="row">
                @endif


                @endif
            @endforeach   
            </div>
         </div>
    </div>