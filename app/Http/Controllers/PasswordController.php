<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
class PasswordController extends Controller
{
    function showBlade() {
        return view('Admin_Dashboard.Change_Password');
    }
    function PassChangeProcess(Request $request) {
        $getReq = $this->RequestData($request);
        $this->ValidationProcess($request);
        if (Hash::check($getReq['current'], Auth::user()->password)) {
            $newPass = Hash::make($getReq['new']);
            User::select('password')
                ->where('id',Auth::user()->id)
                ->update(['password'=>$newPass]);
            Alert::success('Password Change Title', 'Password Change Successfully');
            return back();
        }
        Alert::error('Error Message', 'Current Password Not math');
        return back();
    }
    private function ValidationProcess($request){
        $rules =[
            "current" => "required",
            "new" => "required",
            "confirm" => "required|same:new"
        ];
        $message=[
            'confirm.same' => "The confirm field must match New Password",
            'current.same' => "The confirm field does not match Current Password"

        ];
        $validator = $request->validate($rules,$message);

    }
    private function RequestData($request){
        return[
            "current" => $request->current,
            "new" => $request->new,
            "confirm" => $request->confirm
        ];
    }
}
