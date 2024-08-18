<?php

namespace App\Http\Controllers\customer;

use Closure;
use App\Models\User;
use App\Rules\CustomRule;
use App\Rules\CheckPassword;
use App\Rules\CustomizeRule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function userProfile() {
        $data = User::select(["id",'name','nickname',"email",'role','phone','address','image','password'])
                    ->where('id',Auth::user()->id)
                    ->first();
        return view('customer.Customer_profile',compact('data'));
    }
    public function UpdateProfileDetails(Request $request) {
        $data = $this->RequestData($request);
        $this->ValidationProcess($request);
        if($request->hasFile('image')){
            //delete old photo
            if(Auth::user()->image != null){
                $oldImageName = User::select('image')->where('image',Auth::user()->image)->first();
                unlink(public_path().'/User_image/'.$oldImageName['image']);
            }
            // add new photo
            $newImageName = uniqid().$request->image->getClientOriginalName();
            $request->file('image')->move(public_path().'/User_image/',$newImageName);
            $data['image'] = $newImageName;
        }
        $data['password'] = Hash::make($request->new);
        // dd($data['password']);
        $data['email'] = Auth::user()->provider =='simple'? $request->email : Auth::user()->email;
        $data['name'] = Auth::user()->provider =='simple'? $request->name : Auth::user()->name;
        // dd($data);
        User::where('id',$request->userId)->update($data);
        Alert::success('Update Title', 'Update Successfully');
        return to_route('UserProfile');
    }
    private function RequestData($req) {
        return[
            "phone" => $req->phone,
            "address" => $req->Address,
            // "current" => $req->current,
            // "new" => $req->new,
            // "confirm" => $req->confirm

        ];
    }
    private function ValidationProcess($request){
        if($request->new != null && $request->current != null && $request->confirm != null ){
            $rules =[
                "name" => "required|unique:products,name,".$request->userId,
                'image' => "mimetypes:image/jpeg,image/png,image/jpg",
                "current" => ["required",new CustomizeRule],
                "new" => "required",
                "confirm" => "required|same:new"

            ];
            // dd('yes');
        }else{
            $rules =[
                "name" => "required|unique:products,name,".$request->userId,
                'image' => "mimetypes:image/jpeg,image/png,image/jpg",

            ];
            // dd('no');
        }

        // $rules =[
        //     "name" => "required|unique:products,name,".$request->userId,
        //     'image' => "mimetypes:image/jpeg,image/png,image/jpg",
        //     "current" => ["required",new CustomizeRule],
        //     "new" => "required",
        //     "confirm" => "required|same:new"

        // ];
        $message=[
            'confirm.same' => "The confirm field must match New Password",
        ];

        $validator = $request->validate($rules,$message);

    }

}
