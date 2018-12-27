<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function showIndexMethod(){

        $allCategories = Category::all('name', 'url');

        $breakingNews
//        $headlines = Post::all()

        return view('front.layout.app', compact('allCategories'));
    }
}
