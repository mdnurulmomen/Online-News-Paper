<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
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

    public function showCreatePostForm(){
        $allCategories = Category::all('id', 'name');
        $username = Auth::guard('reporter')->user()->username;
        return view('reporter.create_post', compact('allCategories', 'username'));
    }

    public function submitCreatePostForm(Request $request){
        $request->validate([
            'category'=>'required',
            'title'=>'required',
            'description'=>'required',
        ]);

        $currentUser = Auth::guard('reporter')->user();

        $newPost = new Post();
        $newPost->category_id = $request->category;
        $newPost->created_reporter_id = $currentUser->id;
        $newPost->title = $request->title;
        $newPost->description = $request->description;

        $statusPermission = Setting::first()->postverification;
        ($statusPermission==1) ? $newPost->status=0 : $newPost->status=1;

        $newPost->save();
        return redirect()->back()->with('updateMsg', 'Post is Added');
    }

    public function showAllPost(){
        $currentUser = Auth::guard('reporter')->user();
        $posts = Post::all()->where('created_reporter_id', $currentUser->id);
        return view('reporter.all_post', compact('posts'));
    }

    public function showPostEditForm($postid){
        $postToUpdate = Post::find($postid);
        $allCategories = Category::all('id', 'name');
        return view('reporter.edit_post', compact(['allCategories', 'postToUpdate']));
    }

    public function submitPostEditForm(Request $request, $postId){
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $postToUpdate = Post::find($postId);

        $postToUpdate->category_id = $request->category;
        $postToUpdate->title = $request->title;
        $postToUpdate->description = $request->description;

        $settings = Setting::first();
        ($settings->postverification==0) ? $postToUpdate->status = 1 :$postToUpdate->status =0;

        $postToUpdate->save();
        
        return redirect()->back()->with('updateMsg', 'Post is Updated');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('reporter.login');
    }
}