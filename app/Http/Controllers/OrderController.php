<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;

class OrderController extends Controller
{
    function orderBoard() {
        $userOrder = Order::select('orders.*','users.name','users.id as userId')
                        ->leftJoin('users', 'users.id', 'orders.user_id')
                        ->groupBy('order_code')
                        ->paginate(5);
        // dd($userOrder->toArray());
        return view('Admin_Dashboard.orderBoard',compact('userOrder'));
    }

    public function details($orderCode){
        $orderDetails = Order::select('orders.*','products.name','products.image','products.price','users.name as Username','users.phone as userPhone')
                                ->where('order_code',$orderCode)
                                ->leftJoin('products','products.id','orders.product_id')
                                ->leftJoin('users', 'users.id', 'orders.user_id')
                                ->get();

        $payslipData = PaySlipHistory::select('pay_slip_histories.*','payments.type')
                                    ->where('order_code',$orderCode)
                                    ->leftJoin( 'payments','pay_slip_histories.payment_method','payments.id')
                                    ->first();
        $finalAmount = Order::where('order_code',$orderCode)->sum('total_price');
        return view('Admin_Dashboard.order_details',compact('orderDetails','finalAmount','payslipData'));
    }
    function status(Request $request) {

        $oldStatus = Order::select('status')->where('order_code',$request->order_code)->get();
        logger($oldStatus[0]['status']);
        $data = Order::select('orders.product_id','orders.count','products.count as product_count' )
                            ->where('order_code',$request->order_code)
                            ->leftJoin('products','products.id','orders.product_id')
                            ->get();
        if($request->status == 1){
            foreach($data as $item){
                $calculate_count = $item->product_count - $item->count;
                Product::where('id',$item->product_id)->update(['count'=> $calculate_count]);
            }
        }elseif($oldStatus[0]['status'] == 1){
            foreach($data as $item){
                $calculate_count = $item->product_count + $item->count;
                Product::where('id',$item->product_id)->update(['count'=> $calculate_count]);
            }
        }
        Order::where('order_code',$request->order_code)->update(['status' => $request->status]);

    }
}
