<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CheckUpController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::middleware('auth')->prefix('user')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // User management routes
    Route::get('/list', [UserController::class, 'getUserList'])->name('user.list');
    Route::match(['get', 'post'], '/create', [UserController::class, 'createUser'])->name('user.create');
    Route::match(['get', 'post'], '/edit/{id}', [UserController::class, 'editUser'])->name('user.edit');
    Route::post('/delete/{id}', [UserController::class, 'deleteUser'])->name('user.delete');

    // Hospital management
    Route::get('/hospital',[HospitalController::class, 'getHospital'])->name('hospital.index');
    Route::post('/hospital',[HospitalController::class, 'storeHospital'])->name('hospital.store');
    Route::get('/hospital/getData',[HospitalController::class,'getData'])->name('hospital.getdata');
    Route::delete('/hospital/{id}', [HospitalController::class,'deleteHospital'])->name('hospital.delete');

    // Package management
    Route::get('/package',[PackageController::class, 'getPackage'])->name('package.index');
    Route::post('/package',[PackageController::class, 'storePackage'])->name('package.store');
    Route::get('/package/getData',[PackageController::class,'getData'])->name('package.getdata');
    Route::delete('/package/{id}', [PackageController::class,'deletePackage'])->name('package.delete');

    // Employee management
    Route::resource('employee', EmployeeController::class);
    Route::post('employee/import',[EmployeeController::class, 'importExcel'])->name('employee.import');

    // Check-up History
    Route::get('/checkup-history',[CheckUpController::class,'getCheckUpHistory'])->name('checkup.history');
    Route::get('/checkup-history/search',[CheckUpController::class,'searchCheckUpHistory'])->name('checkup.history.search');

    // Check-up Current Month
    Route::get('/checkup-current-month',[CheckUpController::class,'getCheckUpCurrentMonth'])->name('checkup.current_month');
    Route::get('/checkup-current-month/getHospital',[CheckUpController::class,'getHospital'])->name('checkup.current_month.gethospital');
    Route::post('/checkup-current-month/informCheckup',[CheckUpController::class,'informCheckup'])->name('checkup.inform');
    
});
