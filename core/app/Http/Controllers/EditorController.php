<?php

namespace App\Http\Controllers;

use App\Category;
use App\Editor;
use App\News;
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
        $Editor =  Auth::guard('editor')->user();
        return view('editor.profile', compact('Editor'));
    }

    public function submitProfileForm(Request $request)
    {
        $profileToUpdate = Auth::guard('editor')->user();

        $request->validate([
            'email'=>'nullable|email|unique:editors,email,'.$profileToUpdate->id,
            'picpath'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        $profileToUpdate->firstname = $request->firstname;
        $profileToUpdate->lastname = $request->lastname;
        $profileToUpdate->email = $request->email;

        if($request->has('profile_pic')){
            $originImageFile = $request->file('profile_pic');
            $imageObject = Image::make($originImageFile)->encode('jpg');
            $imageObject->resize(200, 200)->save('assets/editor/images/'.$originImageFile->hashname());

            $profileToUpdate->profile_pic = $originImageFile->hashname());
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
            $profileToUpdate->password = Hash::make($request->password);
            return redirect()->back()->with('updateMsg', 'Password is Updated');
        }

        return redirect()->back()->withErrors('Current Password is Wrong');
    }

    public function showAllNews()
    {
        $currentEditor = Auth::guard('editor')->user();
        
        $editorCategories = json_decode($currentEditor->category_id);

        $allNews = News::all()->whereIn('category_id', $editorCategories);

        return view('editor.all_news', compact('allNews'));
    }

    public function showNewsEditForm($newsId)
    {
        $newsToUpdate = News::find($newsId);
        $allCategories = Category::all('id', 'name');
        return view('editor.edit_news', compact('newsToUpdate', 'allCategories'));
    }

    public function submitNewsEditForm(Request $request, $newsId)
    {
        $request->validate([
            'category'=>'required',
            'title'=>'required',
            'description'=>'required',
            'picpath'=>'nullable|image',
        ]);

        $currentEditor = Auth::guard('editor')->user();

        $newsToUpdate = News::find($newsId);
        $newsToUpdate->category_id = $request->category;
        $newsToUpdate->title = $request->title;
        $newsToUpdate->description = $request->description;

        if($request->has('picpath')){
            $originalImage = $request->file('picpath');
            $imageInterventionObj = Image::make($originalImage);
            $imageInterventionObj->resize('300', '300')->save('assets/front/images/'.$originalImage->hashName());
            $newsToUpdate->picpath = $originalImage->hashName();
        }

        ($request->status=='on') ? $newsToUpdate->status = 1 : $newsToUpdate->status = 0;
        $newsToUpdate->updated_editor_id = $currentEditor->id;
        $newsToUpdate->save();

        return redirect()->back()->with('updateMsg', 'News is Updated');
    }

    public function newsDeleteMethod($newsId)
    {
        News::destroy($newsId);
        return redirect()->back()->with('updateMsg', 'News is Deleted');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('editor.login');
    }
}
