<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Category;
use App\Editor;
use App\Post;
use App\Reporter;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Intervention\Image\Facades\Image;

//use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function showLoginForm(){
        return view('admin.login');
    }

    public function login(Request $request){
        if(Auth::guard('admin')->attempt(['username'=>$request->adminName, 'password'=>$request->adminPassword])){
            return redirect()->route('admin.home');
        }
        return redirect()->back()->withErrors('Wrong Username or Password');
    }

    public function homeMethod(){
        $username = Auth::guard('admin')->user()->username;
        return view('admin.layout.app', compact('username'));
    }

    public function showProfileForm(){
        $currentAdmin =  Auth::guard('admin')->user();
//        $profileData = array('firstname'=>$admin->firstname, 'lastname'=>$admin->lastname, 'username'=>$admin->username, 'email'=>$admin->email, 'picpath'=>$admin->picpath);
        $profileData = array('firstname'=>$currentAdmin->firstname, 'lastname'=>$currentAdmin->lastname, 'username'=>$currentAdmin->username, 'email'=>$currentAdmin->email, 'picpath'=>$currentAdmin->picpath, 'phone'=>$currentAdmin->phone, 'address'=>$currentAdmin->address, 'city'=>$currentAdmin->city, 'state'=>$currentAdmin->state, 'country'=>$currentAdmin->country);

        return view('admin.profile', $profileData);
    }

    public function submitProfileForm(Request $request){
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'nullable',
            'userName'=>'required',
            'email'=>'nullable',
            'profilePic'=>'nullable|image',
            'phone'=>'nullable|numeric',
            'address'=>'nullable',
            'city'=>'nullable',
            'state'=>'nullable',
            'country'=>'nullable',
        ]);

        $profileToUpdate = Auth::guard('admin')->user();

        $profileToUpdate->firstname = $request->firstName;
        $profileToUpdate->lastname = $request->lastName;
        $profileToUpdate->username = $request->userName;
        $profileToUpdate->email = $request->email;

        if($request->has('profilePic')){
            $originImageFile = $request->file('profilePic');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(200, 200)->save('assets/admin/images/'.$originImageFile->hashname());
            $profileToUpdate->picpath = $originImageFile->hashName();
        }

        $profileToUpdate->phone = $request->phone;
        $profileToUpdate->address = $request->address;
        $profileToUpdate->city = $request->city;
        $profileToUpdate->state = $request->state;
        $profileToUpdate->country = $request->country;

        $profileToUpdate->save();
        return redirect()->back()->with('updateMsg', 'Profile Successfully Updated')->with('username', $request->userName);
//        Auth::guard('admin')->user()->update(['firstname'=>$request->adminFirstName, 'lastName'=>$request->adminLastName, 'username'=>$request->adminUserName, 'email'=>$request->adminEmail, 'picpath'=>$originImageFile->hashname()]);
    }

    public function showPasswordForm(){
        $username = Auth::guard('admin')->user()->username;
        return view('admin.password', compact('username'));
    }

    public function submitPasswordForm(Request $request){
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $profileToUpdate = Auth::guard('admin')->user();

        if(Hash::check($request->currentPassword, $profileToUpdate->password))
        {
            Auth::guard('admin')->user()->password = Hash::make($request->password);
            return redirect()->back()->with('updateMsg', 'Password is Updated')->with('username', $profileToUpdate->username);
        }

        return redirect()->back()->withErrors('Current Password is not Correct')->with('username', $profileToUpdate->username);
    }

    public function showGeneralSettingsForm(){
        $settings = Setting::first();
        $settingsData = array('newsPaperName'=>$settings->name, 'color'=>$settings->color, 'postverification'=>$settings->postverification, 'userRegistration'=>$settings->userregistration, 'emailverification'=>$settings->emailverification, 'smsverification'=>$settings->smsverification);

        $username = Auth::guard('admin')->user()->username;
        return view('admin.general_settings', compact( 'username'))->with($settingsData);
    }

    public function submitGeneralSettingsForm(Request $request){
        $request->validate([
            'name'=>'nullable',
            'color'=>'nullable',
            'postverification'=>'nullable',
            'userregistration'=>'nullable',
            'emailverification'=>'nullable',
            'smsverification'=>'nullable',
        ]);

//        return $request;
        $settings = Setting::first();
//        return $settings;
        $settings->name = $request->name;
        $settings->color = $request->color;

        ($request->postverification == 'on') ? $settings->postverification = 1 : $settings->postverification = 0;
        ($request->userregistration == 'on') ? $settings->userregistration = 1 : $settings->userregistration = 0;
        ($request->emailverification == 'on') ? $settings->emailverification = 1 : $settings->emailverification = 0;
        ($request->smsverification == 'on') ? $settings->smsverification = 1 : $settings->smsverification = 0;

        $settings->save();

        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->back()->with('updateMsg', 'Settings are Updated')->with('username', $currentUserName);
    }

    public function showCreateCategoryForm(){
        $username = Auth::guard('admin')->user()->username;
        $allCategories = Category::all('id', 'name');
        return view('admin.category', compact('allCategories', 'username'));
    }

    public function submitCreateCategoryForm(Request $request){
        $request->validate([
            'categoryName' => 'required|unique:categories,name',
            'categoryURl' => 'required|unique:categories,url',
            'categoryParent' => 'nullable',
        ]);

        $newCategory = new Category();
        $newCategory->name = $request->categoryName;
        $newCategory->url = $request->categoryURl;
        $request->has('categoryParent') ? $newCategory->parent = $request->categoryParent : $newCategory->parent = 0;

        $newCategory->save();
        $currentUserName = Auth::guard('admin')->user()->username;

        return redirect()->back()->with('updateMsg', 'New Category is Added')->with('username', $currentUserName);
    }

    public function showCreateEditorForm(){
        $username = Auth::guard('admin')->user()->username;
        $allCategories = Category::all(['id', 'name']);
        return view('admin.editor', compact('allCategories', 'username'));
    }

    public function submitCreateEditorForm(Request $request){
        $request->validate([
            'editorFirstName' => 'nullable|max:255',
            'editorLastName' => 'nullable|max:255',
            'editorUserName' => 'required||unique:editors,username|max:255',
            'editorPassword' => 'required',
            'editorEmail' => 'nullable|email|unique:editors,email',
            'editorCategories' => 'required',
            'editorPic' => 'nullable|image',
            'editorPhone' => 'nullable',
            'editorAddress' => 'nullable',
            'editorCity' => 'nullable',
            'editorState' => 'nullable',
            'editorCountry' => 'nullable',
        ]);

        $newEditor = new Editor();
        $newEditor->firstname = $request->editorFirstName;
        $newEditor->lastname = $request->editorLastName;
        $newEditor->username = $request->editorUserName;
        $newEditor->password = Hash::make($request->editorPassword);
        $newEditor->email = $request->editorEmail;

        $newEditor->categories = json_encode($request->editorCategories);

        if($request->has('editorPic')){
            $originalImageFile = $request->editorPic;
            $imageObject = Image::make($originalImageFile);
            $imageObject->resize(200, 200)->save('assets/editor/images/'.$originalImageFile->hashname());
            $newEditor->picpath = $originalImageFile->hashname();
        }

        $newEditor->phone = $request->editorPhone;
        $newEditor->address= $request->editorAddress;
        $newEditor->city = $request->editorCity;
        $newEditor->state = $request->editorState;
        $newEditor->country = $request->editorCountry;
        $newEditor->save();

        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->back()->with('updateMsg', 'New Editor has been Created')->with('username', $currentUserName);
    }

    public function showCreateReporterForm(){
        $username = Auth::guard('admin')->user()->username;
        return view('admin.reporter', compact('username'));
    }

    public function submitCreateReporterForm(Request $request){
        $request->validate([
            'reporterFirstName' => 'nullable|max:255',
            'reporterLastName' => 'nullable|max:255',
            'reporterUserName' => 'required||unique:reporters,username|max:255',
            'reporterPassword' => 'required',
            'reporterEmail' => 'nullable|email|unique:reporters,email',
            'reporterPic' => 'nullable|image',
            'reporterPhone' => 'nullable',
            'reporterAddress' => 'nullable',
            'reporterCity' => 'nullable',
            'reporterState' => 'nullable',
            'reporterCountry' => 'nullable',
        ]);

        $newReporter = new Reporter();
        $newReporter->firstname = $request->reporterFirstName;
        $newReporter->lastname = $request->reporterLastName;
        $newReporter->username = $request->reporterUserName;
        $newReporter->password = Hash::make($request->reporterPassword);
        $newReporter->email = $request->editorEmail;

        if($request->has('editorPic')){
            $originalImageFile = $request->reporterPic;
            $imageObject = Image::make($originalImageFile);
            $imageObject->resize(150, 150)->save('assets/reporters/images/'.$originalImageFile->hashname());
            $newReporter->picpath = $originalImageFile->hashname();
        }

        $newReporter->phone = $request->reporterPhone;
        $newReporter->address= $request->reporterAddress;
        $newReporter->city = $request->reporterCity;
        $newReporter->state = $request->reporterState;
        $newReporter->country = $request->reporterCountry;
        $newReporter->save();

        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->back()->with('updateMsg', 'New Reporter has been Created')->with('username', $currentUserName);
    }

    public function showAllPosts(){
        $posts = Post::all();
        $username = Auth::guard('admin')->user()->username;
        return view('admin.all_post', compact('posts', 'username'));
    }

    public function showPostEditForm($postid){
        $post = Post::find($postid);
        $categories = Category::all('id', 'name');
        $username = Auth::guard('admin')->user()->username;
        return view('admin.single_post', compact('post', 'username', 'categories'));
    }

    public function submitPostEditForm(Request $request, $postid){
        $request->validate([
            'categoryId'=> 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $postToUpdate = Post::find($postid);
        $postToUpdate->category_id = $request->categoryId;
        $postToUpdate->title = $request->title;
        $postToUpdate->description = $request->description;

        ($request->status=='on') ? $postToUpdate->status = 1 : $postToUpdate->status = 0;
        $postToUpdate->save();

        $username = Auth::guard('admin')->user()->username;
        return redirect()->route('admin.view.post')->with('updateMsg', 'Post has been Edited')->with('username', $username);
    }

    public function postDeleteMethod($postid){
        Post::destroy($postid);
//        $post = Post::find($postid);
//        $post->delete();
        $username = Auth::guard('admin')->user()->username;
        return redirect()->route('admin.view.post')->with('updateMsg', 'Post has been Deleted')->with('username', $username);
    }

    public function showAllEmployees(){
        $editors = Editor::all();
        $reporters = Reporter::all();
//        $posts = Post::all();
//        $username = Auth::guard('admin')->user()->username;
//        return view('admin.allpost', compact('posts', 'username'));
        $username = Auth::guard('admin')->user()->username;
        return view('admin.all_employee', compact('editors', 'reporters', 'username'));
    }

    public function showEmployeeEditForm($employeeid, $employeetype){
//        $post = Post::find($postid);
//        $categories = Category::all('id', 'name');
//        $username = Auth::guard('admin')->user()->username;
//        return view('admin.singlepost', compact('post', 'username', 'categories'));
        $username = Auth::guard('admin')->user()->username;
        return 'Show Edit Employees';
    }

    public function submitEmployeeEditForm($postid){
//        $post = Post::find($postid);
//        $categories = Category::all('id', 'name');
//        $username = Auth::guard('admin')->user()->username;
//        return view('admin.singlepost', compact('post', 'username', 'categories'));
        return 'Submit Edit Employees';
    }

    public function employeeDeleteMethod($postid){
//        $post = Post::find($postid);
//        $categories = Category::all('id', 'name');
//        $username = Auth::guard('admin')->user()->username;
//        return view('admin.singlepost', compact('post', 'username', 'categories'));
        return 'Delete Employees';
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}