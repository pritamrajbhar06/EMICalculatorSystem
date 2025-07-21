<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EmiRuleController;
use App\Http\Controllers\SubscriptionController;
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
Route::get('/user/login', [UserController::class, 'showLoginForm'])->name('user.form');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login');
Route::get('/user/register', [UserController::class, 'showRegistrationForm'])->name('user.register');
Route::post('/user/register', [UserController::class, 'register'])->name('user.register.post');

Route::middleware('user')->group(function () {
    Route::get('/user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::middleware('subscribed')->group(function () {
        Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('/user/dashboard',  [UserController::class, 'dashboard'])->name('user.dashboard');
        Route::post('/calculate', [UserController::class, 'calculate'])->name('user.calculate');
    });
});

Route::controller(SubscriptionController::class)->group(function () {
    Route::get('subscription-checkout', 'checkout')->name('subscription.checkout');
    Route::get('subscription-success', 'success')->name('subscription.success');
});


