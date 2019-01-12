<?php

namespace App\Http\Controllers;

use App\Category;

use App\News;
use App\Image;
use App\Video;
use App\Setting;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function showIndexMethod(){

        $allSettings = Setting::first();

        $allCategories = Category::select('id', 'name', 'url')->get();

        $headerCategories = Category::select('id', 'name', 'url')->whereIn('id', json_decode($allSettings->header_categories))->get();        
        
        $headlines = $allSettings->news_headlines->slice(0,7);
        $subHeadlines = $allSettings->news_subheadlines->slice(0,12);

        $allImages = Image::select('id', 'title', 'description', 'preview')->orderBy('created_at', 'DESC')->take(5)->get();

        $allVideos = Video::select('title', 'preview', 'videoaddress')->orderBy('created_at', 'desc')->take(3)->get();



        $categoryPrioritized = $allSettings->prioritized_categories;
        $categoryNames = Category::select('name')->whereIn('id', $categoryPrioritized)->get();

        foreach ($categoryPrioritized as $key => $value) {

            $categorizedNews[] = News::select('id','category_id', 'title', 'picpath', 'status', 'created_at')->where('category_id', $value)->where('status', 1)->orderBy('created_at', 'desc')->take(6)->get();
            // $categorizedNews[] = News::where('category_id', $value)->where('status', 1)->get();
        }

        $footerCategories = Category::all('id', 'name', 'url')->whereIn('id', json_decode($allSettings->footer_categories));

        return view('front.layout.app2', compact('allSettings', 'allCategories', 'headerCategories', 'headlines', 'subHeadlines', 'allImages', 'allVideos', 'categoryNames', 'categorizedNews', 'footerCategories'));
    }

    public  function  showCategoryNews($categoryUrl){
        $categoryId = Category::where('url', $categoryUrl)->first()->id;
        $allRelatedNews = News::all()->where('category_id', $categoryId)->where('status', 1);

        return $allRelatedNews;
    }

}
