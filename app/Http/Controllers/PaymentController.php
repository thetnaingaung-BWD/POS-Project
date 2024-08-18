<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function showBlade() {
        $paymentList = Payment::select(['id','account_name','account_number','type'])->paginate(5);
        return view('Admin_Dashboard.payment',compact('paymentList'));
    }
    public function create(Request $request) {
        $this->ValidationProcess($request);
        Payment::create([
            'account_name' => $request->AcName,
            'account_number'=> $request->AcNumber,
            'type' => $request->banking
        ]);
        Alert::success('Create Payment', 'Payment Create Successfully');
        return to_route('ShowPaymentBlade');
    }
    public function delete($id) {
        Payment::where('id',$id)->delete();
        Alert::success('Success Delete', 'Delete Successfully');
        return back();
    }
    public function update($id) {
        $UpdatepaymentList = Payment::where('id',$id)
                            ->select(['id','account_name','account_number','type'])
                            ->first();
        return view('Admin_Dashboard.PaymentUpdate',compact('UpdatepaymentList'));
    }
    public function updateProcess(Request $request) {
        $data=[
            'account_name' => $request->AcName,
            'account_number'=> $request->AcNumber,
            'type' => $request->banking
        ];
        Payment::where('id',$request->PaymentId)->update($data);
        Alert::success('Update Title', 'Update Successfully');
        return to_route('ShowPaymentBlade');
    }
    private function ValidationProcess($request){
        $rules =[
            "AcName" => "required",
            "AcNumber" => "required",
            "banking" => "required"
        ];
        $message=[];
        $validator = $request->validate($rules,$message);

    }
}
