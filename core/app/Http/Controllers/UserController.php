<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    	$this->middleware('guest:editor')->except('logout');
    	$this->middleware('guest:reporter')->except('logout');
    }

    public function showLoginForm(){
        return view('user.login');
    }
    
    public function guard(){
        return Auth::guard();
    }

    public function username(){
        return 'username';
    }

    // protected $redirectTo = '/';
    public function redirectPath(){
    	return '/';
    }
    
    use AuthenticatesUsers;

    public function showRegistrationForm()
    {
        return view('user.create_user');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required||unique:users,username|max:255',
            'password' => 'required',
            'email' => 'nullable|email|unique:reporters,email',
            'picpath' => 'nullable|image',
        ]);
    }

    protected function create($request)
    {
        if($request->has('profile_pic')){
            $originalImageFile = $request->profile_pic;
            $imageObject = Image::make($originalImageFile);
            $imageObject->resize(150, 150)->save('assets/user/images/'.$originalImageFile->hashname());
            // $newReporter->picpath = $originalImageFile->hashname();
        }

        return User::create([
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'city' => $request['city'],
            'country' => $request['country'],
        ]);
    }

    use RegistersUsers;

    public function submitCommentForm(Request $request, $newsId, $userId){
    	
    	$request->validate([
    		'body' => 'required'
    	]);


    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // public function login(Request $request){

    //     if(Auth::attempt(['username'=>$request->username, 'password'=>$request->password])){
    //         return redirect()->route('front.index');
    //     }

    //     return redirect()->back()->withErrors('Wrong Username or Password');
    // }
}
