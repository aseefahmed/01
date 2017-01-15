<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        if(Auth::check()){
            return redirect('/dashboard');
        }
        else{
            return view('login/login_form');
        }
    }

    public function isUserLoggedIn(){
        if(Auth::check()){
            return redirect('/dashboard');
        }
        else{
            return redirect('/login');
        }
    }

    public function get_token()
    {
        return Session::token();
    }

    public function processLogin(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            if(Auth::user()->flag == 0)
            {
                 return -2;   
            }
            else
            {
                $user = User::find(Auth::user()->id);
                $user->logged_in = 1;
                $user->save();
                return Auth::user();
            }
        }
        else{
            return -1;
        }
    }

    public function getUsers($user_id)
    {
        return User::where('flag', 1)->where('id', '!=', $user_id)->get();
    }

    public function registerUser(Request $request)
    {
        $count = User::where('email', $request->email_address)->count();
        if($count > 0)
        {
            return 1;
        }
        else
        {
            DB::table('users')->insert(
                [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email_address,
                    'password' => Hash::make($request->pass),
                    'verification_code' => md5(uniqid()),
                    'flag' => 0
                ]
            );

            return 2;
        }
    }

    public function doLogout($user_id){
        $user = User::find($user_id);
        $user->logged_in = 0;
        $user->save();
    }
}
