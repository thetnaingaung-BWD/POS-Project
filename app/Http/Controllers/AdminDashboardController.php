<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function home() {
        $totalIncome = Order::where('status', 1)->selectRaw('SUM(total_price) as total')->first();
        $totalLoss = Order::where('status', 2)->selectRaw('SUM(total_price) as total')->first();
        // dd($totalLoss);
        $totalPendingRequest = Order::where('status', 0)->groupBy('order_code')->get();
        $PendingRequestCount = count($totalPendingRequest);
        $totalSuccessRequest = Order::where('status', 1)->groupBy('order_code')->get();
        $SuccessRequestCount = count($totalPendingRequest);
        $totalRejectRequest = Order::where('status', 2)->groupBy('order_code')->get();
        $RejectRequestCount = count($totalPendingRequest);
        $adminCount = User::where('role','admin')->count();
        $userCount = User::where('role','user')->count();
        $soldoutStock = Product::select('count')->where('count', '<', 10)->count();
        return view('Admin_Dashboard.home',compact('totalIncome','PendingRequestCount','userCount','SuccessRequestCount','RejectRequestCount','soldoutStock','adminCount','totalLoss'));
    }
}
