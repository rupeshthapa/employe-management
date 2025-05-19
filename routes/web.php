<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;



// https://chatgpt.com/share/68297fb8-c978-8008-8058-e7d3bfaa4882

Route::name('user.')->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login-index');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/register', [RegisterController::class, 'index'])->name('register-index');
    Route::post('/register-store', [RegisterController::class, 'store'])->name('store');

    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function(){

Route::name('nav.')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
    Route::post('/department-store', [DepartmentController::class, 'store'])->name('department.store');

    Route::get('/employe', [EmployeController::class, 'index'])->name('employe.index');
    Route::get('/employe-create', [EmployeController::class, 'create'])->name('employe.create');
    });
});

