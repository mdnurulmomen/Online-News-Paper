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
                Video
                <hr>
            </div> 
        </div>
    </div>

    <div class="break-block"></div>

	<div class="video-wrapper mb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ $specificVideoDetails->url }}" allowfullscreen></iframe>
                    </div>

                    <div class="title">
                        {{ $specificVideoDetails->title }}
                    </div>
                </div>

                <div class="col-md-4">

                    <div class="row mb-3">
                        <div class="col-sm-12 ad-wrapper">
                            Space for ad images
                        </div>
                    </div>
                    
                    @foreach($recentVideoDetails as $key => $recentVideo)
                    <a href="{{ url('video/'.$recentVideo->id) }}"> 
                        <div class="parallal">
                            <div class="image">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" src="{{ $recentVideo->url }}" allowfullscreen></iframe>
                                </div>
                            </div>

                            <div class="title">
                                {{ $recentVideo->title }}
                            </div>
                        </div>
                    </a>
                    <hr>
                    @endforeach
                </div>
            </div>         
        </div>
    </div>

    <div class="break-block"></div>

    <div class="comment-wrapper">
        <div class="container-fluid">
                
            <div class="row">
                <div class="col-sm-3">
                    <div class="commentTitle">
                        Comments ( {{ $specificVideoDetails->comments->count() }} )
                    </div>
                </div>

                <div class="col-sm-9">  

                    @if(Auth::check())
                    <div class="leave-comments">
                        <div class="item-box-light-lg">
                            <h2 class="title">Leave Your Comment</h2>

                            <form action="{{ route('user.comment_submit') }}" method="post">
                                @csrf  
                                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="commentableType" value="App\Video">
                                <input type="hidden" name="commentableId" value="{{ $specificVideoDetails->id }}">

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

                    @foreach($specificVideoDetails->comments as $comment)

                    <div class="comment-list-item pt-3 ">
                        <div class="float-left pr-3 mb-3 user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="comment">
                            {{ $comment->body }}
                        </div>
                        <div>
                            On <small>{{ $comment->created_at->format('jS F Y') }}</small>
                        </div>
                        
                    </div>

                    <hr>

                    @endforeach

                </div>
            </div>

         </div>
    </div>