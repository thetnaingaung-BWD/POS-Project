<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function create(){
        return view('Admin_Dashboard.add-category');
    }
    public function createCategory(Request $request){
        $validator = $request->validate([
            'categoryName' => 'required'
        ]);
        // dd($request->categoryName);
        Category::create([
            'name' => $request->categoryName
        ]);
        Alert::success('Success Title', 'Success Message');
        return back();
    }
    public function showCategory(){
        $data = Category::orderBy('created_at','asc')->paginate(5);
        return view('Admin_Dashboard.category',compact('data'));
        // dd($data->toArray());
    }
    public function deleteCategory($id){
        $data = Category::where('id', $id)->delete();
        Alert::success('Success Delete', 'Delete Successfully');
        return back();
    }
    public function UpdateCategory($id) {
        $data = Category::where('id',$id)->first();
        return view('Admin_Dashboard.edit-category',compact('data'));
    }
    public function editCategory(Request $request){
        // dd($request->categoryId);
        $validator = $request->validate([
            'categoryName' => 'required|unique:categories,name,'.$request->categoryId
        ]);
        // dd($request->categoryName);
        Category::where('id',$request->categoryId)->Update([
            'name' => $request->categoryName
        ]);
        Alert::success('Success update', 'update Successfully');
        return to_route('adminCategory');
    }
}
