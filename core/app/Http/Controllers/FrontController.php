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

        $allCategories = Category::all('id', 'name', 'url');

        $headerCategories = Category::select('id', 'name', 'url')->whereIn('id', json_decode($allSettings->header_categories))->get();        
        
        $headlines = $allSettings->news_headlines->slice(0,7);
        $subHeadlines = $allSettings->news_subheadlines->slice(0,12);

        $allImages = Image::select('id', 'title', 'description', 'preview')->orderBy('created_at', 'DESC')->take(5)->get();

        $allVideos = Video::select('id', 'title', 'preview', 'videoaddress')->orderBy('created_at', 'desc')->take(3)->get();



        $categoryPrioritized = $allSettings->prioritized_categories;
        $categoryNames = Category::select('name')->whereIn('id', $categoryPrioritized)->orderByRaw('FIELD(id,'.implode(',',$categoryPrioritized).')')->get();

        foreach ($categoryPrioritized as $key => $value) {

            $categorizedNews[] = News::select('id','category_id', 'title', 'picpath', 'status', 'created_at')->where('category_id', $value)->where('status', 1)->orderBy('created_at', 'desc')->take(6)->get();
            // $categorizedNews[] = News::where('category_id', $value)->where('status', 1)->get();
        }

        $footerCategories = Category::all('id', 'name', 'url')->whereIn('id', json_decode($allSettings->footer_categories));

        return view('front.index', compact('allSettings', 'allCategories', 'headerCategories', 'headlines', 'subHeadlines', 'allImages', 'allVideos', 'categoryNames', 'categorizedNews', 'footerCategories'));
    }

    public  function  showCategoryNews($categoryUrl){

        $categoryDetails = Category::where('url', $categoryUrl)->first();
        $categoryName = $categoryDetails->name;
        $categoryId = $categoryDetails->id;

        $allRelatedNews = News::all()->where('category_id', $categoryId)->where('status', 1);
        // $allRelatedNews = News::select('id', 'title', 'picpath', 'description', 'status', 'created_at')->where('category_id', $categoryId)->where('status', 1)->get();

        $allSettings = Setting::first();

        $allCategories = Category::all('id', 'name', 'url');

        $headerCategories = Category::select('id', 'name', 'url')->whereIn('id', json_decode($allSettings->header_categories))->get();

        $footerCategories = Category::all('id', 'name', 'url')->whereIn('id', json_decode($allSettings->footer_categories));

        return view('front.category_news', compact('allSettings', 'allCategories', 'headerCategories', 'categoryName', 'allRelatedNews', 'footerCategories'));
    }

    public  function  showSpecificNews($newsId){
        
        $specificNewsDetails = News::where('id', $newsId)->first();
        $categoryName = $specificNewsDetails->category->name;
        $allRelatedComments = Comment::all()->where('news_id', $specificNewsDetails->id);
        $moreRelatedNews = News::all()->where('category_id', $specificNewsDetails->category_id)->where('status', 1);


        $allSettings = Setting::first();
        $allCategories = Category::all('id', 'name', 'url');
        $headerCategories = Category::select('id', 'name', 'url')->whereIn('id', json_decode($allSettings->header_categories))->get();

        $footerCategories = Category::all('id', 'name', 'url')->whereIn('id', json_decode($allSettings->footer_categories));

        return view('front.news', compact('allSettings', 'allCategories', 'headerCategories', 'categoryName', 'specificNewsDetails', 'allRelatedComments', 'moreRelatedNews', 'footerCategories'));
    }

    public  function  showSpecificImage($imageId){

        $allSettings = Setting::first();
        $allCategories = Category::all('id', 'name', 'url');
        $headerCategories = Category::select('id', 'name', 'url')->whereIn('id', json_decode($allSettings->header_categories))->get();

        $specificImageDetails = Image::where('id', $imageId)->first();

        var_dump($specificImageDetails->preview);
        exit;

        $footerCategories = Category::all('id', 'name', 'url')->whereIn('id', json_decode($allSettings->footer_categories));

        return view('front.image', compact('allSettings', 'allCategories', 'headerCategories', 'specificImageDetails', 'footerCategories'));
    }

    public  function  showSpecificVideo($videoId){
        $specificVideoDetails = Video::where('id', $videoId)->first();
        return $specificVideoDetails;
    }
}
