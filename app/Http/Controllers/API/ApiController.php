<?php

namespace App\Http\Controllers\API;

use App\Models\cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Report;
use App\Models\Comment;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function ProductAndCategory() {
        $Product = Product::get();
        $category = Category::get();
        $data = [
            'Product' => $Product,
            'Category' => $category
        ];
        return response()->json($data, 200);
    }
    public function OrderAndPayment() {
        $Order = Order::get();
        $Payment = Payment::get();
        $data = [
            'Order' => $Order,
            'Payment' => $Payment
        ];
        return response()->json($data, 200);
    }
    public function CartAndComment() {
        $Cart = cart::get();
        $Comment = Comment::get();
        $data = [
            'Cart' => $Cart,
            'Comment' => $Comment
        ];
        return response()->json($data, 200);
    }
    public function PayHistoryAndRating() {
        $PaySlipHistory = PaySlipHistory::get();
        $Rating = Rating::get();
        $data = [
            'PaySlipHistory' => $PaySlipHistory,
            'Rating' => $Rating
        ];
        return response()->json($data, 200);
    }
    public function ReportAndUser() {
        $Report = Report::get();
        $User = User::get();
        $data = [
            'Report' => $Report,
            'User' => $User
        ];
        return response()->json($data, 200);
    }
    public function AddProduct(Request $request) {
        dd(header('Content-Type'));
        return $request->all();
    }
}
