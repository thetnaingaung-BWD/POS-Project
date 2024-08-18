@extends('Admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4 col-5">
        <div class="card-header py-3">
            <div class="">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Add Category Page</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('AddCategoryProcess')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                    <input type="text" class="form-control @error('categoryName') is-invalid @enderror" name="categoryName" id="exampleFormControlInput1" placeholder="Drinks...">
                    @error('categoryName') <small class="invalid-feedback">{{$message}}</small> @enderror
                </div>

                <input type="submit" value="Create" class="btn btn-primary">
            </form>
        </div>
    </div>

</div>
@endsection
