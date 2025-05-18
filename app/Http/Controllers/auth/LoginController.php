<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(LoginRequest $loginRequest){
         $validated =$loginRequest->validated();
        if(Auth::attempt([
            'email' =>$validated['email'],
            'password' =>$validated['password']
        ])){
            
            return redirect()->route('index')->with('success', 'Login Successful!');
        }
        return back()->with('error', 'Failed to login!');
    }
}
