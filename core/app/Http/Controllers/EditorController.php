<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use App\Video;
use App\Editor;
use App\Image as ImageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class EditorController extends Controller
{
    public function showLoginForm()
    {
        return view('editor.login');
    }

    public function login(Request $request)
    {
        if(Auth::guard('editor')->attempt(['username'=>$request->username, 'password'=>$request->password])){
            return redirect()->route('editor.home');
        }
        return redirect()->back()->withErrors('Wrong Username or Password');
    }

    public function homeMethod()
    {
        return view('editor.layout.app');
    }

    public function showProfileForm()
    {
        $editor =  Auth::guard('editor')->user();
        return view('editor.profile', compact('editor'));
    }

    public function submitProfileForm(Request $request)
    {
        $profileToUpdate = Auth::guard('editor')->user();

        $request->validate([
            'email'=>'nullable|email|unique:editors,email,'.$profileToUpdate->id,
            'profile_pic'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        $profileToUpdate->firstname = $request->firstname;
        $profileToUpdate->lastname = $request->lastname;
        $profileToUpdate->email = $request->email;

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

        return redirect()->back()->with('success', 'Profile is Updated');
    }

    public function showPasswordForm()
    {
        return view('editor.password');
    }

    public function submitPasswordForm(Request $request)
    {
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $profileToUpdate = Auth::guard('editor')->user();

        if(Hash::check($request->currentPassword, $profileToUpdate->password)){

            Auth::guard('admin')->user()->password = Hash::make($request->password);
            return redirect()->back()->with('success', 'Password is Updated');
        }

        return redirect()->back()->withErrors('Current Password is Wrong');
    }

    public function showAllNews()
    {
        $currentEditor = Auth::guard('editor')->user();
        
        $editorCategories = json_decode($currentEditor->categories_id);

        $allNews = News::all()->whereIn('category_id', $editorCategories);

        return view('editor.all_news', compact('allNews'));
    }

    public function showNewsEditForm($newsId)
    {
        $newsToUpdate = News::findOrFail($newsId);

        $currentEditor = Auth::guard('editor')->user();
        $editorCategories = json_decode($currentEditor->categories_id);

        $allCategories = Category::all()->whereIn('id', $editorCategories);

        return view('editor.edit_news', compact('newsToUpdate', 'allCategories'));
    }

    public function submitNewsEditForm(Request $request, $newsId)
    {
        $request->validate([
            'categoryId'=>'required',
            'title'=>'required',
            'description'=>'required',
            'preview'=>'nullable|image',
        ]);

        $currentEditor = Auth::guard('editor')->user();

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

        $request->status=='on' ? $newsToUpdate->status = 1 : $newsToUpdate->status = 0;
        $newsToUpdate->updated_editor_id = $currentEditor->id;

        $newsToUpdate->save();

        return redirect()->back()->with('success', 'News is Updated');
    }

    public function newsDeleteMethod($newsId)
    {
        News::destroy($newsId);
        return redirect()->back()->with('success', 'News is Deleted');
    }


    public function showAllImages()
    {
        $allImages = ImageModel::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->paginate(15);
        return view('editor.all_images', compact('allImages'));
    }

    public function showImageEditForm($imageId)
    {
        $imageToUpdate = ImageModel::findOrFail($imageId);
        return view('editor.edit_image', compact('imageToUpdate'));
    }

    public function submitImageEditForm(Request $request, $imageId)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'preview' => 'image',
        ]);

        $currentEditor = Auth::guard('editor')->user();

        $imageToUpdate = ImageModel::findOrFail($imageId);
        $imageToUpdate->title = $request->title;
        $imageToUpdate->description = $request->description;

        if($request->hasfile('preview')){

            $originalImage = $request->file('preview');
            $imageInterventionObj = Image::make($originalImage)->encode('jpg');
            $imageInterventionObj->resize('640', '360')->save('assets/front/images/previews/'.$originalImage->hashName());
            $imageToUpdate->preview = $originalImage->hashName();
        }

        $imageToUpdate->updated_editor_id = $currentEditor->id;
        $request->status=='on' ? $imageToUpdate->status = 1 : $imageToUpdate->status = 0;

        $imageToUpdate->save();

        return redirect()->route('editor.edit.image', $imageToUpdate->id)->with('success', 'Image is updated');
    }


    public function showAllVideos()
    {
        $allVideos = Video::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->paginate(15);
        return view('editor.all_videos', compact('allVideos'));
    }

    public function showVideoEditForm($videoId)
    {
        $videoToUpdate = Video::findOrFail($videoId);
        return view('editor.edit_video', compact('videoToUpdate'));
    }

    public function submitVideoEditForm(Request $request, $videoId)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'preview' => 'nullable|image',
        ]);

        $currentEditor = Auth::guard('editor')->user();

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
        $videoToUpdate->updated_editor_id = $currentEditor->id;
        $videoToUpdate->save();

        return redirect()->route('editor.edit.video', $videoToUpdate->id)->with('success', 'Video is updated');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('editor.login');
    }
}
