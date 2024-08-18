@extends('auth.layouts.master')
@section('content')
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image">
                    <div class=" d-flex justify-content-center align-items-center h-100 px-3">
                        <img src="{{asset('Auth/a93d57602b9a550839de6ab310111a1d.jpg')}}" class="img-thumbnail " alt="">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user"method="post" action={{route('register')}} >
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control form-control-user @error('name') is-invalid @enderror}" id="exampleFirstName"
                                        placeholder="Enter Your Name">
                                    @error('name') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-user @error('email') is-invalid @enderror" id="exampleInputEmail"
                                    placeholder="Email Address">
                                    @error('email') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group">
                                <input type="tel" name="phone" value="{{old('phone')}}" class="form-control form-control-user @error('phone') is-invalid @enderror" id="exampleInputEmail"
                                    placeholder="Phone number">
                                    @error('phone') <span class="invalid-feedback">{{$message}}</span> @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" value="{{old('password')}}" class="form-control form-control-user @error('password') is-invalid @enderror"
                                        id="exampleInputPassword" placeholder="Password">
                                        @error('password') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" " class="form-control form-control-user @error('password_confirmation') is-invalid @enderror"
                                        id="exampleRepeatPassword" placeholder="Repeat Password">
                                        @error('password_confirmation') <span class="invalid-feedback">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block"> Register Account </button>
                            <hr>
                            <a href="/auth/google/redirect" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="/auth/github/redirect" class="btn btn-dark btn-user btn-block">
                                <i class="fab  fa-github fa-fw"></i> Register with Github
                            </a>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forget-password">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
