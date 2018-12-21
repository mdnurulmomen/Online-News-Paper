<?php

namespace App\Http\Controllers;

use App\Category;
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
        $username = Auth::guard('reporter')->user()->username;
        return view('reporter.layout.app', compact('username'));
    }

    public function showProfileForm(){
        $currentReporter =  Auth::guard('reporter')->user();

        $profileData = array('firstname'=>$currentReporter->firstname, 'lastname'=>$currentReporter->lastname, 'username'=>$currentReporter->username, 'email'=>$currentReporter->email, 'picpath'=>$currentReporter->picpath, 'phone'=>$currentReporter->phone, 'address'=>$currentReporter->address, 'city'=>$currentReporter->city, 'state'=>$currentReporter->state, 'country'=>$currentReporter->country);
        return view('reporter.profile', $profileData);
    }

    public function submitProfileForm(Request $request){
        $request->validate([
            'firstName'=>'required',
            'lastName'=>'nullable',
//            'userName'=>'required',
            'email'=>'nullable',
            'profilePic'=>'nullable|image',
            'phone'=>'nullable|numeric',
            'address'=>'nullable',
            'city'=>'nullable',
            'state'=>'nullable',
            'country'=>'nullable',
        ]);

        $profileToUpdate = Auth::guard('reporter')->user();

        $profileToUpdate->firstname = $request->firstName;
        $profileToUpdate->lastname = $request->lastName;
//        $profileToUpdate->username = $request->userName;
        $profileToUpdate->email = $request->email;

        if($request->has('profilePic')){
            $originImageFile = $request->file('profilePic');
            $imageObject = Image::make($originImageFile);
            $imageObject->resize(150, 150)->save('assets/reporter/images/'.$originImageFile->hashname());
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
        $username = Auth::guard('reporter')->user()->username;
        return view('reporter.password', compact('username'));
    }

    public function submitPasswordForm(Request $request){
        $request->validate([
            'currentPassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $profileToUpdate = Auth::guard('reporter')->user();

        if(Hash::check($request->currentPassword, $profileToUpdate->password)){
            $profileToUpdate->password = Hash::make($request->password);
            return redirect()->back()->with('updateMsg', 'Password is Updated')->with('username', $profileToUpdate->username);
        }

        return redirect()->back()->withErrors('Current Password is Wrong');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('reporter.loginForm');
    }
}
