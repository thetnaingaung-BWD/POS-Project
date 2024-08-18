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
                <table class="table" id="DataTable" >
                    <thead>
                      <tr>
                        <th scope="col">Products</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach($data as $item)
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center">
                                    <img src="{{asset('/product_image/'.$item->image)}}" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                </div>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">{{$item->name}}</p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4" id="price" >{{$item->price}} MMK</p>
                            </td>
                            <td>
                                <div class="input-group quantity mt-4" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm text-center border-0"  id='qty' value="{{$item->totalCount}}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="mb-0 mt-4" id="totalPrice" >{{$item->price * $item->totalCount}} MMK</p>
                            </td>
                            <td>
                                <input type="hidden" class="card_id" value="{{$item->id}}">
                                <input type="hidden" id ="productId" value="{{$item->productId}}" >
                                <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove" >
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </td>

                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id='receiptPrice'>{{$totalPrice}} MMK</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Service Fees</h5>
                                <div class="">
                                    <p class="mb-0">500 MMK</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4" id="finalPrice" >{{$totalPrice + 500 }} MMK</p>
                        </div>
                        <div class="row align-items-center mx-3 mb-3 ">
                            <div class="col">Payment type : </div>
                            <div class="col">
                                <select id="payment" name="payment" class="form-control" form="paymentform">
                                    @foreach($payment as $item)
                                    <option value="{{$item->id}}">{{$item->type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" value="{{auth()->user()->id}}" id="userId">

                        <button id = 'processCheckout' @if(count($data) == 0) disabled @endif class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->


    <!-- Footer Start -->
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
    <!-- Footer End -->

@endsection

@section('js-code')
    <script>
        $(document).ready(function(){
            // When Btn Plus Click
            $('.btn-plus').click(function(){
                $parentNode = $(this).parents('tr');
                $cartId = $parentNode.find('.card_id').val()
                $price = Number($parentNode.find('#price').text().replace('MMK',''))
                $qty = $parentNode.find('#qty').val()
                $totalprice = $qty * $price
                $parentNode.find('#totalPrice').html($totalprice + 'MMK')
                finalCalculation();
                // $data = {
                //     'card_id' : $cartId,
                //     'qty' : $qty
                // }
                // $.ajax({
                //     type : 'get',
                //     url : 'qty/add',
                //     data : $data ,
                //     dataType : 'json'
                // })

            })
            // When Btn Minus Click
            $('.btn-minus').click(function(){
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace('MMK',''))
                $qty = $parentNode.find('#qty').val()
                $totalprice = $qty * $price
                $parentNode.find('#totalPrice').html($totalprice + 'MMK')
                finalCalculation();


            })
            // When Btn Remove Click Using Ajax Call
            $('.btn-remove').click(function () {
                $parentNode = $(this).parents('tr');
                $cartId = $parentNode.find('.card_id').val()
                  $deleteData = {
                    'cardId' : $cartId
                };
                $.ajax({
                    type : 'get',
                    url : 'remove/cart',
                    data : $deleteData ,
                    dataType : 'json',
                    success : function(response){
                        if(response.message == 'success'){
                            location.reload()
                        }
                    }
                });
            })
            $('#processCheckout').click(function (){
                $orderlist = []
                $orderCode = 'POS'+ Math.floor(Math.random() * 1000000) //random value
                $userId = $('#userId').val()
                $("#DataTable tbody tr").each(function(item,row){
                    $productId = Number($(row).find("#productId").val())
                    $qty = Number($(row).find("#qty").val())
                    $totalprice = Number($(row).find("#totalPrice").text().replace('MMK',''))
                    $orderlist.push({
                        'user_id' : $userId*1,
                        'product_id' : $productId,
                        'order_code' : $orderCode,
                        'count' : $qty,
                        'total_price' : $totalprice
                    })
                  })
                  $.ajax({
                    type : 'get',
                    url : 'order',
                    data : Object.assign({},$orderlist) ,
                    dataType : 'json',
                    success : function(response){
                        if(response.message == 'success'){
                            location.href = 'payment'
                        }
                    }
                  })

            })
            function finalCalculation (){
                $receiptPrice = 0;
                $("#DataTable tbody tr").each(function(item,row){
                    $receiptPrice += Number($(row).find("#totalPrice").text().replace('MMK',''))
                  })
                $("#receiptPrice").html(`${($receiptPrice)}  MMK`)
                $('#finalPrice').html(`${($receiptPrice + 500)} MMK`)
                $data = {
                    'card_id' : $cartId,
                    'qty' : $qty
                }
                $.ajax({
                    type : 'get',
                    url : 'qty/add',
                    data : $data ,
                    dataType : 'json'
                })
            }
        })
    </script>
@endsection

