<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



// https://chatgpt.com/share/68297fb8-c978-8008-8058-e7d3bfaa4882

Route::name('auth.')->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login-index');
    Route::get('/register', [RegisterController::class, 'index'])->name('register-index');
});


