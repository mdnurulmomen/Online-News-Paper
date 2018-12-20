<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Category;
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
        return view('admin.layout.app');
    }

    public function showProfileForm(){
        $admin =  Auth::guard('admin')->user();
        $profileData = array('firstname'=>$admin->firstname, 'lastname'=>$admin->lastname, 'username'=>$admin->username, 'email'=>$admin->email, 'picpath'=>$admin->picpath);
        return view('admin.profile', $profileData);
    }

    public function submitProfileForm(Request $request)
    {
        $request->validate([
            'adminFirstName'=>'required',
            'adminLastName'=>'nullable',
            'adminUserName'=>'required',
            'adminEmail'=>'nullable',
            'adminPic'=>'nullable|image',
        ]);

        $profileToUpdate = Auth::guard('admin')->user();

        $profileToUpdate->firstname = $request->adminFirstName;
        $profileToUpdate->lastname = $request->adminLastName;
        $profileToUpdate->username = $request->adminUserName;
        $profileToUpdate->email = $request->adminEmail;

        if($request->has('adminPic')){
            $originImageFile = $request->file('adminPic');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(200, 200)->save('assets/admin/images/'.$originImageFile->hashname());
            Auth::guard('admin')->user()->picpath = $originImageFile->hashName();
        }

        $profileToUpdate->save();
//        Auth::guard('admin')->user()->update(['firstname'=>$request->adminFirstName, 'lastName'=>$request->adminLastName, 'username'=>$request->adminUserName, 'email'=>$request->adminEmail, 'picpath'=>$originImageFile->hashname()]);
        return redirect()->back()->with('updateMsg', 'Profile Successfully Updated');
    }

    public function showPasswordForm(){
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
            return redirect()->back()->with('updateMsg', 'Password Successfully Changed');
        }

        return redirect()->back()->withErrors('Current Password is not Correct');
    }

    public function showCreateCategoryForm()
    {
        $allCategories = Category::all();
        foreach ($allCategories as $category){
            $categoryNames[] = $category->name;
        }

        return view('admin.category', $categoryNames);
    }

    public function submitCreateCategoryForm(Request $request){
        $request->validate([
            'categoryName' => 'required|unique:categories,name',
            'categoryURl' => 'required|unique:categories,url',
            'categoryParent' => 'nullable',
            'color' => 'nullable',
        ]);
        $newCategory = new Category();
        $newCategory->name = $request->categoryName;
        $newCategory->url = $request->categoryURl;
        $request->has('categoryParent') ? $newCategory->parent = $request->categoryParent : $newCategory->parent = 0;
        $request->has('color') ? $newCategory->color = $request->color : $newCategory->color = null;
        $newCategory->save();

        return redirect()->back()->with('updateMsg', 'New Category is Added');
    }

    public function showCreateEditorForm(){
        return view('admin.editor');
    }

    public function submitCreateEditorForm(){
        return 'Submit Editor';
    }

    public function showCreateReporterForm(){
        return view('admin.reporter');
    }

    public function submitCreateReporterForm(){
        return 'Submit Reporter';
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.loginForm');
    }
}
