<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function userinfo($id) {
        $userInfo = User::where('id',$id)->first();
        // dd($userInfo->toArray());
        return view('Admin_Dashboard.user_info',compact('userInfo'));
    }
    
}
