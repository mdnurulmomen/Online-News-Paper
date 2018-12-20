<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function showLoginForm(){
        return view('editor.login');
    }

    public function login(Request $request){
        if(Auth::guard('editor')->attempt(['username'=>$request->username, 'password'=>$request->password])){
            return redirect()->route('editor.home')->with('updateMsg', 'Your have Logged in');
        }
        return redirect()->back()->withErrors('Wrong Username or Password');
    }

    public function homeMethod(){
        $userName = Auth::guard('editor')->user()->username;
        return view('editor.layout.app', compact('username'));
    }

    public function showProfileForm(){
        $editor =  Auth::guard('editor')->user();
        $profileData = array('firstname'=>$editor->firstname, 'lastname'=>$editor->lastname, 'username'=>$editor->username, 'email'=>$editor->email, 'picpath'=>$editor->picpath);
        return view('editor.profile', $profileData);

        /*$profileData = array('firstname'=>$editor->firstname, 'lastname'=>$editor->lastname, 'username'=>$editor->username,
            'email'=>$editor->email, 'picpath'=>$editor->picpath, 'phone'=>$editor->phone, 'address'=>$editor->address,
            'city'=>$editor->city, 'state'=>$editor->state, 'country'=>$editor->country);*/
    }
    public function submitProfileForm(){
        return 'Submit Profile';
    }

    public function showPasswordForm(){
        return 'SHow Password';
    }

    public function submitPasswordForm(){
        return 'Submit Password';
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('editor.loginForm');
    }
}
