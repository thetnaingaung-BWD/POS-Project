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
use App\Http\Controllers\SaleInfoController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\ProfileDetailController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CreateNewAdminController;
use App\Http\Controllers\UserAndAdminListController;
use App\Http\Controllers\customer\UserDashboardController;
// admin page
Route::group(['prefix' => "admin", "middleware" => "auth"],function(){
    // Route::get('/home',function(){
    //     return view('Admin_Dashboard.home');
    // })->name("adminDashboard");
    Route::get('/home',[AdminDashboardController::class,'home'])->name('adminDashboard');
    // Route::group(['prefix' => '/dashboard', 'middleware' => 'admin'],function () {
    //     // Order Process Section
    //     Route::get('home',[AdminDashboardController::class,'home'])->name('adminDashboard');
    // });
    Route::group(['prefix' => '/category', 'middleware' => 'admin'],function(){
        // Category Section
        Route::get('item',[CategoryController::class,'showCategory'])->name('adminCategory');
        Route::get('create',[CategoryController::class,'create'])->name('adminAddCategory');
        Route::post('create',[CategoryController::class,'createCategory'])->name('AddCategoryProcess');
        Route::get('delete/{id}',[CategoryController::class,'deleteCategory'])->name('deleteCategoryProcess');
        Route::get('update/{id}',[CategoryController::class,'UpdateCategory'])->name('UpdateCategoryProcess');
        Route::post('edit',[CategoryController::class,'editCategory'])->name('editCategoryProcess');
    });
    Route::group(['prefix' => '/product', 'middleware' => 'admin'],function () {
        // Product Section
        Route::get('details', [ProductController::class,"productDetail"])->name('ShowProductDetail');
        Route::get('item', [ProductController::class,"showPage"])->name('AddProductProcess');
        Route::post('create', [ProductController::class,"create"])->name('CreateProductProcess');
        Route::get('delete/{id}', [ProductController::class,"deleteProduct"])->name('DeleteProductProcess');
        Route::get('update/{id}', [ProductController::class,"updateProduct"])->name('UpdateProduct');
        Route::post('update/',[ProductController::class,'updateProductProcess'])->name('UpdateProductProcess');
        Route::get('detail/{id?}', [ProductController::class,"detailProduct"])->name('DetailProductProcess');
    });
    Route::group(['prefix' => '/payment', 'middleware' => 'admin'],function () {
        // Payment Section
        Route::get('show', [PaymentController::class,"showBlade"])->name('ShowPaymentBlade');
        Route::post('create', [PaymentController::class,"create"])->name('createPayment');
        Route::get('create', [PaymentController::class,"paymentList"])->name('paymentList');
        Route::get('delete/{id}', [PaymentController::class,"delete"])->name('deletePaymentList');
        Route::get('update/{id}', [PaymentController::class,"update"])->name('UpdatePaymentList');
        Route::post('update', [PaymentController::class,"updateProcess"])->name('UpdatePaymentProcess');

    });
    Route::group(['prefix' => '/changePassword', 'middleware' => 'admin'],function () {
        // Change Password Section
        Route::get('blade',[PasswordController::class,'showBlade'])->name('ShowPasswordBlade');
        Route::Post('change',[PasswordController::class,'PassChangeProcess'])->name('PassChangeProcess');
    });
    Route::group(['prefix' => '/profileDetail', 'middleware' => 'admin'],function () {
        // Profile Section
        Route::get('detail',[ProfileDetailController::class,'showBlade'])->name('ShowBlade');
        Route::post('detail',[ProfileDetailController::class,'UpdateProfileDetails'])->name('UpdateProfileDetails');
    });
    Route::group(['prefix' => '/UserList', 'middleware' => 'admin'],function () {
        // User and Admin List Section
        Route::get('user',[UserAndAdminListController::class,'showUserBlade'])->name('showUser');
        Route::get('admin',[UserAndAdminListController::class,'showAdminBlade'])->name('showAdmin');
        Route::get('delete/{id}',[UserAndAdminListController::class,'delete'])->name('delete');
        Route::get('UpgradeRole/{id}/{role}',[UserAndAdminListController::class,'UpgradeRole'])->name('UpgradeRole');
    });
    Route::group(['prefix' => '/NewAdmin', 'middleware' => 'admin'],function () {
        // Create New Admin Section
        Route::get('create',[CreateNewAdminController::class,'createAdmin'])->name('createAcc');
        Route::post('create',[CreateNewAdminController::class,'createProcess'])->name('CreateProcess');
    });
    Route::group(['prefix' => '/order', 'middleware' => 'admin'],function () {
        // Order Process Section
        Route::get('list',[OrderController::class,'orderBoard'])->name('orderBoard');
        Route::get('details/{ordercode}',[OrderController::class,'details'])->name('details');
        Route::get('status',[OrderController::class,'status'])->name('status');

    });
    Route::group(['prefix' => '/saleinfo', 'middleware' => 'admin'],function () {
        // Order Process Section
        Route::get('list',[SaleInfoController::class,'saleInfo'])->name('saleInfo');
    });

    Route::group(['prefix' => '/userinfo', 'middleware' => 'admin'],function () {
        // Order Process Section
        Route::get('info/{id}',[UserInfoController::class,'userinfo'])->name('userinfo');
    });

 });
