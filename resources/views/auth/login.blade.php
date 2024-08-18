@extends('auth.layouts.master')
@section('content')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-6 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <div class=" h-100 d-flex justify-content-center align-items-center">
                                <img src="{{asset('Auth/a93d57602b9a550839de6ab310111a1d.jpg')}}" class=" " alt="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" method="post" action={{route('login')}}>
                                    @csrf
                                    <div class="form-group">
                                        <input type="email"  name="email" value="{{old('email')}}"  class="form-control form-control-user @error('email') is-invalid @enderror " placeholder="Enter Email Address...">
                                        @error('email') <span class="invalid-message">{{$message}}</span> @enderror

                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" value="{{old('password')}}"  class="form-control form-control-user @error('password') is-invalid @enderror " placeholder="Enter Password ...">
                                        @error('password') <span class="invalid-message">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    <input type="submit" value='Login'  class="btn btn-primary btn-user btn-block">
                                    <hr>
                                    <a href="/auth/google/redirect" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Login with Google
                                    </a>
                                    <a href="/auth/github/redirect" class="btn btn-dark btn-user btn-block">
                                        <i class="fab  fa-github fa-fw"></i>Login with Github
                                    </a>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection
