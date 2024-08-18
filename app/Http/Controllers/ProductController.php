<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function showPage(){
        $data = Category::get(['id','name']);
        return view('Admin_Dashboard.add-product',compact('data'));
    }
    public function productDetail() {
        $data = Product::when(request('searchData'),function ($qry) {
                            $qry->whereAny(['name','count','price'],'like','%'.request('searchData').'%');
                        })
                        ->paginate(3);

        return view('Admin_Dashboard.product',compact('data'));
    }
    public function deleteProduct($id){
        Product::where('id', $id)->delete();
        Alert::success('Success Delete', 'Delete Successfully');
        return back();
    }
    public function create(Request $request){
        $this->ValidationProcess($request,'create');
        $data = $this -> RequestData($request);
        if($request->hasFile('image')){
            $imageName = uniqid().$request->image->getClientOriginalName();
            $request->image->move(public_path().'/product_image/',$imageName);
            $data['image'] = $imageName;
        }
        Product::create($data);
        Alert::success('Success Title', 'Success Message');
        return to_route('ShowProductDetail');

    }
    public function detailProduct($id=null) {
        $product = Product::select('products.id','products.name','products.description','products.category_id','products.count','products.image','categories.name as category_name','categories.id as categoryID')
                            ->leftJoin('categories','products.category_id','categories.id')
                            ->where('products.id',$id)
                            ->first();
        return view('Admin_Dashboard.Product-Detail',compact('product'));

    }
    public function updateProduct($id) {
        $editData = product::select('id','price','name','description','category_id','count','image')
                            ->where("id",$id)
                            ->first();
        $category = Category::select('id','name')
                            ->get();
        return view('Admin_Dashboard.update-Product',compact('editData','category'));

    }
    public function updateProductProcess(Request $request){
        $data = $this -> RequestData($request);
        $this->ValidationProcess($request,'update');
        if($request->hasFile('image')){
            //delete old photo
            $oldImageName = Product::select('image')->first();
            unlink(public_path().'/product_image/'.$oldImageName['image']);
            // add new photo
            $newImageName = uniqid().$request->image->getClientOriginalName();
            $request->file('image')->move(public_path().'/product_image/',$newImageName);
            $data['image'] = $newImageName;

        }
        Product::where('id',$request->productId)->update($data);
        Alert::success('Update Title', 'Update Successfully');
        return to_route('ShowProductDetail');
    }

    private function ValidationProcess($request,$action){
        $rules =[
            "name" => "required|unique:products,name,".$request->productId,
            "price" => "required",
            "description" => "required",
            "count" => "required",
            "category" => "required"
        ];
        $message=[];
        $rules["image"] = $action == 'create' ?   "required|mimetypes:image/jpeg,image/png,image/jpg" :   "mimetypes:image/jpeg,image/png,image/jpg";
        $validator = $request->validate($rules,$message);

    }

    private function RequestData($request){
        return[
            "name" => $request->name,
            "price" => $request->price,
            "description" => $request->description,
            "count" => $request->count,
            "category_id"=> $request->category
        ];
    }
}

