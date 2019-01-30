<?php

namespace App\Http\Controllers;

use App\News;
use App\Admin;
use App\Video;
use App\Editor;
use App\Setting;
use App\Preview;
use App\Reporter;
use App\Category;
use App\Image as ImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use \Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        if(Auth::guard('admin')->attempt(['username'=>$request->username, 'password'=>$request->password])){
            return redirect()->route('admin.home');
        }

        return redirect()->back()->withErrors('Wrong Username or Password');
    }

    public function homeMethod()
    {
        return view('admin.layout.app', compact(''));
    }

    public function showProfileForm()
    {
        $profileData =  Auth::guard('admin')->user();
        return view('admin.profile', compact('profileData'));
    }

    public function submitProfileForm(Request $request)
    {
        $profileToUpdate = Auth::guard('admin')->user();

        $request->validate([
            'username'=>'required|unique:admins,username,'.$profileToUpdate->id,
            'email'=>'nullable|unique:admins,email,'.$profileToUpdate->id,
            'profile_pic'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        $profileToUpdate->firstname = $request->firstname;
        $profileToUpdate->lastname = $request->lastname;
        $profileToUpdate->username = $request->username;
        $profileToUpdate->email = $request->email;
        
        if($request->has('profile_pic')){
            $originImageFile = $request->file('profile_pic');
            $imageObject = Image::make($originImageFile)->encode('jpg');
            $imageObject->resize(200, 200)->save('assets/admin/images/'.$originImageFile->hashname());

            $profileToUpdate->profile_pic = $originImageFile->hashname();
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
        return view('admin.password');
    }

    public function submitPasswordForm(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $profileToUpdate = Auth::guard('admin')->user();

        if(Hash::check($request->currentPassword, $profileToUpdate->password))
        {
            Auth::guard('admin')->user()->password = Hash::make($request->password);
            return redirect()->back()->with('success', 'Password is Updated');
        }

        return redirect()->back()->withErrors('Current Password is not Correct');
    }

    public function showGeneralSettingsForm()
    {
        $settings = Setting::first();
        return view('admin.general_settings', compact('settings'));
    }

    public function submitGeneralSettingsForm(Request $request)
    {
        $request->validate([]);

        $settings = Setting::first();
        $settings->name = $request->name;
        $settings->color = $request->color;
        $settings->footer = $request->footer;
        $settings->save();

        return redirect()->back()->with('success', 'Settings are Updated');
    }

    public function showMediaSettingsForm()
    {
        $settings = Setting::first();
        return view('admin.media_settings', compact('settings'));
    }

    public function submitMediaSettingsForm(Request $request)
    {
        $request->validate([]);

        $settings = Setting::first();

        if($request->has('logo')){
            $originImageFile = $request->file('logo');
            $imageObject = Image::make($originImageFile)->encode('png');
            $imageObject->save('assets/front/images/setting/'.$originImageFile->hashname());
            $settings->logo= $originImageFile->hashName();
        }

        if($request->has('default_icon')){
            $originImageFile = $request->file('default_icon');
            $imageObject = Image::make($originImageFile)->encode('jpg');
            $imageObject->resize(128, 128)->save('assets/front/images/setting/'.$originImageFile->hashname());
            $settings->default_icon= $originImageFile->hashName();
        }

        $request->news_verification == 'on' ? $settings->news_verification = 1 : $settings->news_verification = 0;
        $request->user_registration == 'on' ? $settings->user_registration = 1 : $settings->user_registration = 0;
        $request->email_verification == 'on' ? $settings->email_verification = 1 : $settings->email_verification = 0;
        $request->sms_verification == 'on' ? $settings->sms_verification = 1 : $settings->sms_verification = 0;

        $settings->save();

        return redirect()->back()->with('success', 'Settings are Updated');
    }

    public function showHeadlinesSettingForm()
    {
        $headlines = Setting::first()->headlines;
        $headlines = json_decode($headlines);

        if(!empty($headlines)){
//          ->orderByRaw('FIELD(id,5,3,7,1,6,12,8)')
            $allNews = News::whereIn('id', $headlines)->orderByRaw('FIELD(id, '.implode(',', $headlines).')')->get();

            return view('admin.headline_settings', compact('allNews'));
        }

        return redirect()->back()->withErrors('No Headline is Defined yet.');
    }

    public function submitHeadlinesSettingForm(Request $request)
    {
        $request->validate([
            'news_id.*'=>'nullable|exists:news,id'
        ]);

        $headlines = array_values(array_filter($request->news_id));

        $settings = Setting::first();
        $settings->settings_headlines = $headlines;
        
        $settings->save();

        return redirect()->back()->with('success', 'Headlines are Updated');
    }

    public function showSubHeadlinesSettingForm()
    {
        $subHeadlines = Setting::first()->sub_headlines;
        $subHeadlines = json_decode($subHeadlines);

        if(!empty($subHeadlines)){
//          ->orderByRaw('FIELD(id,5,3,7,1,6,12,8)')
            $allNews = News::whereIn('id', $subHeadlines)->orderByRaw('FIELD(id, '.implode(',', $subHeadlines).')')->get();

            return view('admin.sub_headline_settings', compact('allNews'));
        }

        return redirect()->back()->withErrors('No Sub Headline is Defined yet.');
    }

    public function submitSubHeadlinesSettingForm(Request $request)
    {
        $request->validate([
            'news_id.*'=>'nullable|exists:news,id'
        ]);

        $subHeadlines = array_values(array_filter($request->news_id));
        
        $settings = Setting::first();
        $settings->settings_sub_headlines = $subHeadlines;

        $settings->save();

        return redirect()->back()->with('success', 'Sub Headlines are Updated');
    }

    public function showMenuCategoriesForm()
    {   
        $settings = Setting::firstOrFail();
        $headerCategories = $settings->menu_categories;
        
//        ->orderByRaw('FIELD(id,5,3,7,1,6,12,8)')
        if(!empty($headerCategories)){    
            $headerCategories = Category::whereIn('id', $headerCategories)->orderByRaw('FIELD(id, '.implode(',', $headerCategories).')')->get();
            
            return view('admin.menu_categories', compact('headerCategories'));
        }

        return redirect()->back()->withErrors('No Front Category is Set yet');
    }

    public function submitMenuCategoriesForm(Request $request)
    {
        $request->validate([
            'categories_id.*'=>'nullable|exists:categories,id'
        ]);

        $categories_id = array_values(array_filter($request->categories_id));
        
        $settings = Setting::first();
        $settings->menu_categories = $categories_id;
        
        $settings->save();

        return redirect()->back()->with('success', 'Front Categories are Updated');
    }

    public function showFrontCategoriesForm()
    {   
        $settings = Setting::firstOrFail();
        $prioritizedCategories = $settings->front_categories;
        
//        ->orderByRaw('FIELD(id,5,3,7,1,6,12,8)')
        if(!empty($prioritizedCategories)){    
            $prioritizedCategoryDetails = Category::whereIn('id', $prioritizedCategories)->orderByRaw('FIELD(id, '.implode(',', $prioritizedCategories).')')->get();
            
            return view('admin.index_categories', compact('prioritizedCategoryDetails'));
        }

        return redirect()->back()->withErrors('No Front Category is Set yet');
    }

    public function submitFrontCategoriesForm(Request $request)
    {
        $request->validate([
            'categories_id.*'=>'nullable|exists:categories,id'
        ]);

        $categories_id = array_values(array_filter($request->categories_id));
        
        $settings = Setting::first();
        $settings->category_priority = $categories_id;
        $settings->save();

        return redirect()->back()->with('success', 'Front Categories are Updated');
    }

    public function showFooterCategoriesForm()
    {
        $settings = Setting::firstOrFail();
        $footerCategories = $settings->footer_categories;
        
//        ->orderByRaw('FIELD(id,5,3,7,1,6,12,8)')
        if(!empty($footerCategories)){    
            $footerCategories = Category::whereIn('id', $footerCategories)->orderByRaw('FIELD(id, '.implode(',', $footerCategories).')')->get();

            return view('admin.footer_categories', compact('footerCategories'));
        }

        return redirect()->back()->withErrors('No Footer Category is Set yet');
    }

    public function submitFooterCategoriesForm(Request $request)
    {
        $request->validate([
            'categories_id.*'=>'nullable|exists:categories,id'
        ]);

        $categories_id = array_values(array_filter($request->categories_id));
        
        $settings = Setting::first();
        $settings->category_footer = $categories_id;
        $settings->save();

        return redirect()->back()->with('success', 'Footer Categories are Updated');
    }

    public function showCreateNewsForm()
    {
        $allCategories = Category::all('id', 'name');

        if(!$allCategories->isEmpty()){
            return view('admin.create_news', compact('allCategories'));
        }

        return redirect()->back()->withErrors('Please Make Category First');
    }

    public function submitCreateNewsForm(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'required',
            'preview' => 'required|image',
        ]);

        $currentUser = Auth::guard('admin')->user();

        $newNews = new News();
        $newNews->category_id = $request->category;
        $newNews->created_admin_id = $currentUser->id;
        $newNews->title = $request->title;
        $newNews->description = $request->description;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/news/'.$originalImage->hashName());
            $newNews->preview = $originalImage->hashName();
        }

        $request->status=='on' ? $newNews->status = 1 : $newNews->status = 0;
        $newNews->save();

        return redirect()->back()->with('success', 'New News is Added');
    }


    public function showAllNews()
    {
        $allNews = News::orderBy('category_id', 'ASC')->orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.all_news', compact('allNews'));
    }

    public function showNewsEditForm($newsId)
    {
        $newsToUpdate = News::findOrFail($newsId);
        $allCategories = Category::all('id', 'name');
        return view('admin.edit_news', compact('newsToUpdate', 'allCategories'));
    }

    public function submitNewsEditForm(Request $request, $newsId)
    {
        $request->validate([
            'categoryId'=> 'required',
            'title' => 'required',
            'description' => 'required',
            'preview' => 'nullable|image',
        ]);

        $currentAdmin = Auth::guard('admin')->user();

        $newsToUpdate = News::findOrFail($newsId);
        $newsToUpdate->category_id = $request->categoryId;
        $newsToUpdate->title = $request->title;
        $newsToUpdate->description = $request->description;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/news/'.$originalImage->hashName());
            $newsToUpdate->preview = $originalImage->hashName();
        }

        $request->status=='on' ? $newsToUpdate->status = 1 : $newsToUpdate->status = 0;
        $newsToUpdate->updated_admin_id = $currentAdmin->id;
        
        $newsToUpdate->save();

        return redirect()->route('admin.edit_news', $newsToUpdate->id)->with('success', 'News is updated');
    }

    public function newsDeleteMethod($newsId)
    {
        News::destroy($newsId);
        return redirect()->back()->with('success', 'News has been Deleted');
    }


    public function showCreateVideoForm()
    {
        return view('admin.create_video');
    }

    public function submitCreateVideoForm(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'preview' => 'nullable|image',
            'url' => 'required'
        ]);

        $currentUser = Auth::guard('admin')->user();

        $newVideo = new Video();
        $newVideo->created_admin_id = $currentUser->id;
        $newVideo->title = $request->title;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/video/'.$originalImage->hashName());
            $newVideo->preview = $originalImage->hashName();
        }

        $newVideo->url = $request->url;
        $request->status=='on' ? $newVideo->status = 1 : $newVideo->status = 0;
        $newVideo->save();

        return redirect()->back()->with('success', 'New Video is Added');
    }

    public function showAllVideos()
    {
        $allVideos = Video::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.all_videos', compact('allVideos'));
    }

    public function showVideoEditForm($videoId)
    {
        $videoToUpdate = Video::findOrFail($videoId);
        return view('admin.edit_video', compact('videoToUpdate'));
    }

    public function submitVideoEditForm(Request $request, $videoId)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'preview' => 'nullable|image',
        ]);

        $currentAdmin = Auth::guard('admin')->user();

        $videoToUpdate = Video::findOrFail($videoId);
        $videoToUpdate->title = $request->title;
        $videoToUpdate->url = $request->url;

        if($request->has('preview')){
            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/video/'.$originalImage->hashName());
            $videoToUpdate->preview = $originalImage->hashName();
        }

        $request->status=='on' ? $videoToUpdate->status = 1 : $videoToUpdate->status = 0;
        $videoToUpdate->updated_admin_id = $currentAdmin->id;
        $videoToUpdate->save();

        return redirect()->route('admin.edit_video', $videoToUpdate->id)->with('success', 'Video is updated');
    }

    public function videoDeleteMethod($videoId)
    {
        Video::destroy($videoId);
        return redirect()->back()->with('success', 'Video has been Deleted');
    }

    public function showCreateImageForm()
    {
        return view('admin.create_image');
    }

    public function submitCreateImageForm(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'preview' => 'image'
        ]);

        $currentUser = Auth::guard('admin')->user();

        $newImage = new ImageModel();
        $newImage->created_admin_id = $currentUser->id;
        $newImage->title = $request->title;
        $newImage->description = $request->description;


        if($request->hasfile('preview')){

            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/previews/'.$originalImage->hashName());

            $newImage->preview = $originalImage->hashName();

        }

        $request->status=='on' ? $newImage->status = 1 : $newImage->status = 0;
        
        $newImage->save();
        
        return redirect()->back()->with('success', 'New Image is Added');
    }

    public function showAllImages()
    {
        $allImages = ImageModel::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.all_images', compact('allImages'));
    }

    public function showImageEditForm($imageId)
    {
        $imageToUpdate = ImageModel::findOrFail($imageId);
        return view('admin.edit_image', compact('imageToUpdate'));
    }

    public function submitImageEditForm(Request $request, $imageId)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'preview' => 'image',
        ]);

        $currentAdmin = Auth::guard('admin')->user();

        $imageToUpdate = ImageModel::findOrFail($imageId);
        $imageToUpdate->title = $request->title;
        $imageToUpdate->description = $request->description;

        if($request->hasfile('preview')){

            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/previews/'.$originalImage->hashName());
            $imageToUpdate->preview = $originalImage->hashName();
        }

        $imageToUpdate->updated_admin_id = $currentAdmin->id;
        $request->status=='on' ? $imageToUpdate->status = 1 : $imageToUpdate->status = 0;

        $imageToUpdate->save();

        return redirect()->route('admin.edit_image', $imageToUpdate->id)->with('success', 'Video is updated');
    }

    public function imageDeleteMethod($imageId)
    {
        ImageModel::destroy($imageId);
        return redirect()->back()->with('success', 'Image has been Deleted');
    }

    public function showCreateCategoryForm()
    {
        $allCategories = Category::all('id', 'name');
        return view('admin.create_category', compact('allCategories'));
    }

    public function submitCreateCategoryForm(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'url' => 'required|unique:categories,url',
        ]);

        $newCategory = new Category();
        $newCategory->name = $request->name;
        $newCategory->url = $request->url;
        $request->has('parent') ? $newCategory->parent = $request->parent : $newCategory->parent = 0;
        $newCategory->save();

        return redirect()->back()->with('success', 'New Category is Added');
    }

    public function showAllCategories()
    {
        $categories = Category::paginate(15);
        return view('admin.all_categories', compact( 'categories'));
    }

    public function showCategoryEditForm($categoryId)
    {
        $categoryToUpdate = Category::findOrFail($categoryId);
        $allCategories = Category::all('id', 'name');
        return view('admin.edit_category', compact('categoryToUpdate', 'allCategories'));
    }

    public function submitCategoryEditForm(Request $request, $categoryId)
    {
        $request->validate([
            'name'=>'required',
            'url'=>'required',
        ]);

        $categoryToUpdate = Category::findOrFail($categoryId);
        $categoryToUpdate->name = $request->name;
        $categoryToUpdate->url = $request->url;
        $request->has('parent') ? $categoryToUpdate->parent = $request->parent : $categoryToUpdate->parent = 0;

        $categoryToUpdate->save();
        return redirect()->route('admin.edit_category', $categoryToUpdate->id)->with('success', 'Category is Updated');
    }

    public function categoryDeleteMethod($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->childNews()->delete();
        $category->delete();

        return redirect()->back()->with('success', 'Category is Deleted');
    }

    public function showCreateEditorForm()
    {
        $allCategories = Category::all();

        if(!$allCategories->isEmpty()){
            return view('admin.create_editor', compact('allCategories'));
        }

        return redirect()->back()->withErrors('Please Create Category First');
    }

    public function submitCreateEditorForm(Request $request)
    {
        $request->validate([
            'username' => 'required||unique:editors,username',
            'password' => 'required',
            'email' => 'nullable|email|unique:editors,email',
            'categories_id' => 'required',
            'profile_pic' => 'nullable|image',
        ]);

        $newEditor = new Editor();
        $newEditor->firstname = $request->firstname;
        $newEditor->lastname = $request->lastname;
        $newEditor->username = $request->username;
        $newEditor->password = Hash::make($request->password);
        $newEditor->email = $request->email;
        $newEditor->editor_categories = $request->categories_id;
        
        if($request->has('profile_pic')){
            $originalImageFile = $request->file('profile_pic');
            $imageObject = Image::make($originalImageFile)->encode('jpg');
            $imageObject->resize(200, 200)->save('assets/editor/images/'.$originalImageFile->hashname());
            $newEditor->profile_pic = $originalImageFile->hashname();
        }

        $newEditor->phone = $request->phone;
        $newEditor->address= $request->address;
        $newEditor->city = $request->city;
        $newEditor->country = $request->country;
        $newEditor->save();

        return redirect()->back()->with('success', 'New Editor has been Created');
    }

    public function showAllEditors()
    {
        $editors = Editor::paginate(15);
        return view('admin.all_editors', compact('editors'));
    }

    public function showEditorEditForm($editorId)
    {
        $editorToUpdate = Editor::findOrFail($editorId);
        $allCategories = Category::all('id', 'name');
        return view('admin.edit_editor', compact('editorToUpdate', 'allCategories'));
    }

    public function submitEditorEditForm(Request $request, $editorId)
    {
        $profileToUpdate = Editor::findOrFail($editorId);

        $request->validate([
            'username'=>'required|unique:editors,username,'.$profileToUpdate->id,
            'email'=>'nullable|email|unique:editors,email,'.$profileToUpdate->id,
            'categories'=>'required',
            'profile_pic'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);
      
        $profileToUpdate->firstname = $request->firstname;
        $profileToUpdate->lastname = $request->lastname;
        $profileToUpdate->username = $request->username;
        $profileToUpdate->email = $request->email;
        $profileToUpdate->editor_categories = $request->categories;
            
        if($request->has('profile_pic')){
            $originImageFile = $request->file('profile_pic');
            $imageObject = Image::make($originImageFile)->encode('jpg');
            $imageObject->resize(200, 200)->save('assets/editor/images/'.$originImageFile->hashname());
            $profileToUpdate->profile_pic = $originImageFile->hashname();
        }

        $profileToUpdate->phone = $request->phone;
        $profileToUpdate->address = $request->address;
        $profileToUpdate->city = $request->city;
        $profileToUpdate->country = $request->country;
        $profileToUpdate->save();

        return redirect()->route('admin.edit_editor', $profileToUpdate->id)->with('success', 'Profile is Updated');
    }

    public function editorDeleteMethod($editorId)
    {
        Editor::destroy($editorId);
        return redirect()->back()->with('success', 'Profile is Deleted');
    }


    public function showCreateReporterForm()
    {
        return view('admin.create_reporter');
    }

    public function submitCreateReporterForm(Request $request)
    {
        $request->validate([
            'username' => 'required||unique:reporters,username|max:255',
            'password' => 'required',
            'email' => 'nullable|email|unique:reporters,email',
            'profile_pic' => 'nullable|image',
        ]);

        $newReporter = new Reporter();
        $newReporter->firstname = $request->firstname;
        $newReporter->lastname = $request->lastname;
        $newReporter->username = $request->username;
        $newReporter->password = Hash::make($request->password);
        $newReporter->email = $request->email;

        if($request->has('profile_pic')){
            $originalImageFile = $request->file('profile_pic');
            $imageObject = Image::make($originalImageFile)->encode('jpg');
            $imageObject->resize(200, 200)->save('assets/reporter/images/'.$originalImageFile->hashname());
            $newReporter->profile_pic = $originalImageFile->hashname();
        }

        $newReporter->phone = $request->phone;
        $newReporter->address= $request->address;
        $newReporter->city = $request->city;
        $newReporter->country = $request->country;
        $newReporter->save();

        return redirect()->back()->with('success', 'New Reporter has been Created');
    }

    public function showAllReporters()
    {
        $reporters = Reporter::paginate(15);
        return view('admin.all_reporters', compact( 'reporters'));
    }

    public function showReporterEditForm($reporterId)
    {
        $reporterToUpdate = Reporter::findOrFail($reporterId);
        return view('admin.edit_reporter', compact('reporterToUpdate'));
    }

    public function submitReporterEditForm(Request $request, $reporterId)
    {
        $profileToUpdate = Reporter::findOrFail($reporterId);

        $request->validate([
            'username'=>'required|unique:reporters,username,'.$profileToUpdate->id,
            'email'=>'nullable|email|unique:reporters,email,'.$profileToUpdate->id,
            'profile_pic'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        $profileToUpdate->firstname = $request->firstname;
        $profileToUpdate->lastname = $request->lastname;
        $profileToUpdate->username = $request->username;
        $profileToUpdate->email = $request->email;
        
        if($request->has('profile_pic')){
            $originImageFile = $request->file('profile_pic');
            $imageObject = Image::make($originImageFile)->encode('jpg');
            $imageObject->resize(200, 200)->save('assets/reporter/images/'.$originImageFile->hashname());
            $profileToUpdate->profile_pic = $originImageFile->hashname();
        }

        $profileToUpdate->phone = $request->phone;
        $profileToUpdate->address = $request->address;
        $profileToUpdate->city = $request->city;
        $profileToUpdate->country = $request->country;
        $profileToUpdate->save();

        return redirect()->route('admin.edit_reporter', $profileToUpdate->id)->with('success', 'Profile is Updated');
    }

    public function reporterDeleteMethod($reporterId)
    {
        Reporter::destroy($reporterId);
        return redirect()->back()->with('success', 'Profile is Deleted');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}