@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <a href="{{route('orderBoard')}}" class="btn btn-outline-success mb-2"><i class="fa-solid fa-left-long"></i> back</a>
    <div class="row">
        <div class="card col-5 shadow-sm m-4">
            <div class="card-body">
                <div class="row my-4">
                    <div class="col-5">Customer Name : </div>
                    <div class="col-7">{{$orderDetails[0]['Username']}}</div>
                </div>
                <div class="row my-4">
                    <div class="col-5">Phone : </div>
                    <div class="col-7">{{$orderDetails[0]['userPhone']}}</div>
                </div>
                <div class="row my-4">
                    <div class="col-5">Order Date : </div>
                    <div class="col-7">{{$orderDetails[0]['order_code']}}</div>
                </div>
                <div class="row my-4">
                    <div class="col-5">Total Amount : </div>
                    <div class="col-7">{{$finalAmount + 500}} (Contain delivery Fees)</div>
                </div>
                <div class="row my-4">
                    <div class="col-5">Order Date : </div>
                    <div class="col-7">{{$orderDetails[0]['created_at']->format('j-F-Y')}}</div>
                </div>
            </div>
        </div>
        <div class="card col-5 shadow-sm m-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-5">Contact Phone : </div>
                    <div class="col-7">{{$payslipData['phone']}}</div>
                </div>
                <div class="row">
                    <div class="col-5">Payment Method : </div>
                    <div class="col-7">{{$payslipData['type']}}</div>
                </div>
                <div class="row">
                    <img src="{{asset('Payslip_image/'.$payslipData["payslip"])}}" class=" img-thumbnail" style="height: 250px;" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Count</th>
                            <th>Price</th>
                            <th>Each Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{$orderDetails}} --}}
                        @foreach($orderDetails as $item)
                            <tr >
                                <td class="col-1"><img class=" img-thumbnail " src="{{asset('product_image/'.$item->image)}}" alt=""></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->count}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->total_price}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
