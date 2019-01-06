<?php

namespace App\Http\Controllers;

use App\News;
use App\Admin;
use App\Editor;
use App\Category;
use App\Reporter;
use App\Setting;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
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
        return view('admin.layout.app', compact(''));
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

        return redirect()->back()->with('updateMsg', 'Profile Successfully Updated');
    }

    public function showPasswordForm(){

        return view('admin.password');
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
            return redirect()->back()->with('updateMsg', 'Password is Updated');
        }

        return redirect()->back()->withErrors('Current Password is not Correct');
    }

    public function showGeneralSettingsForm(){
        $settings = Setting::first();
        $settingsData = array('newsPaperName'=>$settings->name, 'color'=>$settings->color, 'footer'=>$settings->footer);
        return view('admin.general_settings')->with($settingsData);
    }

    public function submitGeneralSettingsForm(Request $request){
        $request->validate([]);

        $settings = Setting::first();
        $settings->name = $request->name;
        $settings->color = $request->color;
        $settings->footer = $request->footer;

        $settings->save();

        return redirect()->route('admin.settings.general')->with('updateMsg', 'Settings are Updated');
    }

    public function showMediaSettingsForm(){
        $settings = Setting::first();
        $settingsData = array('logo'=>$settings->logo, 'defaultIcon'=>$settings->defaultpic, 'newsverification'=>$settings->newsverification, 'userRegistration'=>$settings->userregistration, 'emailverification'=>$settings->emailverification, 'smsverification'=>$settings->smsverification);
        return view('admin.media_settings')->with($settingsData);
    }

    public function submitMediaSettingsForm(Request $request){
        $request->validate([]);

        $settings = Setting::first();

        if($request->has('logo')){
            $originImageFile = $request->file('logo');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(200, 50)->save('assets/front/images/setting-img/'.$originImageFile->hashname());
            $settings->logo= $originImageFile->hashName();
        }

        if($request->has('defaultIcon')){
            $originImageFile = $request->file('defaultIcon');
            $imageObject = Image::make($originImageFile);
//            $imageObject->resize(50, 50)->save('assets/front/images/setting-img/'.$originImageFile->hashname());
            $imageObject->resize(1000, 800)->save('assets/front/images/setting-img/'.$originImageFile->hashname());
            $settings->defaultpic= $originImageFile->hashName();
        }

        ($request->newsverification == 'on') ? $settings->newsverification = 1 : $settings->newsverification = 0;
        ($request->userregistration == 'on') ? $settings->userregistration = 1 : $settings->userregistration = 0;
        ($request->emailverification == 'on') ? $settings->emailverification = 1 : $settings->emailverification = 0;
        ($request->smsverification == 'on') ? $settings->smsverification = 1 : $settings->smsverification = 0;

        $settings->save();

        return redirect()->route('admin.settings.media')->with('updateMsg', 'Settings are Updated');
    }

    public function showNewsSettingsForm(){
        $headlines = Setting::firstOrFail()->headlines;
        $headlines = json_decode($headlines);
//        ->orderByRaw('FIELD(id,5,3,7,1,6,12,8)')
        $allNews = News::select('id','title')->whereIn('id', $headlines)->orderByRaw('FIELD(id, '.implode(',', $headlines).')')->get();
        return view('admin.headline_settings', compact('allNews'));
    }

    public function submitNewsSettingsForm(Request $request){
        $request->validate([
            'newsId'=>'nullable|exists:news,id'
        ]);
        $settings = Setting::first();
        $settings->settings_headlines = $request->newsId;
        $settings->save();
        return redirect()->route('admin.settings.news')->with('updateMsg', 'Headlines are Updated');
    }

    public function showCategorySettingsForm(){
        $prioritizedCategories = Setting::firstOrFail()->frontcategories;
        $prioritizedCategories = json_decode($prioritizedCategories);
//        ->orderByRaw('FIELD(id,5,3,7,1,6,12,8)')
        $prioritizedCategoryDetails = Category::select('id','name','parent')->whereIn('id', $prioritizedCategories)->orderByRaw('FIELD(id, '.implode(',', $prioritizedCategories).')')->get();
        return view('admin.category_priority', compact('prioritizedCategoryDetails'));
    }

    public function submitCategorySettingsForm(Request $request){
        $request->validate([
            'categoryId'=>'nullable|exists:categories,id'
        ]);

        $settings = Setting::first();
        $settings->category_priority = $request->categoryId;
        $settings->save();
        return redirect()->route('admin.settings.categories')->with('updateMsg', 'Categories are Prioritized');
    }

    public function showCreateNewsForm(){
        $allCategories = Category::all('id', 'name');
        return view('admin.create_news', compact('allCategories'));
    }

    public function submitCreateNewsForm(Request $request){
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'picpath' => 'required|image',
        ]);

        $currentUser = Auth::guard('admin')->user();
        $newPost = new News();
        $newPost->category_id = $request->category;
        $newPost->created_admin_id = $currentUser->id;
        $newPost->title = $request->title;
        $newPost->description = $request->description;

        if($request->has('picpath')){
            $originalImage = $request->file('picpath');
            $imageInterventionObj = Image::make($originalImage);
            $imageInterventionObj->resize('1000', '800')->save('assets/front/images/news-img/'.$originalImage->hashName());
            $newPost->picpath = $originalImage->hashName();
        }

        ($request->status=='on') ? $newPost->status = 1 : $newPost->status = 0;
        $newPost->save();

        return redirect()->back()->with('updateMsg', 'New News is Added');
    }

    public function showCreateVideoForm(){
        return view('admin.create_video');
    }

    public function submitCreateVideoForm(Request $request){
        $request->validate([
            'title' => 'required',
            'preview' => 'nullable|image',
            'videopath' => 'required',
            'status' => 'required',
        ]);

        $currentUser = Auth::guard('admin')->user();
        $newVideo = new Video();
        $newVideo->created_admin_id = $currentUser->id;
        $newVideo->title = $request->title;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage);
            $imageInterventionObj->resize('1000', '800')->save('assets/front/images/video-img/'.$originalImage->hashName());
            $newVideo->preview = $originalImage->hashName();
        }

        $newVideo->videopath = $request->videopath;
        ($request->status=='on') ? $newVideo->status = 1 : $newVideo->status = 0;
        $newVideo->save();

        return redirect()->back()->with('updateMsg', 'New Video is Added');
    }

    public function showCreateCategoryForm(){
        $allCategories = Category::all('id', 'name');
        return view('admin.create_category', compact('allCategories'));
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
        return redirect()->back()->with('updateMsg', 'New Category is Added');
    }

    public function showCreateEditorForm(){
        $allCategories = Category::all(['id', 'name']);
        return view('admin.create_editor', compact('allCategories'));
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

        return redirect()->back()->with('updateMsg', 'New Editor has been Created');
    }

    public function showCreateReporterForm(){
        return view('admin.create_reporter');
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

        return redirect()->back()->with('updateMsg', 'New Reporter has been Created');
    }

    public function showAllNews(){
        $allNews = News::paginate(1);
        return view('admin.all_news', compact('allNews'));
    }

    public function showNewsEditForm($newsId){
        $newsToUpdate = News::findOrFail($newsId);
        $allCategories = Category::all('id', 'name');
        return view('admin.edit_news', compact('newsToUpdate', 'allCategories'));
    }

    public function submitNewsEditForm(Request $request, $newsId){
        $request->validate([
            'categoryId'=> 'required',
            'title' => 'required',
            'description' => 'required',
            'picpath' => 'nullable|image',
        ]);

        $currentAdmin = Auth::guard('admin')->user();

        $newsToUpdate = News::findOrFail($newsId);
        $newsToUpdate->category_id = $request->categoryId;
        $newsToUpdate->title = $request->title;
        $newsToUpdate->description = $request->description;

        if($request->has('picpath')){
            $originalImage = $request->file('picpath');
            $imageInterventionObj = Image::make($originalImage);
            $imageInterventionObj->resize('1000', '800')->save('assets/front/images/news-img/'.$originalImage->hashName());
            $newsToUpdate->picpath = $originalImage->hashName();
        }

        ($request->status=='on') ? $newsToUpdate->status = 1 : $newsToUpdate->status = 0;
        $newsToUpdate->updated_admin_id = $currentAdmin->id;
        $newsToUpdate->save();

        return redirect()->route('admin.edit.news', $newsToUpdate->id)->with('updateMsg', 'Post is updated');
    }

    public function newsDeleteMethod($newsId){
        News::destroy($newsId);
        return redirect()->route('admin.view.news')->with('updateMsg', 'News has been Deleted');
    }

    public function showAllEditors()
    {
        $editors = Editor::paginate(1);
        return view('admin.all_editors', compact('editors'));
    }

    public function showEditorEditForm($editorId){
        $editorToUpdate = Editor::findOrFail($editorId);
        $allCategories = Category::all('id', 'name');
        return view('admin.edit_editor', compact('editorToUpdate', 'allCategories'));
    }

    public function submitEditorEditForm(Request $request, $editorId){

        $profileToUpdate = Editor::findOrFail($editorId);

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

        return redirect()->route('admin.edit.editor', $profileToUpdate->id)->with('updateMsg', 'Profile is Updated');
    }

    public function editorDeleteMethod($editorId){
        Editor::destroy($editorId);
        return redirect()->route('admin.view.editors')->with('udpateMsg', 'Profile is Deleted');
    }

    public function showAllReporters()
    {
        $reporters = Reporter::paginate(1);
        return view('admin.all_reporters', compact( 'reporters'));
    }

    public function showReporterEditForm($reporterId){
        $reporterToUpdate = Reporter::findOrFail($reporterId);
        return view('admin.edit_reporter', compact('reporterToUpdate'));
    }

    public function submitReporterEditForm(Request $request, $reporterId){
        $profileToUpdate = Reporter::findOrFail($reporterId);
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

        if($request->has('picpath')){
            $profileToUpdate->update(['firstname'=>$request->firstname, 'lastname'=>$request->lastname, 'username'=>$request->username, 'email'=>$request->email, 'picpath'=>$originImageFile->hashname(), 'phone'=>$request->phone, 'address'=>$request->address, 'city'=>$request->city, 'country'=>$request->country]);
        } else {
            $profileToUpdate->update($request->all());
        }

        return redirect()->route('admin.edit.reporter', $profileToUpdate->id)->with('updateMsg', 'Profile is Updated');
    }

    public function reporterDeleteMethod($reporterId){
        Reporter::destroy($reporterId);

        return redirect()->route('admin.view.reporters')->with('updateMsg', 'Profile is Deleted');
    }

    public function showAllCategories()
    {
        $categories = Category::paginate(2);
        return view('admin.all_categories', compact( 'categories'));
    }

    public function showCategoryEditForm($categoryId){
        $categoryToUpdate = Category::findOrFail($categoryId);
        $allCategories = Category::all('id', 'name');
        return view('admin.edit_category', compact('categoryToUpdate', 'allCategories'));
    }

    public function submitCategoryEditForm(Request $request, $categoryId){
        $request->validate([
            'name'=>'required',
            'url'=>'required',
        ]);

        $categoryToUpdate = Category::findOrFail($categoryId);
        $categoryToUpdate->name = $request->name;
        $categoryToUpdate->url = $request->url;
        $request->has('parent') ? $categoryToUpdate->parent = $request->parent : $categoryToUpdate->parent = 0;

        $categoryToUpdate->save();
        return redirect()->route('admin.edit.category', $categoryToUpdate->id)->with('updateMsg', 'Category is Updated');
    }

    public function categoryDeleteMethod($categoryId){
        $category = Category::findOrFail($categoryId);
        $category->childNews()->delete();
        $category->delete();

        return redirect()->route('admin.view.categories')->with('updateMsg', 'Category is Deleted');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}