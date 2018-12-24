<?php

namespace App\Http\Controllers;

use App\Category;
use App\Editor;
use App\Post;
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
        $username = Auth::guard('editor')->user()->username;
        return view('editor.layout.app', compact('username'));
    }

    public function showProfileForm(){
        $currentEditor =  Auth::guard('editor')->user();
//        $categorySelected = Category::find(json_decode($currentEditor->categories));
//        $categorySelected = Category::whereIn('id', $currentEditor->categories)->get();
//        $profileData = array('firstname'=>$cuurentEditor->firstname, 'lastname'=>$cuurentEditor->lastname, 'username'=>$cuurentEditor->username, 'email'=>$cuurentEditor->email, 'picpath'=>$cuurentEditor->picpath);
        $profileData = array('firstname'=>$currentEditor->firstname, 'lastname'=>$currentEditor->lastname, 'username'=>$currentEditor->username, 'email'=>$currentEditor->email, 'picpath'=>$currentEditor->picpath, 'phone'=>$currentEditor->phone, 'address'=>$currentEditor->address, 'city'=>$currentEditor->city, 'state'=>$currentEditor->state, 'country'=>$currentEditor->country);
        return view('editor.profile', $profileData);
    }

    public function submitProfileForm(Request $request){
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'nullable',
//            'email'=>'nullable|email|unique:editors,email',
            'profilePic'=>'nullable|image',
            'phone'=>'nullable|numeric',
            'address'=>'nullable',
            'city'=>'nullable',
            'state'=>'nullable',
            'country'=>'nullable',
        ]);

        $profileToUpdate = Auth::guard('editor')->user();

//        $profileToUpdate->firstname = $request->firstName;
//        $profileToUpdate->lastname = $request->lastName;
///*        $profileToUpdate->username = $request->userName;*/
//        $profileToUpdate->email = $request->email;

        if($request->has('profilePic')){
            $originImageFile = $request->file('profilePic');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(150, 150)->save('assets/editor/images/'.$originImageFile->hashname());
//            $profileToUpdate->picpath = $originImageFile->hashName();
        }

//        $profileToUpdate->phone = $request->phone;
//        $profileToUpdate->address = $request->address;
//        $profileToUpdate->city = $request->city;
//        $profileToUpdate->state = $request->state;
//        $profileToUpdate->country = $request->country;
//        $profileToUpdate->save();

        if(isset($originImageFile))
            $profileToUpdate->update(['firstname'=>$request->firstName, 'lastName'=>$request->lastName, 'email'=>$request->email, 'picpath'=>$originImageFile->hashname(), 'phone'=>$request->phone, 'address'=>$request->address, 'city'=>$request->city, 'state'=>$request->state, 'country'=>$request->country]);
        else
            $profileToUpdate->update(['firstname'=>$request->firstName, 'lastName'=>$request->lastName, 'email'=>$request->email, 'phone'=>$request->phone, 'address'=>$request->address, 'city'=>$request->city, 'state'=>$request->state, 'country'=>$request->country]);


        return redirect()->back()->with('updateMsg', 'Profile Successfully Updated')->with('username', $request->userName);
    }

    public function showPasswordForm(){
        $username = Auth::guard('editor')->user()->username;
        return view('editor.password', compact('username'));
    }

    public function submitPasswordForm(Request $request){
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $profileToUpdate = Auth::guard('editor')->user();

        if(Hash::check($request->currentPassword, $profileToUpdate->password)){
            $profileToUpdate->password = Hash::make($request->password);
            return redirect()->back()->with('updateMsg', 'Password is Updated')->with('username', $profileToUpdate->username);
        }

        return redirect()->back()->withErrors('Current Password is Wrong');
    }

    public function showAllPosts(){
        $currentEditor = Auth::guard('editor')->user();
        $editorCategories = json_decode($currentEditor->categories);

        $posts = Post::all()->whereIn('category_id', $editorCategories);

        $username = $currentEditor->username;
        return view('editor.all_post', compact('posts', 'username'));
    }

    public function showPostEditForm($postid){
//        $request->validate([
////            'title'=>'required',
////            'description'=>'required',
////            'title'=>'required',
////        ]);
        $postToUpdate = Post::find($postid);
        $allCategories = Category::all('id', 'name');

        $currentUserName = Auth::guard('editor')->user()->username;

        return view('editor.single_post', compact('postToUpdate', 'allCategories'))->with('username', $currentUserName);
    }

    public function submitPostEditForm(Request $request, $postid){
        $request->validate([
            'title'=>'required',
            'description'=>'required',
        ]);

        $currentEditor = Auth::guard('editor')->user();

        $postToUpdate = Post::find($postid);
        $postToUpdate->category_id = $request->categoryId;
        $postToUpdate->title = $request->title;
        $postToUpdate->description = $request->description;
        ($request->status=='on') ? $postToUpdate->status = 1 : $postToUpdate->status = 0;
        $postToUpdate->save();

        return redirect()->back()->with('updateMsg', 'News is Updated')->with('username', $currentEditor->username);
    }

    public function postDeleteMethod($postid){
        Post::destroy($postid);
        $currentEditor = Auth::guard('editor')->user();
        return redirect()->back()->with('updateMsg', 'Post is Updated')->with('username', $currentEditor->username);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('editor.login');
    }
}
