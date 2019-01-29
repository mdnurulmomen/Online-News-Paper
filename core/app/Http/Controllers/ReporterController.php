<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use App\Video;
use App\Setting;
use App\Image as ImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ReporterController extends Controller
{
    public function showLoginForm()
    {
        return view('reporter.login');
    }

    public function login(Request $request)
    {
        if(Auth::guard('reporter')->attempt(['username'=>$request->username, 'password'=>$request->password])){
            return redirect()->route('reporter.home');
        }
        return redirect()->back()->withErrors('Wrong Username or Password');
    }

    public function homeMethod()
    {
        return view('reporter.layout.app');
    }

    public function showProfileForm()
    {
        $reporter =  Auth::guard('reporter')->user();
        return view('reporter.profile', compact('reporter'));
    }

    public function submitProfileForm(Request $request)
    {
        $profileToUpdate = Auth::guard('reporter')->user();

        $request->validate([
            'email'=>'nullable|email|unique:reporters,email,'.$profileToUpdate->id,
            'profile_pic'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        $profileToUpdate->firstname = $request->firstname;
        $profileToUpdate->lastname = $request->lastname;
        $profileToUpdate->email = $request->email;

        if($request->has('profile_pic')){
            $originImageFile = $request->file('profile_pic');
            $imageObject = Image::make($originImageFile)->encode('jpg');
            $imageObject->resize(200, 200)->save('assets/reporter/images/'.$originImageFile->hashname());
            $profileToUpdate->profile_pic = $originImageFile->hashName();
        }

        $profileToUpdate->phone = $request->phone;
        $profileToUpdate->address = $request->address;
        $profileToUpdate->city = $request->city;
        $profileToUpdate->country = $request->country;
        $profileToUpdate->save();

        return redirect()->back()->with('success', 'Profile Successfully Updated');
    }

    public function showPasswordForm()
    {
        return view('reporter.password');
    }

    public function submitPasswordForm(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $profileToUpdate = Auth::guard('reporter')->user();

        if(Hash::check($request->currentPassword, $profileToUpdate->password)){
            $profileToUpdate->password = Hash::make($request->password);
            return redirect()->back()->with('success', 'Password is Updated');
        }

        return redirect()->back()->withErrors('Current Password is Wrong');
    }

    public function showCreateNewsForm()
    {
        $allCategories = Category::all();
        return view('reporter.create_news', compact('allCategories'));
    }

    public function submitCreateNewsForm(Request $request)
    {
        $request->validate([
            'category'=>'required',
            'title'=>'required',
            'description'=>'required',
            'preview'=>'nullable|image',
        ]);

        $currentUser = Auth::guard('reporter')->user();

        $newNews = new News();
        $newNews->category_id = $request->category;
        $newNews->created_reporter_id = $currentUser->id;
        $newNews->title = $request->title;
        $newNews->description = $request->description;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/news/'.$originalImage->hashName());
            $newNews->preview = $originalImage->hashName();
        }

        $statusPermission = Setting::first()->news_verification;
        $statusPermission==1 ? $newNews->status=0 : $newNews->status=1;

        $newNews->save();

        return redirect()->back()->with('success', 'News is Added');
    }

    public function showAllNews()
    {
        $currentUser = Auth::guard('reporter')->user();
        $allNews = News::all()->where('created_reporter_id', $currentUser->id);

        return view('reporter.all_news', compact('allNews'));
    }

    public function showNewsEditForm($newsId)
    {
        $newsToUpdate = News::find($newsId);
        $allCategories = Category::all();
        return view('reporter.edit_news', compact(['allCategories', 'newsToUpdate']));
    }

    public function submitNewsEditForm(Request $request, $newsId)
    {
        $request->validate([
            'categoryId' => 'required',
            'title' => 'required',
            'description' => 'required',
            'preview' => 'nullable|image',
        ]);

        $newsToUpdate = News::find($newsId);

        $newsToUpdate->category_id = $request->categoryId;
        $newsToUpdate->title = $request->title;
        $newsToUpdate->description = $request->description;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/news/'.$originalImage->hashName());
            $newsToUpdate->preview = $originalImage->hashName();
        }

        $settings = Setting::first();
        $settings->news_verification == 0 ? $newsToUpdate->status = 1 :$newsToUpdate->status =0;

        $newsToUpdate->save();

        return redirect()->back()->with('success', 'News is Updated');
    }

    public function showCreateImageForm()
    {
        return view('reporter.create_image');
    }

    public function submitCreateImageForm(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'preview' => 'image'
        ]);

        $currentUser = Auth::guard('reporter')->user();

        $newImage = new ImageModel();
        $newImage->created_reporter_id = $currentUser->id;
        $newImage->title = $request->title;
        $newImage->description = $request->description;

        if($request->hasfile('preview')){

            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/previews/'.$originalImage->hashName());

            $newImage->preview = $originalImage->hashName();
        }

        $settings = Setting::first();
        $settings->news_verification == 0 ? $newImage->status = 1 :$newImage->status =0;
        
        $newImage->save();
        
        return redirect()->back()->with('success', 'New Image is Added');
    }


    public function showAllImages()
    {
        $currentUser = Auth::guard('reporter')->user();

        $allImages = ImageModel::where('created_reporter_id', $currentUser->id)->orderBy('created_at', 'DESC')->paginate(15);

        return view('reporter.all_images', compact('allImages'));
    }

    public function showImageEditForm($imageId)
    {
        $imageToUpdate = ImageModel::findOrFail($imageId);
        return view('reporter.edit_image', compact('imageToUpdate'));
    }

    public function submitImageEditForm(Request $request, $imageId)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'preview' => 'image',
        ]);

        $currentReporter = Auth::guard('editor')->user();

        $imageToUpdate = ImageModel::findOrFail($imageId);
        $imageToUpdate->title = $request->title;
        $imageToUpdate->description = $request->description;

        if($request->hasfile('preview')){

            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/previews/'.$originalImage->hashName());
            $imageToUpdate->preview = $originalImage->hashName();
        }

        $statusPermission = Setting::first()->news_verification;
        $statusPermission==1 ? $imageToUpdate->status=0 : $imageToUpdate->status=1;

        $imageToUpdate->save();

        return redirect()->route('reporter.edit.image', $imageToUpdate->id)->with('success', 'Image is updated');
    }

    public function showCreateVideoForm()
    {
        return view('reporter.create_video');
    }

    public function submitCreateVideoForm(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'preview' => 'nullable|image',
            'url' => 'required'
        ]);

        $currentUser = Auth::guard('reporter')->user();

        $newVideo = new Video();
        $newVideo->created_reporter_id = $currentUser->id;
        $newVideo->title = $request->title;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/video/'.$originalImage->hashName());
            $newVideo->preview = $originalImage->hashName();
        }

        $newVideo->url = $request->url;

        $statusPermission = Setting::first()->news_verification;
        $statusPermission==1 ? $newVideo->status=0 : $newVideo->status=1;

        $newVideo->save();

        return redirect()->back()->with('success', 'New Video is Added');
    }

    public function showAllVideos()
    {
        $currentUser = Auth::guard('reporter')->user();

        $allVideos = Video::where('created_reporter_id', $currentUser->id)->orderBy('created_at', 'DESC')->paginate(15);

        return view('reporter.all_videos', compact('allVideos'));
    }

    public function showVideoEditForm($videoId)
    {
        $videoToUpdate = Video::findOrFail($videoId);
        return view('reporter.edit_video', compact('videoToUpdate'));
    }

    public function submitVideoEditForm(Request $request, $videoId)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'preview' => 'nullable|image',
        ]);

        $currentEditor = Auth::guard('reporter')->user();

        $videoToUpdate = Video::findOrFail($videoId);
        $videoToUpdate->title = $request->title;
        $videoToUpdate->url = $request->url;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/video/'.$originalImage->hashName());
            $videoToUpdate->preview = $originalImage->hashName();
        }

        $statusPermission = Setting::first()->news_verification;
        $statusPermission==1 ? $videoToUpdate->status=0 : $videoToUpdate->status=1;

        $videoToUpdate->save();

        return redirect()->route('reporter.edit.video', $videoToUpdate->id)->with('success', 'Video is updated');
    }

    public function logout()
    {
        Auth::guard('reporter')->logout();
        return redirect()->route('reporter.login');
    }
}