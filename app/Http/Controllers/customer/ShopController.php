<?php

namespace App\Http\Controllers\customer;

use App\Models\cart;
use App\Models\Order;
use App\Models\Report;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PaySlipHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function shopDashboard($cate_id = null) {
        $categories = Category::select(['id','name'])->get();
        $products =  Product::when(request('searchKey'),function ($query) {
                        $query->where('products.name', 'like','%'.request('searchKey').'%');
                    });
        // if(request('minPrice') != null && request('maxPrice') != null){
        //     $products =$products->whereBetween('price',[request('minPrice'),request('maxPrice')]);
        // }
        $products = $products->when(request('minPrice'),function ($query) {
                        $query->where('products.price','>=',request('minPrice'));
                    });
        $products = $products->when(request('maxPrice'),function ($query) {
                        $query->where('products.price','<=',request('maxPrice'));
        });
        $products = $products->select(['products.id','products.name','products.price','products.description','products.count','products.image','products.category_id','categories.id as caregoryID','categories.name as categoryName' ])
                             ->leftJoin('categories','products.category_id','categories.id');
        if($cate_id == null){
            $products = $products->paginate(9);
        }else{
            $products = $products->where('products.category_id',$cate_id)->paginate(9);
        }
        return view('customer.shop',compact('products','categories'));
    }

    // Cart Controller
    public function CartDashboard() {
        $data = cart::select('products.image','products.name','products.price','carts.qty','carts.id','products.id as productId')
                    ->where('user_id',Auth::user()->id)
                    ->leftJoin('products','carts.product_id','products.id')
                    ->selectRaw('SUM(qty) as totalCount')
                    ->groupBy('product_id')
                    ->get();
                    // dd($data->toArray());
        $totalPrice = 0;
        foreach($data as $item){
            $totalPrice += $item->price * $item->totalCount;
        }
        // dd($data->toArray() ,$totalPrice );
        $payment = Payment::select('id','type')->get();
        return view('customer.cart',compact('data','totalPrice','payment'));
    }
     function addQty(Request $request) {
        logger($request->all());
        cart::where('id',$request->card_id)->update(['qty' => $request->qty]);
    }
    public function addItem(Request $req) {
        // logger($request->all());
        $data = [
            'product_id' => $req->product_id,
            'user_id' => Auth::user()->id,
            'qty' => $req->qty

        ];
        cart::create($data);
        return to_route('shopDashboard');
    }

    //remove Cart
    public function removeCart(Request $request) {
        // logger($request->all());
        cart::where('id',$request->cardId)->delete();
        $data = cart::get();
        $serverResponce = [
            'data' => $data,
            'message' => 'success'
        ];
        return response()->json($serverResponce,200);
    }
    //orderProcess
    public function orderProcess(Request $request) {
        $orderList = [];
        foreach($request->all() as $item){
            array_push($orderList,[
                'user_id' => $item['user_id'],
                'count' => $item['count'],
                'status' => 0,
                'order_code'=> $item['order_code'],
                'product_id' => $item['product_id'],
                'total_price'=> $item['total_price']
            ]);

        }
        Session::put('orderList', $orderList);
        return response()->json([
            'message' => 'success',
            'status' => 200
        ],200);
    }
    public function orderList() {
        $orderList = Order::where('user_id',Auth::user()->id)
                            // ->selectRaw('SUM(total_price) as total')
                            ->orderBy('created_at','desc')
                            ->groupBy('order_code')
                            ->get();
                            // dd($orderList->toArray());
        return view('customer.shopList',compact('orderList'));
    }
    public function orderdetails($orderCode) {

        $orderDetails = Order::select('orders.*','products.name','products.image','products.price','users.name as Username')
                                ->where('order_code',$orderCode)
                                ->leftJoin('products','products.id','orders.product_id')
                                ->leftJoin('users', 'users.id', 'orders.user_id')
                                ->get();
        $finalAmount = Order::where('order_code',$orderCode)->sum('total_price');
        // dd($orderDetails->toArray());
        return view('customer.order_details',compact('orderDetails'));
    }
    // Direct Payment Page
    public function payment() {
        $payment = Payment::orderBy('type')->get();
        $orderList = Session::get('orderList');
        $finalAmount = 500;
        foreach ($orderList as $item) {
            $finalAmount += $item['total_price'];
        }
        return view('customer.Payment',compact('payment','orderList','finalAmount'));
    }
    public function payslipData(Request $req) {
        $orderList = Session::get('orderList');
        $this->ValidationProcess($req);
        $PaySlipData = [
            'phone' => $req->phone ,
            'customer_name' =>$req->customer_name,
            'payment_method' => $req->payment_method ,
            'order_code' => $req->order_code ,
            'order_amount' => $req->final_amount
        ];
        // dd($PaySlipData);
        if($req->hasFile('payslip')){
            // add new photo
            $newImageName = uniqid().$req->payslip->getClientOriginalName();
            $req->file('payslip')->move(public_path().'/Payslip_image/',$newImageName);
            $PaySlipData['payslip'] = $newImageName;
        }
        foreach($orderList as $item){
            Order::create([
                'user_id' => $item['user_id'],
                'count' => $item['count'],
                'status' => 0,
                'order_code'=> $item['order_code'],
                'product_id' => $item['product_id'],
                'total_price'=> $item['total_price']
            ]);
            cart::where('user_id',$item['user_id'])->delete();
        }
        PaySlipHistory::create($PaySlipData);
        return to_route('orderList');

    }
    private function ValidationProcess($request){
        $rules =[
            "customer_name" => "required",
            "phone" => "required",
            "payment_method" => "required",
            "payslip" => "required|mimetypes:image/jpeg,image/png,image/jpg"
        ];
        $message=[];
        $validator = $request->validate($rules,$message);

    }
    // Direct Contact Page
    public function contact() {
        return view('customer.contact');
    }
    public function userdata(Request $request) {
        $this->validate($request);
        Report::create([
            'user_id' => Auth::user()->id,
            'username' => $request->username,
            'email' => $request->email,
            'message' => $request->message
        ]);
        return back();
    }
    private function validate($request){
        $rules =[
            'username' => 'required',
            'email' => 'required',
            'message' => 'required'
        ];
        $message=[];
        $validator = $request->validate($rules,$message);

    }
}
