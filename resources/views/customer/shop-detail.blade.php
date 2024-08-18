@extends('customer.layouts.master')
@section('content')
        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Shop Detail</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active text-white">Shop Detail</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Single Product Start -->
        <div class="container-fluid py-5 mt-5">
            <div class="container py-5">
                <div class="row g-4 mb-5">

                    <div class="col-lg-8 col-xl-9 offset-1">
                            <div class="row g-4">
                                <div class="col-lg-6 ">
                                    <a href="{{route('shopDashboard')}}" ><i class=" fas fa-solid fa-arrow-left me-2"></i>back</a>
                                    <div class="border rounded">
                                        <a href="#">
                                            <img src="{{asset('/product_image/'.$products->image)}}" class="img-fluid w-100 rounded" alt="Image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <h4 class="fw-bold mb-3">{{$products->name}} </h4>
                                    <p class="mb-3">Category: {{$products->categoryName}}</p>
                                    <h5 class="fw-bold mb-3">{{$products->price}} MMK</h5>
                                    <p class="mb-4">{{$products->description}}</p>
                                    <div class="d-flex mb-4 align-items-center">
                                        @php $sumRatings = number_format($sumRating) @endphp
                                        @for($i = 1 ; $i <= $sumRatings ; $i++)
                                            <i class="fa fa-star text-secondary"></i>
                                        @endfor
                                        @for($j = $sumRatings +1 ; $j <= 5; $j++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                        <span class="ms-2"><i class="fas fa-solid fa-user"></i> {{$ratingCount -> count()}}</span>
                                    </div>
                                    <form action="{{route('addItem')}}" method="post">
                                        @csrf
                                        <div class="input-group quantity mb-5" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border" >
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" name="qty" class="form-control form-control-sm text-center border-0" value="1">
                                            <div class="input-group-btn">

                                                <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" value="{{$products->id}}">
                                        <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary">
                                            <i class="fa fa-shopping-bag me-2 text-primary"></i>
                                             Add to cart
                                        </button>
                                    </form>
                                    {{-- Rating Start --}}
                                        <form action="{{route('rating')}}" method="POST">
                                            @csrf
                                            <!-- Button trigger modal -->
                                            <div class="">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                Rate This Product
                                                </button>
                                            </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card card-body mb-2">
                                                        <div class="rating-css">
                                                            <div class="star-icon">
                                                                {{-- @if ($user_rating)
                                                                    @for($i =1;$i <=$ratenum; $i++)
                                                                    <input type="radio" value="{{$i}}" name="course_rating" checked id="rating{{$i}}">
                                                                    <label for="rating{{$i}}" class="fa fa-star checked"></label>
                                                                    @endfor
                                                                    @for($j =$ratenum+1;$j<=5; $j++)
                                                                    <input type="radio" value="{{$j}}" name="course_rating" id="rating{{$j}}">
                                                                    <label for="rating{{$j}}" class="fa fa-star"></label>
                                                                    @endfor
                                                                @else --}}
                                                                <input type="hidden" name="product_id" value="{{$products->id}}" >
                                                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}" >
                                                                @if($oldRating)

                                                                    @php $old_Rating = number_format($oldRating['count']) @endphp
                                                                    @for($i = 1 ; $i <= $old_Rating ; $i++)
                                                                        <input type="radio" value="{{$i}}" name="course_rating" checked id="rating{{$i}}">
                                                                        <label for="rating{{$i}}" class="fa fa-star"></label>                                                                    @endfor
                                                                    @for($j = $old_Rating +1 ; $j <= 5; $j++)
                                                                        <input type="radio" value="{{$j}}" name="course_rating" id="rating{{$j}}">
                                                                        <label for="rating{{$j}}" class="fa fa-star"></label>
                                                                    @endfor
                                                                @else
                                                                    <input type="radio" value="1" name="course_rating" checked  id="rating1">
                                                                    <label for="rating1" class="fa fa-star"></label>
                                                                    <input type="radio" value="2" name="course_rating" id="rating2">
                                                                    <label for="rating2" class="fa fa-star"></label>
                                                                    <input type="radio" value="3" name="course_rating" id="rating3">
                                                                    <label for="rating3" class="fa fa-star"></label>
                                                                    <input type="radio" value="4" name="course_rating" id="rating4">
                                                                    <label for="rating4" class="fa fa-star"></label>
                                                                    <input type="radio" value="5" name="course_rating" id="rating5">
                                                                    <label for="rating5" class="fa fa-star"></label>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </form>
                                    {{-- Rating End --}}
                                </div>
                            </div>
                                <div class="col-lg-12">
                                    <nav>
                                        <div class="nav nav-tabs mb-3">
                                            <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                                                id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                                aria-controls="nav-about" aria-selected="true">Description</button>
                                            <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                                                id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                                                aria-controls="nav-mission" aria-selected="false">Reviews
                                            </button>
                                        </div>
                                    </nav>
                                    <div class="tab-content mb-5">
                                        <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                            <p class="mb-4">{{$products->description}}</p>

                                        </div>


                                        <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                            @foreach($commentData as $item)
                                            <div class="d-flex">
                                                @if($item->image == null)
                                                <img src="{{asset('/Default_Image/default-user.jpg')}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                                @else
                                                <img src="{{asset('/User_image/'.$item->image)}}" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                                @endif
                                                <div class="">
                                                    <p class="mb-2" style="font-size: 14px;">{{$item->created_at->format('Y/m/d H:i:s')}}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <h5>{{$item->name != null ? $item->name : $item->nickname}} </h5>
                                                    </div>
                                                    <p>{{$item->comment}}</p>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                        <div class="tab-pane" id="nav-vision" role="tabpanel">
                                            <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                                amet diam et eos labore. 3</p>
                                            <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                                Clita erat ipsum et lorem et sit</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{route('comment')}}" method="post">
                                    @csrf
                                    <h4 class="mb-5 fw-bold">Leave a Reply</h4>
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="border-bottom rounded">
                                                <input type="hidden" name="productId" value="{{$products->id}}" class="form-control border-0 me-4" placeholder="Your Name *">
                                            </div>
                                            <div class="border-bottom rounded">
                                                <input type="hidden" name="userName" value="{{auth()->user()->role  = 'simple' ? auth()->user()->name: auth()->user()->nickname}}" class="form-control border-0 me-4" placeholder="Your Name *">
                                            </div>
                                            <div class="border-bottom rounded">
                                                <input type="hidden" name="userId" value="{{auth()->user()->id}}" class="form-control border-0 me-4" placeholder="Your Name *">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="border-bottom rounded">
                                                <input type="hidden" name="userEmail" value="{{auth()->user()->email}}" class="form-control border-0" placeholder="Your Email *">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="border-bottom rounded my-4">
                                                <textarea name="userComment" class="form-control border-0 @error('userComment') is-invalid @enderror"  cols="30" rows="8" placeholder="Your Review *" spellcheck="false">{{old('comment')}}</textarea>
                                                @error('userComment')
                                                     <small class="invalid-feedback">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between py-3 mb-5">
                                                <div class="d-flex align-items-center">
                                                    <p class="mb-0 me-3">Please rate:</p>
                                                    <div class="d-flex align-items-center" style="font-size: 12px;">
                                                        <i class="fa fa-star text-muted"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Post Comment</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>
                </div>
                <h1 class="fw-bold mb-0">Related products</h1>
                <div class="vesitable">
                    <div class="owl-carousel vegetable-carousel justify-content-center">
                        @foreach($relateProduct as $item)
                            <div class="border border-primary rounded position-relative vesitable-item ">
                                <a href="{{route('shopDetail',$item->id)}}">
                                    <div class="vesitable-img">
                                        @if($item->image == null)
                                            <img style="height: 150px" src="{{asset('/Default_Image/istockphoto-1354776457-612x612.jpg')}}" class="img-fluid rounded-top w-100" style="width: 100px; height: 100px;" alt="">
                                        @else
                                            <img style="height: 150px" src="{{asset('/product_image/'.$item->image)}}" class="img-fluid rounded-top w-100" style="width: 100px; height: 100px;" alt="">
                                        @endif
                                    </div>
                                    <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">{{$item->categoryName}}</div>
                                    <div class="p-4 pb-0 rounded-bottom">
                                        <h4>{{$item->name}}</h4>
                                        <p>{{Str::words($item->description,10,'...') }}</p>
                                        <div class="d-flex justify-content-between flex-lg-wrap">
                                            <p class="text-dark fs-5 fw-bold">{{$item->price}} MMK</p>
                                            <a href="#" class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <!-- Single Product End -->


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
