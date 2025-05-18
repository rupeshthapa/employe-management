<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(){
        Auth::logout();
        return redirect()->route('user.login-index')->with('success', 'Logout Successful!');
    }
}
