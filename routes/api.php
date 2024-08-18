<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('productandcategories/list',[ApiController::class,'ProductAndCategory']);
Route::get('orderandpayment/list',[ApiController::class,'OrderAndPayment']);
Route::get('cartandcomment/list',[ApiController::class,'CartAndComment']);
Route::get('payhistoryandrating/list',[ApiController::class,'PayHistoryAndRating']);
Route::get('reportanduser/list',[ApiController::class,'ReportAndUser']);


//Post
Route::post('category/add',[ApiController::class,'AddProduct']);

//get
// http://127.0.0.1:8000/api/productandcategories/list
// http://127.0.0.1:8000/api/orderandpayment/list
// http://127.0.0.1:8000/api/cartandcomment/list
// http://127.0.0.1:8000/api/payhistoryandrating/list
// http://127.0.0.1:8000/api/reportanduser/list

//Post
// http://127.0.0.1:8000/api/category/add
