<?php

namespace App\Http\Controllers;

use App\Category;

use App\News;
use App\Video;
use App\Setting;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function showIndexMethod(){
        $allCategories = Category::all('name', 'url');
        $allSettings = Setting::first();
        $headlines = $allSettings->news_headlines->slice(0,4);
        $distinctCategoryNews = News::distinct('category_id')->where('status', 1)->select('category_id', 'title', 'picpath', 'created_at')->get();
        $allVideos = Video::select('title', 'preview', 'videopath')->orderBy('created_at', 'desc')->take(3)->get();
        $categoryPrioritized = array_slice($allSettings->prioritized_categories, 0, 2);
        $categorizedFrontNews = News::select('id','category_id', 'title', 'picpath', 'status', 'created_at')->whereIn('category_id', $categoryPrioritized)->where('status', 1)
            ->orderByRaw('FiELD(category_id,'.implode(',', $categoryPrioritized).')')->orderBy('created_at', 'desc')->take(10)->get();

        return view('front.layout.app2', compact('allCategories','allSettings', 'headlines', 'distinctCategoryNews', 'allVideos', 'categorizedFrontNews'));
    }



    public  function  showCategoryNews($categoryUrl){
        $categoryId = Category::where('url', $categoryUrl)->first()->id;
        $allRelatedNews = News::all()->where('category_id', $categoryId)->where('status', 1);
        return $allRelatedNews;
    }

}
