@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Sale Information</h6>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Date</th>
                            <th>Count</th>
                            <th>Total Amount</th>
                            <th>Order Code</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{$orders}} --}}
                       @foreach($orders as $item)
                            <tr>
                                <td><a href="{{route('userinfo',$item->userId)}}">{{$item->UserName}}</a></td>
                                <td>{{$item->created_at->format('j-F-Y')}}</td>
                                <td>{{$item->item_count}}</td>
                                <td>{{$item->final_amount + 500}}</td>
                                <td><a href="{{route('details',$item->order_code)}}">{{$item->order_code}}</a></td>
                            </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
