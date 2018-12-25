<?php

namespace App\Http\Controllers;

use App\Post;
use App\Admin;
use App\Editor;
use App\Category;
use App\Reporter;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use \Intervention\Image\Facades\Image;


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
        $profileData = array('firstname'=>$currentAdmin->firstname, 'lastname'=>$currentAdmin->lastname, 'username'=>$currentAdmin->username, 'email'=>$currentAdmin->email, 'picpath'=>$currentAdmin->picpath, 'phone'=>$currentAdmin->phone, 'address'=>$currentAdmin->address, 'city'=>$currentAdmin->city, 'country'=>$currentAdmin->country);

        return view('admin.profile', $profileData);
    }

    public function submitProfileForm(Request $request){

        $profileToUpdate = Auth::guard('admin')->user();

        $request->validate([
            'username'=>'required|unique:admins,username,'.$profileToUpdate->id,
            'email'=>'nullable|unique:admins,email,'.$profileToUpdate->id,
            'picpath'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        if($request->has('picpath')){
            $originImageFile = $request->file('picpath');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(200, 200)->save('assets/admin/images/'.$originImageFile->hashname());
        }

        if($request->has('picpath')){
            $profileToUpdate->update(['firstname'=>$request->firstname, 'lastName'=>$request->lastname, 'username'=>$request->username, 'email'=>$request->email, 'picpath'=>$originImageFile->hashname(), 'phone'=> $request->phone, 'address'=> $request->address, 'city'=> $request->city, 'country'=>$request->country]);
        }
        else{
            $profileToUpdate->update($request->all());
        }

        return redirect()->back()->with('updateMsg', 'Profile Successfully Updated')->with('username', $request->username);
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

        ]);

        $settings = Setting::first();

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

    public function showCreatePostForm(){
        $username = Auth::guard('admin')->user()->username;
        $allCategories = Category::all('id', 'name');
        return view('admin.create_post', compact('allCategories', 'username'));
    }

    public function submitCreatePostForm(Request $request){
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $currentUser = Auth::guard('admin')->user();
        $newPost = new Post();
        $newPost->category_id = $request->category;
        $newPost->admin_id = $currentUser->id;
        $newPost->title = $request->title;
        $newPost->description = $request->description;
        ($request->status=='on') ? $newPost->status = 1 : $newPost->status = 0;
        $newPost->save();


        return redirect()->back()->with('updateMsg', 'New Post is Added')->with('username', $currentUser->username);
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
        return view('admin.create_editor', compact('allCategories', 'username'));
    }

    public function submitCreateEditorForm(Request $request){
        $request->validate([
            'username' => 'required||unique:editors,username',
            'password' => 'required',
            'email' => 'nullable|email|unique:editors,email',
            'categories' => 'required',
            'picpath' => 'nullable|image',
        ]);

        $newEditor = new Editor();
        $newEditor->firstname = $request->firstname;
        $newEditor->lastname = $request->lastname;
        $newEditor->username = $request->username;
        $newEditor->password = Hash::make($request->password);
        $newEditor->email = $request->email;

        $newEditor->editor_categories = $request->categories;

        if($request->has('picpath')){
            $originalImageFile = $request->picpath;
            $imageObject = Image::make($originalImageFile);
            $imageObject->resize(200, 200)->save('assets/editor/images/'.$originalImageFile->hashname());
            $newEditor->picpath = $originalImageFile->hashname();
        }

        $newEditor->phone = $request->phone;
        $newEditor->address= $request->address;
        $newEditor->city = $request->city;
        $newEditor->country = $request->country;
        $newEditor->save();

        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->back()->with('updateMsg', 'New Editor has been Created')->with('username', $currentUserName);
    }

    public function showCreateReporterForm(){
        $username = Auth::guard('admin')->user()->username;
        return view('admin.create_reporter', compact('username'));
    }

    public function submitCreateReporterForm(Request $request){
        $request->validate([
            'username' => 'required||unique:reporters,username|max:255',
            'password' => 'required',
            'email' => 'nullable|email|unique:reporters,email',
            'picpath' => 'nullable|image',
        ]);

        $newReporter = new Reporter();
        $newReporter->firstname = $request->firstname;
        $newReporter->lastname = $request->lastname;
        $newReporter->username = $request->username;
        $newReporter->password = Hash::make($request->password);
        $newReporter->email = $request->email;

        if($request->has('picpath')){
            $originalImageFile = $request->picpath;
            $imageObject = Image::make($originalImageFile);
            $imageObject->resize(150, 150)->save('assets/reporter/images/'.$originalImageFile->hashname());
            $newReporter->picpath = $originalImageFile->hashname();
        }

        $newReporter->phone = $request->phone;
        $newReporter->address= $request->address;
        $newReporter->city = $request->city;
        $newReporter->country = $request->country;
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
        $postToUpdate = Post::find($postid);
        $allCategories = Category::all('id', 'name');
        $username = Auth::guard('admin')->user()->username;
        return view('admin.edit_post', compact('postToUpdate', 'username', 'allCategories'));
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
        return redirect()->route('admin.edit.post', $postToUpdate->id)->with('updateMsg', 'Post is updated')->with('username', $username);
    }

    public function postDeleteMethod($postid){
        Post::destroy($postid);
        $username = Auth::guard('admin')->user()->username;
        return redirect()->route('admin.view.post')->with('updateMsg', 'Post has been Deleted')->with('username', $username);
    }

    public function showAllEditors()
    {
        $editors = Editor::all();

        $username = Auth::guard('admin')->user()->username;
        return view('admin.all_editors', compact('editors', 'username'));
    }

    public function showEditorEditForm($editorId){
        $editorToUpdate = Editor::find($editorId);
        $allCategories = Category::all('id', 'name');
        $username = Auth::guard('admin')->user()->username;
        return view('admin.edit_editor', compact('editorToUpdate', 'username', 'allCategories'));
    }

    public function submitEditorEditForm(Request $request, $editorId){

        $profileToUpdate = Editor::find($editorId);

        $request->validate([
            'username'=>'required|unique:editors,username,'.$profileToUpdate->id,
            'email'=>'nullable|email|unique:editors,email,'.$profileToUpdate->id,
            'categories'=>'required',
            'picpath'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        if($request->has('picpath')){
            $originImageFile = $request->file('picpath');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(150, 150)->save('assets/editor/images/'.$originImageFile->hashname());
        }

        if($request->has('picpath')) {
            $profileToUpdate->update(['firstname'=>$request->firstname, 'lastname'=>$request->lastname, 'username'=>$request->username, 'email'=>$request->email, 'editor_categories'=>$request->categories, 'picpath'=>$originImageFile->hashname(), 'phone'=>$request->phone, 'address'=>$request->address, 'city'=>$request->city, 'country'=>$request->country]);
        } else {
            $profileToUpdate->update(['firstname'=>$request->firstname, 'lastname'=>$request->lastname, 'username'=>$request->username, 'email'=>$request->email, 'editor_categories'=>$request->categories, 'phone'=>$request->phone, 'address'=>$request->address, 'city'=>$request->city, 'country'=>$request->country]);
        }


        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->route('admin.edit.editor', $profileToUpdate->id)->with('updateMsg', 'Profile is Updated')->with('username', $currentUserName);
    }

    public function editorDeleteMethod($editorId){
        Editor::destroy($editorId);
        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->route('admin.view.editors')->with('udpateMsg', 'Profile is Deleted')->with('username', $currentUserName);
    }

    public function showAllReporters()
    {
        $reporters = Reporter::all();

        $username = Auth::guard('admin')->user()->username;
        return view('admin.all_reporters', compact( 'reporters', 'username'));
    }

    public function showReporterEditForm($reporterId){
        $reporterToUpdate = Reporter::find($reporterId);
        $username = Auth::guard('admin')->user()->username;
        return view('admin.edit_reporter', compact('reporterToUpdate', 'username'));
    }

    public function submitReporterEditForm(Request $request, $reporterId){
        $profileToUpdate = Reporter::find($reporterId);
        $request->validate([
            'username'=>'required|unique:reporters,username,'.$profileToUpdate->id,
            'email'=>'nullable|email|unique:reporters,email,'.$profileToUpdate->id,
            'picpath'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        if($request->has('picpath')){
            $originImageFile = $request->file('picpath');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(150, 150)->save('assets/reporter/images/'.$originImageFile->hashname());
        }

        if($request->has('picpath')) {
            $profileToUpdate->update(['firstname'=>$request->firstname, 'lastname'=>$request->lastname, 'username'=>$request->username, 'email'=>$request->email, 'picpath'=>$originImageFile->hashname(), 'phone'=>$request->phone, 'address'=>$request->address, 'city'=>$request->city, 'country'=>$request->country]);
        } else {
            $profileToUpdate->update($request->all());
        }

        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->route('admin.edit.reporter', $profileToUpdate->id)->with('updateMsg', 'Profile is Updated')->with('username', $currentUserName);
    }

    public function reporterDeleteMethod($reporterId){
        Reporter::destroy($reporterId);
        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->route('admin.view.reporters')->with('updateMsg', 'Profile is Deleted')->with('username', $currentUserName);
    }

    public function showAllCategories()
    {
        $categories = Category::all();

        $username = Auth::guard('admin')->user()->username;
        return view('admin.all_categories', compact( 'categories', 'username'));
    }

    public function showCategoryEditForm($categoryId){
        $categoryToUpdate = Category::find($categoryId);
        $allCategories = Category::all('id', 'name');
        $username = Auth::guard('admin')->user()->username;
        return view('admin.edit_category', compact('categoryToUpdate', 'username', 'allCategories'));
    }

    public function submitCategoryEditForm(Request $request, $categoryId){
        $request->validate([
            'name'=>'required',
            'url'=>'required',
        ]);

        $categoryToUpdate = Category::find($categoryId);

        $categoryToUpdate->name = $request->name;
        $categoryToUpdate->url = $request->url;
        $request->has('parent') ? $categoryToUpdate->parent = $request->parent : $categoryToUpdate->parent = 0;

        $categoryToUpdate->save();

        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->route('admin.edit.category', $categoryToUpdate->id)->with('updateMsg', 'Category is Updated')->with('username', $currentUserName);
    }

    public function categoryDeleteMethod($categoryId){
        Category::destroy($categoryId);

        $currentUserName = Auth::guard('admin')->user()->username;
        return redirect()->route('admin.view.categories')->with('updateMsg', 'Category is Deleted');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}