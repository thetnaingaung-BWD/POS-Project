<?php

namespace App\Http\Controllers\customer;

use App\Models\Rating;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ShopDetailController extends Controller
{
    public function shopDetail($product_id) {
        $products =  Product::select(['products.id','products.name','products.price','products.description','products.count','products.image','products.category_id','categories.id as caregoryID','categories.name as categoryName' ])
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->where('products.id',$product_id)
                    ->first();
        $commentData = Comment::select(['comments.id','comments.product_id','comments.user_id','comments.comment','users.name','users.nickname','comments.created_at','users.image'])
                    ->leftJoin('users','comments.user_id','users.id')
                    ->where('comments.product_id',$product_id)
                    ->orderBy('created_at','desc')
                    ->get();
        $relateProduct = Product::select(['products.id','products.name','products.price','products.description','products.count','products.image','products.category_id','categories.id as caregoryID','categories.name as categoryName' ])
                                ->leftJoin('categories','products.category_id','categories.id')
                                ->where('products.id','!=',$product_id)
                                ->get();
        $sumRating =  Rating::where('product_id',$product_id)->avg('count');
        $ratingCount = Rating::where('product_id', $product_id);
        $oldRating = Rating::select('count')->where('product_id',$product_id)->where('user_id',Auth::user()->id)->first();
        return view('customer.shop-detail',compact('products','commentData','sumRating','ratingCount','oldRating','relateProduct'));
    }
    public function rating(Request $request) {
        $data = [
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'count' => $request->course_rating
        ];
        $RatingCheck = Rating::where('product_id',$data['product_id'])->where('user_id',$data['user_id'])->first();
        if($RatingCheck == null){
            Rating::create($data);
        }else{
            Rating::where('product_id',$data['product_id'])->where('user_id',$data['user_id'])->update([
                'count' => $data['count']
            ]);
        }

        Alert::success('Rating Success', 'Rating Successfully');
        return back();
    }
}



