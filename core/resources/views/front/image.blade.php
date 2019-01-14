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
                Glimpse of {{Carbon\Carbon::now()->format('l jS F Y')}}
                <hr>
            </div> 
        </div>
    </div>

    <div class="break-block"></div>

	<div class="imageDetails-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8"> 

                    <div class="w3-content" style="max-width:1200px">

                        @foreach($specificImageDetails->preview as $preview)
                        <img class="mySlides" src="{{ asset('assets/front/images/image-img/'.$preview) }}" style="width:100%;display:none">
                        @endforeach

                        <div class="w3-row-padding w3-section">
                            
                            @foreach($specificImageDetails->preview as $preview)
                            <div class="w3-col s4">
                                <img class="demo w3-opacity w3-hover-opacity-off" src="{{ asset('assets/front/images/image-img/'.$preview) }}" style="width:100%;cursor:pointer" onclick="currentDiv(1)">
                            </div>
                            @endforeach

                        </div>
                        
                    </div>

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