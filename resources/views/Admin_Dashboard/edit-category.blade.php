@extends('Admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4 col-5">
        <div class="card-header py-3">
            <div class="">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Update Category Page</h6>
                </div>
            </div>
        </div>
        <div class="card-body">

            <form action="{{route('editCategoryProcess')}}" method="post">
                @csrf
                <div class="mb-3">
                    <input type="hidden" name="categoryId" value="{{$data->id}}">
                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                    <input type="text" name="categoryName" value="{{old('categoryName',$data->name)}}" class="form-control @error('categoryName') is-invalid @enderror"   placeholder="Drinks...">
                    @error('categoryName') <small class="invalid-feedback">{{$message}}</small> @enderror
                </div>
                <input type="submit" value="Create" class="btn btn-primary">
            </form>
        </div>
    </div>

</div>
@endsection
