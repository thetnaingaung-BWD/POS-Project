@extends('Admin_dashboard.layouts.master')
@section('content')

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4 col-5">
        <div class="card-header py-3">
            <div class="">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Change Pasword</h6>
                </div>
            </div>
        </div>
        <div class="card-body">

            <form action="{{route('PassChangeProcess')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Current Password</label>
                    <input type="text" name="current" value="{{old('current')}}" class="form-control @error('current') is-invalid @enderror" placeholder="">
                    @error('current') <small class="invalid-feedback">{{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">New Password</label>
                    <input type="text" name="new" value="{{old('new')}}" class="form-control @error('new') is-invalid @enderror" placeholder="">
                    @error('new') <small class="invalid-feedback">{{$message}}</small> @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
                    <input type="text" name="confirm" value="{{old('confirm')}}" class="form-control @error('confirm') is-invalid @enderror" placeholder="">
                    @error('confirm') <small class="invalid-feedback">{{$message}}</small> @enderror
                </div>
                <input type="submit" value="Change" class="btn btn-primary">
            </form>
        </div>
    </div>

</div>
@endsection
