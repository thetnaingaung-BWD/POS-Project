<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SaleInfoController extends Controller
{
    public function saleInfo() {
        $orders = Order::select('orders.*','users.name as UserName','users.id as userId')
                        ->selectRaw('SUM(total_price) as final_amount')
                        ->selectRaw('COUNT(order_code) as item_count')
                        ->where('status',1)
                        ->groupBy('order_code')
                        ->leftJoin('products','products.id','orders.product_id')
                        ->leftJoin('users', 'users.id', 'orders.user_id')
                        ->get();
        // dd($orders->toArray());
        return view('Admin_Dashboard.saleInfo',compact('orders'));
    }
}
