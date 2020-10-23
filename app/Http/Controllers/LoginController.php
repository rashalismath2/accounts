<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect("/login");
    }

    public function login(Request $request){
        $request->validate([
            "email"=>["required","email"],
            "password"=>["required"]
        ]);


        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user=User::where("email",$request->email)->first();
            Cookie::queue('api_token', $user->createToken("Auth token")->accessToken,30);
            
            return redirect()->route("home");
        }

    }
}
