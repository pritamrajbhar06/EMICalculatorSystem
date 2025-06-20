<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EmiRuleController;
use App\Http\Controllers\TenureController;
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
    
    Route::get('/tenures', [TenureController::class, 'index'])->name('tenures.index');
    Route::post('/tenures', [TenureController::class, 'store'])->name('tenures.create');
    Route::get('/tenures/{id}/edit', [TenureController::class, 'edit'])->name('tenures.edit'); // <-- add this
    Route::put('/tenures/{id}', [TenureController::class, 'update'])->name('tenures.update');
    Route::get('/tenures/{id}', [TenureController::class, 'destroy'])->name('tenures.destroy');


    //Emi Rules
    Route::get('/emi-rules', [EmiRuleController::class, 'index'])->name('emi-rules.index');
    Route::post('/emi-rules', [EmiRuleController::class, 'store'])->name('emi-rules.create');
    Route::get('/emi-rules/{id}/edit', [EmiRuleController::class, 'edit'])->name('emi-rules.edit');
    Route::put('/emi-rules/{id}', [EmiRuleController::class, 'update'])->name('emi-rules.update');
    Route::get('/emi-rules/{id}', [EmiRuleController::class, 'destroy'])->name('emi-rules.destroy');
    
});



// user routes
Route::get('/dashboard',  [UserController::class, 'dashboard'])->name('user.dashboard');
Route::post('/calculate', [UserController::class, 'calculate'])->name('user.calculate');


