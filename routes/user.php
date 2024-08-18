<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customer\ShopController;
use App\Http\Controllers\customer\CommentController;
use App\Http\Controllers\customer\ProfileController;
use App\Http\Controllers\customer\PasswordController;
use App\Http\Controllers\customer\ShopDetailController;
use App\Http\Controllers\customer\UserDashboardController;
// user Page
Route::group(['prefix' => "user", "middleware" => ["auth","user"]],function(){
    Route::get('/home',[UserDashboardController::class,'userDashboard'])->name("userDashboard");
    Route::get('/categories/{cate_id?}',[UserDashboardController::class,'cateItem'])->name("cateItem");
    Route::get('/shop/{cate_id?}',[ShopController::class,'shopDashboard'])->name("shopDashboard");
    Route::get('/shopdetail/{product_id?}',[ShopDetailController::class,'shopDetail'])->name("shopDetail");
    Route::post('/comment',[CommentController::class,'comment'])->name('comment');
    Route::post('/Rating',[ShopDetailController::class,'rating'])->name('rating');
    //profile
    Route::get('profile',[ProfileController::class,'userProfile'])->name('UserProfile');
    Route::post('edit',[ProfileController::class,'UpdateProfileDetails'])->name('userProfileEdit');
    // cart
    Route::get('cart',[ShopController::class,'CartDashboard'])->name('CartDashboard');
    Route::get('qty/add',[ShopController::class,'addQty'])->name('addQty');
    Route::Post('addItem',[ShopController::class,'addItem'])->name('addItem');
    Route::get('remove/cart',[ShopController::class,'removeCart'])->name('removeCart');
    Route::get('order',[ShopController::class,'orderProcess'])->name('orderProcess');
    //Order Process
    Route::get('order/list',[ShopController::class,'orderList'])->name('orderList');
    Route::get('order/details/{order_code}',[ShopController::class,'orderdetails'])->name('orderdetails');
    // Payment Process
    Route::get('payment',[ShopController::class,'payment'])->name('payment');
    Route::post('payment',[ShopController::class,'payslipData'])->name('payslipData');
    //contact process
    Route::get('contact',[ShopController::class,'contact'])->name('contact');
    Route::post('userdata',[ShopController::class,'userdata'])->name('userdata');
});
