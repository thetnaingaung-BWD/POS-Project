<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserAndAdminListController extends Controller
{
    public function showUserBlade() {
        $data = User::when(request('searchKey'),function ($query) {
                        $query->whereAny(['role','name','email','phone','address'],'like','%'.request('searchKey').'%');
                        })
                    ->select(['id','name','nickname','email','role','phone','address','image'])
                    ->where('role','user')
                    ->orderBy('id', 'desc')
                    ->paginate(5);
        $userCount = User::where('role','user')->count();
        $adminCount = User::where('role','admin')->count();
        return view('Admin_Dashboard.userList',compact('data',"userCount","adminCount"));
    }
    public function showAdminBlade() {
        $data = User::when(request('searchKey'),function ($query) {
                    $query->whereAny(['role','name','email','phone','address'],'like','%'.request('searchKey').'%');
                    })
                    ->select(['id','name','nickname','email','role','phone','address','image'])
                    ->where('role','admin')
                    ->orderBy('id', 'desc')
                    ->paginate(5);
        $superadmin = User::select(['id','name','nickname','email','role','phone','address','image'])->where('role','superadmin')->first();

        $userCount = User::where('role','user')->count();
        $adminCount = User::where('role','admin')->count();
        return view('Admin_Dashboard.adminList',compact('data',"adminCount","userCount",'superadmin'));
    }
    public function delete($id){
        User::where('id', $id )->delete();
        Alert::success('Delete Title', 'Deleted Successfully');
        return to_route('showUser');
    }
    public function UpgradeRole($id,$role){
        if($role == "admin"){
            User::select('role')
                ->where('id',$id)
                ->update(['role' => 'user']);
            Alert::success('Change Role Title', 'Change to user Successfully');
        }else{
            User::select('role')
            ->where('id',$id)
            ->update(['role' => 'admin']);
            Alert::success('Change Role Title', 'Change to admin Successfully');
        }
        return to_route('showUser');
    }
    public function search(){

    }
}
