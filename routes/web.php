<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



// https://chatgpt.com/share/68297fb8-c978-8008-8058-e7d3bfaa4882

Route::name('user.')->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login-index');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', [RegisterController::class, 'index'])->name('register-index');
    Route::post('/register-store', [RegisterController::class, 'store'])->name('store');
});


