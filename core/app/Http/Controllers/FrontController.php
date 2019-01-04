<?php

namespace App\Http\Controllers;

use App\Category;

use App\News;
use App\Setting;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function showIndexMethod(){
        $allCategories = Category::all('name', 'url');
        $headlines = Setting::first()->news_headlines;
        $distinctCategoryNews = News::distinct('category_id')->where('status', 1)->select('category_id', 'title', 'picpath', 'created_at')->get();
        $allEditorialNews = News::select('category_id', 'title', 'picpath', 'created_at')->where('category_id', 12)->where('status', 1)->get();
        $allInternationalNews = News::select('category_id', 'title', 'picpath', 'created_at')->where('category_id', 13)->where('status', 1)->get();

        $allNews = News::all()->where('status', 1);
        return view('front.layout.app', compact('allCategories', 'headlines', 'distinctCategoryNews', 'allEditorialNews', 'allInternationalNews', 'allNews'));
    }
}
