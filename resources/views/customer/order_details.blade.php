@extends('customer.layouts.master')
@section('content')
<div class="container-fluid mt-5">
    <!-- DataTales Example -->
    <a href="{{route('orderBoard')}}" class="btn btn-outline-success mb-2"><i class="fa-solid fa-left-long"></i> back</a>

    <div class="card shadow mb-4" style="margin-top:60px;">
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
