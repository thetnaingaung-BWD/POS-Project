<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProfileDetailController;
use App\Http\Controllers\CreateNewAdminController;
use App\Http\Controllers\UserAndAdminListController;
use App\Http\Controllers\customer\UserDashboardController;
require __DIR__.'/auth.php';
require_once __DIR__.'/user.php';
require_once __DIR__.'/admin.php';

//  Strat project
Route::redirect('/','/auth/login');
// Simple Login And Register
Route::middleware('admin')->group(function () {
    Route::get('auth/login',[AuthController::class,'login'])->name('AuthLogin');
    Route::get('auth/register',[AuthController::class,'register'])->name('AuthRegister');
});


// github and google login
Route::get('/auth/{provider}/redirect', [ProviderController::class,"redirect"] );
Route::get('/auth/{provider}/callback', [ProviderController::class,"callback"]  );







