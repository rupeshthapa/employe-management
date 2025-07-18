<?php

use App\Http\Controllers\AllowancesController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\BonusesController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PayrollsController;
use App\Http\Controllers\PayslipController;
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
    Route::get('/department-data', [DepartmentController::class, 'indexData'])->name('department.index.data');
    Route::get('/department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::put('/department/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/department-destroy/{department}', [DepartmentController::class, 'destroy'])->name('department.destroy');
    Route::post('/department-store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/department-show/{id}', [DepartmentController::class, 'show'])->name('department.show');

    Route::get('/designation', [DesignationController::class, 'index'])->name('designations.index');
    Route::post('/designation-store', [DesignationController::class, 'store'])->name('designations.store');
    Route::get('/designation-data', [DesignationController::class, 'indexData'])->name('designations.index.data');
    Route::get('/designation/{id}/edit', [DesignationController::class, 'edit'])->name('designations.edit');
    Route::put('/designation-update/{id}/edit', [DesignationController::class, 'update'])->name('designations.update');
    Route::delete('/designation-destroy/{id}', [DesignationController::class, 'destroy'])->name('designations.destroy');



    Route::get('departments-fetch', [EmployeController::class, 'departments'])->name('department.fetch');
    Route::get('designations-fetch', [EmployeController::class, 'designations'])->name('designations.fetch');
    Route::get('/employee', [EmployeController::class, 'index'])->name('employee.index');
    Route::get('/employee-data', [EmployeController::class, 'indexData'])->name('employee.index.data');
    Route::get('/employe-create', [EmployeController::class, 'create'])->name('employe.create');
    Route::post('/employe-store', [EmployeController::class, 'store'])->name('employe.store');
    Route::post('/employee/status/update/{id}', [EmployeController::class, 'updateStatus'])->name('employee.status.update');
    Route::get('/employee/{id}/edit', [EmployeController::class, 'edit'])->name('employee.edit');
    Route::post('/employees/{id}', [EmployeController::class, 'update'])->name('employee.update');
    Route::delete('/employees-delete/{id}', [EmployeController::class, 'destroy'])->name('employee.delete');


    

    Route::get('/allowances', [AllowancesController::class, 'index'])->name('allowances.index');
    Route::post('/allowances-store', [AllowancesController::class, 'store'])->name('allowances.store');
    Route::get('/allowances-data', [AllowancesController::class, 'indexData'])->name('allowances.index.data');
    Route::get('/allowances/{id}/edit', [AllowancesController::class, 'edit'])->name('allowances.edit');
    Route::put('/allowances-update/{id}', [AllowancesController::class, 'update'])->name('allowances.update');
    Route::delete('/allowances-destroy/{allowance}', [AllowancesController::class, 'destroy'])->name('allowances.destroy');



    Route::get('/bonuses', [BonusesController::class, 'index'])->name('bonuses.index');
    Route::post('/bonuses-store', [BonusesController::class, 'store'])->name('bonuses.store');
    Route::get('/bonuses-data', [BonusesController::class, 'indexData'])->name('bonuses.index.data');
    Route::get('/bonuses/{id}/edit', [BonusesController::class, 'edit'])->name('bonuses.edit');
    Route::put('/bonuses-update/{id}', [BonusesController::class, 'update'])->name('bonuses.update');
    Route::delete('/bonuses-destroy/{bonus}', [BonusesController::class, 'destroy'])->name('bonuses.destroy');

    

    

    Route::get('/payrolls', [PayrollsController::class, 'index'])->name('payrolls.index');
    Route::post('/payrolls-store', [PayrollsController::class, 'store'])->name('payrolls.store');
    Route::get('/payrolls-data', [PayrollsController::class, 'indexData'])->name('payrolls.index.data');
    Route::post('/payrolls/{id}/udpateStatus', [PayrollsController::class, 'updateStatus'])->name('payrolls.updateStatus');
    Route::get('/payrolls/{id}/edit', [PayrollsController::class, 'edit'])->name('payrolls.edit');
    Route::post('/payrolls-update/{id}', [PayrollsController::class, 'update'])->name('payrolls.update');
    Route::delete('/payrolls-destroy/{id}', [PayrollsController::class, 'destroy'])->name('payrolls.destroy');

    

    




    Route::get('/payslip', [PayslipController::class, 'index'])->name('payslip.index');
    Route::get('/employee/salary/{id}', [PayslipController::class, 'getEmployeeSalary'])->name('payslip.getEmployeeSalary');
    Route::get('/bonus/amount/{id}', [PayslipController::class, 'getBonusAmount'])->name('payslip.getBonusAmount');
    Route::post('/payslip-store', [PayslipController::class, 'store'])->name('payslip.store');
    Route::get('/payslip-data', [PayslipController::class, 'indexData'])->name('payslip.index.data');
    Route::get('/payslip/{id}/edit', [PayslipController::class, 'edit'])->name('payslip.edit');


    



    });
});

