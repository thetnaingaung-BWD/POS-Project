@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <form action="{{route('ShowProductDetail')}}" method="get" >
                    <div class="d-flex">
                        @csrf
                        <input type="text" name="searchData" class="form-control" value="{{request('searchData')}}" placeholder="Search Product...">
                        <button type="submit" class="btn btn-warning"> Search</button>
                    </div>
                </form>
                <div class="align-self-center ">
                    <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                </div>
                <div class="">
                    <a href="{{route('AddProductProcess')}}"><i class="fa-solid fa-plus"></i> Add Category</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>description</th>
                            <th>price</th>
                            <th>count</th>
                            <th>image</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($data as $item)
                        <tr>
                            <td> {{$item->name}}</td>
                            <td>{{\Illuminate\Support\Str::words($item->description, 4, '...') }}</td>
                            <td>{{$item->price}}MMK</td>
                            <td>{{$item->count}}</td>
                            <td><img style="width: 50px; padding :0; text-align:center;" src="{{asset('product_image/'.$item->image)}}" alt=""></td>
                            <td class=" m-0 text-center ">
                                <a href="{{route('DetailProductProcess',$item->id)}} " class="btn btn-info" ><i class="fa-solid fa-circle-info"></i></a>
                                <a href="{{route('DeleteProductProcess',$item->id)}}" class="btn btn-danger" ><i class="fa-solid fa-trash"></i></a>
                                <a href="{{route('UpdateProduct',$item->id)}}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                <small class="d-flex justify-content-end">{{$data->links()}}</small>
            </div>
        </div>
    </div>

</div>
@endsection
