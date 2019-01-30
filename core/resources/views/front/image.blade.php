
@extends('front.layout.app')
@section('contents')

    <div class="ad-wrapper container mt-5 pt-5"> 
        <div class="row mb-3">
            <div class="col-sm-12">
                Space for ad images
            </div>
        </div>
    </div>

    <div class="imageName-wrapper">
        <div class="container">
            <div class="title">
                {{ $specificImageDetails->title }}
                <hr>
            </div> 
            {{ $specificImageDetails->created_at }}
        </div>
    </div>

    <div class="break-block"></div>

	<div class="imageDetails-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    @if(file_exists('assets/front/images/previews/'.$specificImageDetails->preview))
                        <img src="{{ asset('assets/front/images/previews/'.$specificImageDetails->preview) }}" class="img-fluid pull-left" src="" alt="Responsive image">
                    @else
                        <img src="{{ asset('assets/front/images/setting/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                    @endif

                    <div class="description">
                        {!! $specificImageDetails->description !!}
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

    <div class="comment-wrapper mb-5">

        <div class="container"> 
            <div class="row">
                <div class="col-sm-3">
                    <div class="commentTitle">
                        Comments ( {{ $specificImageDetails->comments->count() }} )
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
                                <input type="hidden" name="commentableType" value="App\News">
                                <input type="hidden" name="commentableId" value="{{ $specificImageDetails->id }}">

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

                    @foreach($specificImageDetails->comments as $comment)

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