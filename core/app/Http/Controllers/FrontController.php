<?php

namespace App\Http\Controllers;

use App\Category;

use App\News;
use App\Image;
use App\Video;
use App\Setting;
use App\Comment;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function showIndexMethod(){

        $allSettings = Setting::first();

        $allCategories = Category::all();

        $headerCategories = Category::whereIn('id', json_decode($allSettings->header_categories))->get();        
        
        $headlines = $allSettings->news_headlines->slice(0,7);
        $subHeadlines = $allSettings->news_subheadlines->slice(0,12);

        $allImages = Image::orderBy('created_at', 'DESC')->take(5)->get();

        $allVideos = Video::orderBy('created_at', 'desc')->take(3)->get();



        $categoryPrioritized = $allSettings->prioritized_categories;
        $categoryNames = Category::select('name')->whereIn('id', $categoryPrioritized)->orderByRaw('FIELD(id,'.implode(',',$categoryPrioritized).')')->get();

        foreach ($categoryPrioritized as $key => $value) {

            $categorizedNews[] = News::where('category_id', $value)->where('status', 1)->orderBy('created_at', 'desc')->take(6)->get();
            // $categorizedNews[] = News::where('category_id', $value)->where('status', 1)->get();
        }

        $footerCategories = Category::all()->whereIn('id', json_decode($allSettings->footer_categories));

        return view('front.index', compact('allSettings', 'allCategories', 'headerCategories', 'headlines', 'subHeadlines', 'allImages', 'allVideos', 'categoryNames', 'categorizedNews', 'footerCategories'));
    }

    public  function  showCategoryNews($categoryUrl){

        $categoryDetails = Category::where('url', $categoryUrl)->first();
        $categoryName = $categoryDetails->name;
        $categoryId = $categoryDetails->id;

        $allRelatedNews = News::where('category_id', $categoryId)->where('status', 1)->get();
        // $allRelatedNews = News::select('id', 'title', 'picpath', 'description', 'status', 'created_at')->where('category_id', $categoryId)->where('status', 1)->get();

        $allSettings = Setting::first();

        $allCategories = Category::all();

        $headerCategories = Category::whereIn('id', json_decode($allSettings->header_categories))->get();

        $footerCategories = Category::whereIn('id', json_decode($allSettings->footer_categories))->get();

        return view('front.category_news', compact('allSettings', 'allCategories', 'headerCategories', 'categoryName', 'allRelatedNews', 'footerCategories'));
    }

    public  function  showSpecificNews($newsId){
        
        $specificNewsDetails = News::where('id', $newsId)->first();
        $categoryName = $specificNewsDetails->category->name;
        // $allRelatedComments = Comment::where('news_id', $specificNewsDetails->id)->get();
        $moreRelatedNews = News::where('category_id', $specificNewsDetails->category_id)->where('status', 1)->get();


        $allSettings = Setting::first();
        $allCategories = Category::all();
        $headerCategories = Category::whereIn('id', json_decode($allSettings->header_categories))->get();

        $footerCategories = Category::whereIn('id', json_decode($allSettings->footer_categories))->get();

        return view('front.news', compact('allSettings', 'allCategories', 'headerCategories', 'categoryName', 'specificNewsDetails', 'moreRelatedNews', 'footerCategories'));
    }

    public  function  showSpecificImage($imageId){

        $allSettings = Setting::first();
        $allCategories = Category::all();
        $headerCategories = Category::select('id', 'name', 'url')->whereIn('id', json_decode($allSettings->header_categories))->get();

        $specificImageDetails = Image::where('id', $imageId)->first();
        
        $footerCategories = Category::all()->whereIn('id', json_decode($allSettings->footer_categories));

        return view('front.image', compact('allSettings', 'allCategories', 'headerCategories', 'specificImageDetails', 'footerCategories'));
    }

    public  function  showSpecificVideo($videoId){

        $allSettings = Setting::first();
        $allCategories = Category::all();
        $headerCategories = Category::select('id', 'name', 'url')->whereIn('id', json_decode($allSettings->header_categories))->get();

        $specificVideoDetails = Video::where('id', $videoId)->first();
        $recentVideoDetails = Video::select()->orderBy('created_at', 'DESC')->take(6)->get();

        $allRelatedComments = Comment::select('description', 'user_id')->where('id', $specificVideoDetails->id)->get();

        $footerCategories = Category::all()->whereIn('id', json_decode($allSettings->footer_categories));

        return view('front.video', compact('allSettings', 'allCategories', 'headerCategories', 'specificVideoDetails', 'recentVideoDetails', 'allRelatedComments', 'footerCategories'));
    }
}
