<?php

namespace App\Http\Controllers\customer;

use App\Models\User;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function userDashboard(){
        $categories = Category::select(['id','name'])->get();
        $products =  Product::select(['products.id','products.name','products.price','products.description','products.count','products.image','products.category_id','categories.id as caregoryID','categories.name as categoryName' ])
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->get();
        $clientfeedback = Rating::select(['users.id','users.name','users.nickname','users.image','ratings.id as ratingId','ratings.count'])
                                ->leftJoin('users','ratings.user_id','users.id')
                                ->orderBy('ratings.created_at','asc')
                                ->get();
        $cateAndProductImg = Product::select('products.image','categories.name')->leftJoin('categories','products.category_id','categories.id')->get();
        // dd($cateAndProductImg->toArray());
        return view('customer.index',compact('categories','products','clientfeedback','cateAndProductImg'));
    }
    public function cateItem($id){
        $cateItem =  Product::select(['products.id','products.name','products.price','products.description','products.count','products.image','products.category_id','categories.id as caregoryID','categories.name as categoryName' ])
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('categories.id', $id)
                    ->get();
        return view('customer.index',compact('cateItem'));
    }
}
