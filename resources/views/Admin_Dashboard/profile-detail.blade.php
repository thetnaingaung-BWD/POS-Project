@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4  row">
        <div class="card-header py-3">
            <div class="">
                <div class="d-flex justify-content-center">
                    <h6 class="m-0 font-weight-bold text-primary">Admin Details Page</h6>
                </div>
            </div>
        </div>

        <form action="{{route('UpdateProfileDetails')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body row offset-1">
                <div class="col-6 ">
                    <input type="hidden" name = "userId" value="{{$data->id}}">
                    <input type="file" name="image"    class="form-control-files @error('image') is-invalid @enderror" onchange="loadFile(event)">
                    @error('image')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror
                    @if(auth()->user()->image != null)
                    <div class="">
                        <img src="{{asset('User_image/'.auth()->user()->image)}}" class=" img-thumbnail" alt="" id="image" >
                    </div>
                    @else
                    <div class="">
                        <img src="{{asset('Default_Image/istockphoto-1354776457-612x612.jpg')}}" class=" img-thumbnail" alt="" id="image" >
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
                        <div class="my-4">
                            <textarea name="Address"   class="form-control @error('Address') is-invalid @enderror" cols="30" rows="5" placeholder="Address">{{old('Address',$data->address)}}</textarea>
                            @error('Address')
                                    <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="my-4">
                            <input type="submit" value="Create" class="btn btn-success">
                            @if(auth()->user()->provider == "simple" )
                                <a href="{{route('ShowPasswordBlade')}}" class="mx-3" >Change Password</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
