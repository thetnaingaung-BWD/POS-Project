<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileDetailController extends Controller
{
    public function showBlade() {
        $data = User::select(["id",'name','nickname',"email",'role','phone','address','image','password'])
                    ->where('id',Auth::user()->id)
                    ->first();
        return view('Admin_Dashboard.profile-detail',compact('data'));
    }
    public function UpdateProfileDetails(Request $request) {
        $this->ValidationProcess($request);
        $data = $this->RequestData($request);
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
        $data['email'] = Auth::user()->provider =='simple'? $request->email : Auth::user()->email;
        $data['name'] = Auth::user()->provider =='simple'? $request->name : Auth::user()->name;
        User::where('id',$request->userId)->update($data);
        Alert::success('Update Title', 'Update Successfully');
        return to_route('ShowBlade');
    }
    private function RequestData($req) {
        return[
            "phone" => $req->phone,
            "address" => $req->Address

        ];
    }
    private function ValidationProcess($request){
        $rules =[
            "name" => "required|unique:products,name,".$request->userId,
            "phone" => "required",
            "Address" => "required",
            'image' => "mimetypes:image/jpeg,image/png,image/jpg"
        ];
        $message=[];
        // $rules["image"] = $action == 'create' ?   "required|mimetypes:image/jpeg,image/png,image/jpg" :   "mimetypes:image/jpeg,image/png,image/jpg";
        $validator = $request->validate($rules,$message);

    }
}
