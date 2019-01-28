<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use App\Setting;
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
            'preview'=>'required|image',
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
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/'.$originalImage->hashName());
            $newNews->preview = $originalImage->hashName();
        }

        $statusPermission = Setting::first()->newsverification;
        ($statusPermission==1) ? $newNews->status=0 : $newNews->status=1;

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
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'preview' => 'nullable|image',
        ]);

        $newsToUpdate = News::find($newsId);

        $newsToUpdate->category_id = $request->category;
        $newsToUpdate->title = $request->title;
        $newsToUpdate->description = $request->description;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('300', '300')->save('assets/front/images/'.$originalImage->hashName());
            $newsToUpdate->preview = $originalImage->hashName();
        }

        $settings = Setting::first();
        ($settings->newsverification==0) ? $newsToUpdate->status = 1 :$newsToUpdate->status =0;

        $newsToUpdate->save();

        return redirect()->back()->with('success', 'News is Updated');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('reporter.login');
    }
}