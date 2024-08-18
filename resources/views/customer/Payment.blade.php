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
        <h1 class="text-center text-white display-6">Payment</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Payment</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 offset-1 ">
                            <h5>Payment Account Info</h5>
                            @foreach($payment as $item)
                                <p>{{$item->type}} (name - {{$item->account_name}})</p>
                                <p>Account - {{$item->account_number}}</p>
                                <hr>
                            @endforeach
                        </div>
                        <div class="col-5">
                            <form action="{{route('payslipData')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row my-3">
                                    <h5>User Payment Info</h5>
                                    <div class="">
                                        <img src="{{asset('Default_Image/istockphoto-1354776457-612x612.jpg')}}" class=" img-thumbnail" alt="" id="image" >
                                    </div>
                                    <div class="col-6 ">
                                        <input type="text @error('customer_name') is-invalid @enderror" value="{{old('customer_name')}}"  class="form-control" name="customer_name"  placeholder="Account Name">
                                        @error('customer_name')
                                            <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-6">
                                        <input type="text @error('phone') is-invalid @enderror" value="{{old('phone')}}"  class="form-control" name="phone"  placeholder="Account Number">
                                        @error('phone')
                                            <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div>
                                        <select name="payment_method"  value=""  class="form-control @error('payment_method') is-invalid @enderror">
                                            <option value="">Choose Payment Method</option>
                                            @foreach($payment as $item)
                                                <option value="{{$item->id}}" @if(old('payment_method') == $item->id) selected @endif >{{$item->type}}</option>
                                            @endforeach
                                        </select>
                                        @error('payment_method')
                                            <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <input type="file" value="{{old('payslip')}}" class="form-control @error('payslip') is-invalid @enderror"  name="payslip"  onchange="loadFile(event)">
                                        @error('payslip')
                                            <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col-6 ">
                                        <label class="form-control">{{$orderList[0]['order_code']}}</label>
                                        <input type="hidden" class="form-control"  name="order_code"  value="{{$orderList[0]['order_code']}}" >
                                    </div>
                                    <div class="col-6">
                                        <label class="form-control">{{$finalAmount}}</label>
                                        <input type="hidden" class="form-control"  name="final_amount"  value="{{$finalAmount}}" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="">
                                        <input type="submit" class="btn btn-success "  value="Paid" >
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->


    {{-- <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Fruitables</h1>
                            <p class="text-secondary mb-0">Fresh products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number" placeholder="Your Email">
                            <button type="submit" class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white" style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn  btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary me-2 btn-md-square rounded-circle" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="btn border-secondary py-2 px-4 rounded-pill text-primary">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End --> --}}

@endsection



