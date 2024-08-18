@extends('customer.layouts.master')
@section('content')
        <!-- Modal Search End -->


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Shop</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Fruits Shop Start-->
        <div class="container-fluid fruite py-5">
            <div class="container py-5">
                <h1 class="mb-4">Fresh fruits shop</h1>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="row g-4">
                            <div class="col-xl-3">
                                <form action="{{route('shopDashboard')}}" method="get">
                                    @csrf
                                    <div class="input-group w-100 mx-auto d-flex">
                                        <input type="search" name="searchKey" class="form-control p-3" value="{{request('searchKey')}}" placeholder="keywords" >
                                        <button type="submit" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-xl-3">
                                <div class="bg-light ps-3 py-3 rounded d-flex justify-content-between mb-4">
                                    <label for="fruits">Default Sorting:</label>
                                    <select id="fruits" name="fruitlist" class="border-0 form-select-sm bg-light me-3" form="fruitform">
                                        <option value="volvo">Nothing</option>
                                        <option value="saab">Popularity</option>
                                        <option value="opel">Organic</option>
                                        <option value="audi">Fantastic</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4>Category</h4>
                                            <ul class="list-unstyled fruite-categorie">
                                                <div class="d-flex justify-content-between fruite-name">
                                                    <a href="{{route('shopDashboard')}}"><i class="fas fa-apple-alt me-2"></i>All Categories</a>

                                                </div>
                                                @foreach($categories as $item)
                                                    <li>
                                                        <div class="d-flex justify-content-between fruite-name">
                                                            <a href="{{route('shopDashboard',$item->id)}}"><i class="fas fa-apple-alt me-2"></i>{{$item->name}}</a>
                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <form action="{{route('shopDashboard')}}" method="get">
                                            <input type="text" name="minPrice" value="{{request('minPrice')}}" class="form-control my-2 " placeholder="Minimum Price">
                                            <input type="text" name="maxPrice" value="{{request('maxPrice')}}" class="form-control my-2 " placeholder="Maximinum Price">
                                            <input type="submit" class="btn btn-dark" value="search" >
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">
                                    @foreach($products as $item)
                                        <div class="col-md-6 col-lg-6 col-xl-4">
                                            <a href="{{route('shopDetail',$item->id)}}">
                                                <div class="rounded position-relative fruite-item">
                                                    <div class="fruite-img">
                                                        <img src="{{asset('/product_image/'.$item->image)}}"style=" height:250px" class="img-fluid w-100 rounded-top" alt="">
                                                    </div>
                                                    <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">{{$item->categoryName}}</div>
                                                    <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                        <h4>{{$item->name}}</h4>
                                                        <p>{{\Illuminate\Support\Str::words($item->description, 7, '...')}}</p>
                                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                                            <p class="text-dark fs-5 fw-bold mb-0">{{$item->price}} MMK</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                    <div class="col-12">
                                        <div class="pagination d-flex justify-content-center mt-5">
                                            {{$products->links()}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fruits Shop End-->


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
