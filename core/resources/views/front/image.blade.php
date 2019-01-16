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

                    @if(file_exists('assets/front/images/news-img/'.$specificImageDetails->preview))
                        <img src="{{ asset('assets/front/images/preview-img/'.$specificImageDetails->preview) }}" class="img-fluid pull-left" src="" alt="Responsive image">
                    @else
                        <img src="{{ asset('assets/front/images/setting-img/'.$allSettings->default_icon) }}" class="img-fluid" alt="Responsive image">
                    @endif

                    <div class="description">
                        {{ $specificImageDetails->description }}
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