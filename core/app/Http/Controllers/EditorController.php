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
    public function showLoginForm(){
        return view('editor.login');
    }

    public function login(Request $request){
        if(Auth::guard('editor')->attempt(['username'=>$request->username, 'password'=>$request->password])){
            return redirect()->route('editor.home');
        }
        return redirect()->back()->withErrors('Wrong Username or Password');
    }

    public function homeMethod(){
        return view('editor.layout.app');
    }

    public function showProfileForm(){
        $currentEditor =  Auth::guard('editor')->user();
        $profileData = array('firstname'=>$currentEditor->firstname, 'lastname'=>$currentEditor->lastname, 'username'=>$currentEditor->username, 'email'=>$currentEditor->email, 'picpath'=>$currentEditor->picpath, 'phone'=>$currentEditor->phone, 'address'=>$currentEditor->address, 'city'=>$currentEditor->city, 'state'=>$currentEditor->state, 'country'=>$currentEditor->country);
        return view('editor.profile', $profileData);
    }

    public function submitProfileForm(Request $request){

        $profileToUpdate = Auth::guard('editor')->user();

        $request->validate([
            'email'=>'nullable|email|unique:editors,email,'.$profileToUpdate->id,
            'picpath'=>'nullable|image',
            'phone'=>'nullable|numeric',
        ]);

        if($request->has('picpath')){
            $originImageFile = $request->file('picpath');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(150, 150)->save('assets/editor/images/'.$originImageFile->hashname());
        }

        if(isset($originImageFile))
            $profileToUpdate->update(['firstname'=>$request->firstname, 'lastName'=>$request->lastname, 'email'=>$request->email, 'picpath'=>$originImageFile->hashname(), 'phone'=>$request->phone, 'address'=>$request->address, 'city'=>$request->city, 'country'=>$request->country]);
        else
            $profileToUpdate->update($request->all());


        return redirect()->back()->with('updateMsg', 'Profile Successfully Updated');
    }

    public function showPasswordForm(){
        return view('editor.password');
    }

    public function submitPasswordForm(Request $request){
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

    public function showAllNews(){
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

    public function submitNewsEditForm(Request $request, $newsId){
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
            $imageInterventionObj->resize('250', '250')->save('assets/front/images/'.$originalImage->hashName());
            $newsToUpdate->picpath = $originalImage->hashName();
        }

        ($request->status=='on') ? $newsToUpdate->status = 1 : $newsToUpdate->status = 0;
        $newsToUpdate->updated_editor_id = $currentEditor->id;
        $newsToUpdate->save();

        return redirect()->back()->with('updateMsg', 'News is Updated');
    }

    public function newsDeleteMethod($newsId){
        News::destroy($newsId);
        return redirect()->back()->with('updateMsg', 'News is Deleted');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('editor.login');
    }
}
