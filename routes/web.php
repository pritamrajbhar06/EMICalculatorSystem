<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// admin routes
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminAuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});



// user routes
Route::get('/dashboard',  [UserController::class, 'dashboard'])->name('user.dashboard');
Route::post('/calculate', [UserController::class, 'calculate'])->name('user.calculate');


