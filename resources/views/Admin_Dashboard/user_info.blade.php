@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->
    <a class="btn btn-outline-success" href="{{url()->previous()}}">Back</a>
    <div class="card shadow mb-4  row">
        <div class="card-header py-3">
            <div class="">
                <div class="d-flex justify-content-center">
                    <h6 class="m-0 font-weight-bold text-primary">User Details Page</h6>
                </div>
            </div>
        </div>
            <div class="card-body row offset-1">

                <div class="col-6 ">
                    @if(auth()->user()->image != null)
                    <div class="">
                        <img  src="{{asset('User_image/'.$userInfo->image)}}" class=" img-thumbnail" alt="" id="image" >
                    </div>
                    @else
                    <div class="">
                        <img  src="{{asset('Default_Image/istockphoto-1354776457-612x612.jpg')}}" class=" img-thumbnail" alt="" id="image" >
                    </div>
                    @endif
                </div>
                {{-- {{$userInfo}} --}}
                    <div class="col-6 ">
                        <div class="row ">
                            <div class="col-6  my-4">
                                <h5> Name : <label for="">{{$userInfo->name}}</label></h5>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-6  my-4">
                                <h5>Email :<label for="">{{$userInfo->email}}</label></h5>
                            </div>
                        </div>
                        @if($userInfo->phone != null )
                            <div class="row ">
                                <div class="col-6  my-4">
                                    <h5>Phone : <label for="">{{$userInfo->phone}}</label></h5>
                                </div>
                            </div>
                        @endif
                        @if($userInfo->address != null )
                            <div class="row ">
                                <div class="col-6  my-4">
                                    <h5>Address : <label for="">{{$userInfo->address}}</label></h5>

                                </div>
                            </div>
                        @endif
                        <div class="row ">
                            <div class="col-6  my-4">
                                <h5>Provider : <label for="">{{$userInfo->provider}} User</label></h5>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>
@endsection
