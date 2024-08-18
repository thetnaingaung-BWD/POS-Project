@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                </div>
                <div class="">
                    <a href="{{route('adminAddCategory')}}"><i class="fa-solid fa-plus"></i> Add Category</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Create Time</th>
                            <th>Update Time</th>
                        </tr>
                    </thead>
                    <input type="hidden" value="{{$count=1}}">
                    @foreach ($data as $item)

                        <tbody>
                            <tr>
                                <td> {{$count++}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <a href="{{route('UpdateCategoryProcess',$item->id)}}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{route('deleteCategoryProcess',$item->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    @endforeach
                </table>
                <span class="d-flex justify-content-end">{{$data->links()}}</span>
            </div>
        </div>
    </div>

</div>
@endsection
