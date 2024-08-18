@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                </div>
                <form method="get" action="{{route('showUser')}}" class="form-inline">
                    <input class="form-control mr-sm-2" name='searchKey' value="{{request('searchKey')}}" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="mb-3">
                    <a href="{{route('showUser')}}" type="button"  class="btn btn-info " >Users    <span class="badge badge-light">{{$userCount}}</span></i></a>
                    <a href="{{route('showAdmin')}}" type="button"  class="btn btn-success " >Admin  <span class="badge badge-light">{{$adminCount}}</span></i></a>
                </div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>image</th>
                            <th>Position</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                    @if($item->name != NULL)
                                        <td><a href="{{route('userinfo',$item->id)}}">{{$item->name}}</a></td>
                                    @else
                                        <td>{{$item->nickname}}</td>
                                    @endif
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->address}}</td>
                                    <td><img style="width: 50px; padding :0; text-align:center;" src="{{asset('User_image/'.$item->image)}}" alt=""></td>
                                    <td>{{$item->role}}</td>
                                    @if(auth()->user()->role != 'superadmin')
                                    <td><a href="{{route('delete',$item->id)}}" type="button"  class="btn btn-danger disabled" ><i class="fa-solid fa-trash"></i></a></td>
                                    @else
                                    <td>
                                        @if($item->role == "user")
                                        <a href="{{route('UpgradeRole',[$item->id,$item->role])}}" type="button"  class="btn btn-info" ><i class="fa-solid fa-arrow-up"></i></a>
                                        @else
                                        <a href="{{route('UpgradeRole',[$item->id,$item->role])}}" type="button"  class="btn btn-info" ><i class="fa-solid fa-arrow-down"></i></a>
                                        @endif
                                    <a href="{{route('delete',$item->id)}}" type="button"  class="btn btn-danger " ><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                    @endif
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <small class="d-flex justify-content-end">{{$data->links()}}</small>
            </div>
        </div>
    </div>

@endsection
