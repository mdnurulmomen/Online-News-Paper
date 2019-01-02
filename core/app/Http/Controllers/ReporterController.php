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
    public function showLoginForm(){
        return view('reporter.login');
    }

    public function login(Request $request){
        if(Auth::guard('reporter')->attempt(['username'=>$request->username, 'password'=>$request->password])){
            return redirect()->route('reporter.home');
        }
        return redirect()->back()->withErrors('Wrong Username or Password');
    }

    public function homeMethod(){
        return view('reporter.layout.app');
    }

    public function showProfileForm(){
        $currentReporter =  Auth::guard('reporter')->user();

        $profileData = array('firstname'=>$currentReporter->firstname, 'lastname'=>$currentReporter->lastname, 'username'=>$currentReporter->username, 'email'=>$currentReporter->email, 'picpath'=>$currentReporter->picpath, 'phone'=>$currentReporter->phone, 'address'=>$currentReporter->address, 'city'=>$currentReporter->city, 'state'=>$currentReporter->state, 'country'=>$currentReporter->country);
        return view('reporter.profile', $profileData);
    }

    public function submitProfileForm(Request $request){

        $profileToUpdate = Auth::guard('reporter')->user();
        $request->validate([
            'email'=>'nullable|email|unique:reporters,email,'.$profileToUpdate->id,
            'picpath'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);
        $profileToUpdate->firstname = $request->firstname;
        $profileToUpdate->lastname = $request->lastname;
        $profileToUpdate->email = $request->email;

        if($request->has('picpath')){
            $originImageFile = $request->file('picpath');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(150, 150)->save('assets/reporter/images/'.$originImageFile->hashname());
            $profileToUpdate->picpath = $originImageFile->hashName();
        }

        $profileToUpdate->phone = $request->phone;
        $profileToUpdate->address = $request->address;
        $profileToUpdate->city = $request->city;
        $profileToUpdate->country = $request->country;
        $profileToUpdate->save();
        return redirect()->back()->with('updateMsg', 'Profile Successfully Updated');
    }

    public function showPasswordForm(){
        return view('reporter.password');
    }

    public function submitPasswordForm(Request $request){
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $profileToUpdate = Auth::guard('reporter')->user();

        if(Hash::check($request->currentPassword, $profileToUpdate->password)){
            $profileToUpdate->password = Hash::make($request->password);
            return redirect()->back()->with('updateMsg', 'Password is Updated');
        }

        return redirect()->back()->withErrors('Current Password is Wrong');
    }

    public function showCreateNewsForm(){
        $allCategories = Category::all('id', 'name');
        $username = Auth::guard('reporter')->user()->username;
        return view('reporter.create_news', compact('allCategories', 'username'));
    }

    public function submitCreateNewsForm(Request $request){
        $request->validate([
            'category'=>'required',
            'title'=>'required',
            'description'=>'required',
            'picpath'=>'nullable|image',
        ]);

        $currentUser = Auth::guard('reporter')->user();

        $newNews = new News();
        $newNews->category_id = $request->category;
        $newNews->created_reporter_id = $currentUser->id;
        $newNews->title = $request->title;
        $newNews->description = $request->description;

        if($request->has('picpath')){
            $originalImage = $request->file('picpath');
            $imageInterventionObj = Image::make($originalImage);
            $imageInterventionObj->resize('250', '250')->save('assets/front/images/'.$originalImage->hashName());
            $newNews->picpath = $originalImage->hashName();
        }

        $statusPermission = Setting::first()->newsverification;
        ($statusPermission==1) ? $newNews->status=0 : $newNews->status=1;

        $newNews->save();
        return redirect()->back()->with('updateMsg', 'News is Added');
    }

    public function showAllNews(){
        $currentUser = Auth::guard('reporter')->user();
        $allNews = News::all()->where('created_reporter_id', $currentUser->id);
        return view('reporter.all_news', compact('allNews'));
    }

    public function showNewsEditForm($newsId){
        $newsToUpdate = News::find($newsId);
        $allCategories = Category::all('id', 'name');
        return view('reporter.edit_news', compact(['allCategories', 'newsToUpdate']));
    }

    public function submitNewsEditForm(Request $request, $newsId){
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'picpath' => 'nullable|image',
        ]);

        $newsToUpdate = News::find($newsId);

        $newsToUpdate->category_id = $request->category;
        $newsToUpdate->title = $request->title;
        $newsToUpdate->description = $request->description;

        if($request->has('picpath')){
            $originalImage = $request->file('picpath');
            $imageInterventionObj = Image::make($originalImage);
            $imageInterventionObj->resize('250', '250')->save('assets/front/images/'.$originalImage->hashName());
            $newsToUpdate->picpath = $originalImage->hashName();
        }

        $settings = Setting::first();
        ($settings->newsverification==0) ? $newsToUpdate->status = 1 :$newsToUpdate->status =0;

        $newsToUpdate->save();

        return redirect()->back()->with('updateMsg', 'News is Updated');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('reporter.login');
    }
}