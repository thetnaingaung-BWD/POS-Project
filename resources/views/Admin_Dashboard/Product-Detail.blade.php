@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="row">
    <div class="col-8 offset-2">
        <div class="card p-5">
                <div class="row">
                    <div class="col-4">
                        <img class="img-fluid" src="{{asset('product_image/'.$product->image)}}" alt="">
                    </div>
                    <div class="col-8">

                        <h1>{{$product->name}}</h1>
                        <p>{{$product->description}}</p>
                        <span >Price : {{$product->price}} MMK </span>  |
                        <span> Stock : {{$product->count}}</span>       |
                        <span> Category : {{$product->category_name}}</span>
                        <div class="d-flex">
                            <a href="{{route('ShowProductDetail')}}" class="btn btn-dark m-3"><i class="fa-solid fa-left-long"></i> back</a>
                            <a href="{{route('UpdateProduct',$product->id)}}" class="btn btn-success m-3"><i class="fa-solid fa-pen-to-square"></i> Update</a>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection
