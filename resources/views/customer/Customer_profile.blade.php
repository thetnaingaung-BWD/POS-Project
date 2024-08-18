<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Fruitables - Vegetable Website Template</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{asset('customer/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
        <link href="{{asset('customer/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

        {{-- Bootstrap CSS Link --}}
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{asset('customer/css/bootstrap.min.css')}}" rel="stylesheet">
        {{-- Customized CSS Link --}}
        <link rel="stylesheet" href="{{asset("customer/css/custom.css")}}">
        <!-- Template Stylesheet -->
        <link href="{{asset('customer/css/style.css')}}" rel="stylesheet">
    </head>

<body>

    <div class="card shadow mb-4  row">
        <div class="card-header py-3">
            <div class="">
                <a class="btn btn-success" href="{{route('userDashboard')}}">Back</a>
                <div class="d-flex justify-content-center">
                    <h6 class="m-0 font-weight-bold text-primary">User Details Page</h6>
                </div>
            </div>
        </div>

        <form action="{{route('userProfileEdit')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body row offset-1">
                <div class="col-6 ">
                    <input type="hidden" name = "userId" value="{{auth()->user()->id}}">
                    <input type="file" name="image" class="form-control-files @error('image') is-invalid @enderror" onchange="loadFile(event)">
                    @error('image')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror
                    @if(auth()->user()->image != null)
                    <div class="">
                        <img src="{{asset('User_image/'.auth()->user()->image)}}" class=" img-thumbnail" id="image" >
                    </div>
                    @else
                    <div class="">
                        <img src="{{asset('Default_Image/istockphoto-1354776457-612x612.jpg')}}" class=" img-thumbnail" id="image" >
                    </div>
                    @endif
                </div>
                    <div class="col-6 ">
                        <div class="row ">
                            <div class="col-6  ">
                                <input type="text" name="name" @if(auth()->user()->provider !="simple") readonly   @endif value="{{old('name',auth()->user()->provider =="github" ? $data->nickname : $data->name)}}"  class="form-control  @error('name') is-invalid @enderror" placeholder="Name...">
                                @error('name')
                                    <small class="invalid-feedback">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-6  ">
                                <input type="text" name="email" @if(auth()->user()->provider !="simple") readonly  @endif  value="{{old('email',$data->email)}}" class="form-control @error('email') is-invalid @enderror " placeholder="email">
                                @error('email')
                                        <small class="invalid-feedback">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="my-4">
                            <input type="text" name="phone" value="{{old('phone',$data->phone)}}" class="form-control  @error('phone') is-invalid @enderror" placeholder="Enter Phone Number...">
                                @error('phone')
                                    <small class="invalid-feedback">{{$message}}</small>
                                @enderror
                        </div>
                        @if(auth()->user()->provider == 'simple')
                            <div>
                                <div class="my-4">
                                    <input type="password" name="current" value="" class="form-control  @error('current') is-invalid @enderror" placeholder="Current Password...">
                                        @error('current')
                                            <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                </div>
                                <div class="row ">
                                    <div class="col-6  ">
                                        <input type="password" name="new"  value=""  class="form-control  @error('new') is-invalid @enderror" placeholder="New Password...">
                                        @error('new')
                                            <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>

                                    <div class="col-6  ">
                                        <input type="password" name="confirm"  value="" class="form-control @error('confirm') is-invalid @enderror " placeholder="Re-type Password...">
                                        @error('confirm')
                                                <small class="invalid-feedback">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="my-4">
                            <textarea name="Address"   class="form-control @error('Address') is-invalid @enderror" cols="30" rows="5" placeholder="Address">{{old('Address',$data->address)}}</textarea>
                            @error('Address')
                                    <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="my-4">
                            <input type="submit" value="Create" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
{{-- Onchange Image --}}
<script>
    function loadFile(event){
         var reader = new FileReader();
         reader.readAsDataURL(event.target.files[0]);
         reader.onload = function(){
         let output = document.getElementById('image');
         console.log(output);
         output.src = reader.result;
     }
    }
</script>
<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src=" {{asset('customer/lib/easing/easing.min.js')}}"></script>
<script src=" {{asset('customer/lib/waypoints/waypoints.min.js')}}"></script>
<script src=" {{asset('customer/lib/lightbox/js/lightbox.min.js')}} "></script>
<script src=" {{asset('customer/lib/owlcarousel/owl.carousel.min.js')}} "></script>

{{-- Bootstrap JS Link --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Template Javascript -->
<script src="{{asset('customer/js/main.js')}}"></script>
</body>

</html>
