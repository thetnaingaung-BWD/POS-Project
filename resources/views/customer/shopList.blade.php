@extends('customer.layouts.master')
@section('content')
       <!-- Modal Search Start -->
       <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->


    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Product Code</th>
                        <th scope="col">Date</th>
                        <th scope="col">Price</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                        {{-- {{$orderList}} --}}
                        @foreach($orderList as $item)
                        <tr>
                            <td>
                                <a href="{{route('orderdetails',$item->order_code)}}"><p class="mb-0 mt-4"  >{{$item->order_code}}</p></a>
                            </td>
                            <td>
                                <p class="mb-0 mt-4"  >{{$item->created_at->format('j - F - Y ')}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4"  >{{$item->total_price}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4"  >
                                    @if($item->status == '0')
                                        <button class="btn btn-sm btn-warning">Pending</button>
                                    @elseif($item->status == 1)
                                        <button class="btn btn-sm btn-success">Success</button>
                                    @else
                                        <button class="btn btn-sm btn-danger">Reject</button>
                                    @endif
                                </p>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Cart Page End -->




@endsection



