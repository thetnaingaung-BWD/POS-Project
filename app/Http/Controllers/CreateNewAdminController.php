<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class CreateNewAdminController extends Controller
{
    function createAdmin(){
        $data = User::where('id',Auth::user()->id)->first();
        return view('Admin_Dashboard.Add_new_acc',compact('data'));
    }
    function createProcess(Request $request){
        $this->ValidationProcess($request);
        $newUser = $this->RequestData($request);

        if($request->hasFile('image')){
            // add new photo
            $newImageName = uniqid().$request->image->getClientOriginalName();
            $request->file('image')->move(public_path().'/User_image/',$newImageName);
            $newUser['image'] = $newImageName;
        }
        $newUserPass = Hash::make($newUser['password']);
        $newUser['password'] = $newUserPass;
        User::create($newUser);
        Alert::success('Create Title', 'Create Successfully');
        return to_route('createAcc');
    }
    private function RequestData($req) {
        return[
            "name" => $req->name,
            "email" => $req->email,
            "phone" => $req->phone,
            "address" => $req->Address,
            'password' => $req->password,
            'provider' => 'simple'
        ];
    }
    private function ValidationProcess($request){
        $rules =[
            "name" => "required|unique:users,name",
            "email" => "required|unique:users,email",
            "password" => "required|min:8",
            'image' => "mimetypes:image/jpeg,image/png,image/jpg"
        ];
        $message=[];
        $validator = $request->validate($rules,$message);

    }
}

