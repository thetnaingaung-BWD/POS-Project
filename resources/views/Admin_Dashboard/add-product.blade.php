@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4  row">
        <div class="card-header py-3">
            <div class="">
                <div class="d-flex justify-content-center">
                    <h6 class="m-0 font-weight-bold text-primary">Add Product Page</h6>
                </div>
            </div>
        </div>
        <form action="{{route('CreateProductProcess')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body row offset-1">
                <div class="col-6 ">
                    <input type="file" name="image"   class="form-control-files @error('image') is-invalid @enderror" onchange="loadFile(event)">
                    @error('image')
                        <small class="invalid-feedback">{{$message}}</small>
                    @enderror
                    <div class="">
                        <img src="{{asset('Default_Image/istockphoto-1354776457-612x612.jpg')}}" class=" img-thumbnail" alt="" id="image" >
                    </div>
                </div>
                    <div class="col-6 ">
                        <div class="row ">
                            <div class="col-6  ">
                                <input type="text" name="name" value="{{old('name')}}"  class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Product Name...">
                                @error('name')
                                    <small class="invalid-feedback">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="col-6  ">
                                <input type="text" name="price" value="{{old('price')}}" class="form-control  @error('price') is-invalid @enderror" placeholder="Enter Product Price...">
                                @error('price')
                                    <small class="invalid-feedback">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="my-4">
                            <textarea name="description"   class="form-control @error('description') is-invalid @enderror" cols="30" rows="5" placeholder="Description">{{old('description')}}</textarea>
                            @error('description')
                                    <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="my-4">
                            <input type="number" name="count" value="{{old('count')}}" class="form-control @error('count') is-invalid @enderror " placeholder="Count">
                            @error('count')
                                    <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="my-4">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Example select</label>
                                <select class="form-control @error('category') is-invalid @enderror " name='category'>
                                  <option value="">Choose Catagory</option>
                                    @foreach ($data as $item)
                                    <option value="{{$item->id}}"  @if(old('category')== $item->id) selected  @endif  >{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                    <small class="invalid-feedback">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="my-4">
                            <input type="submit" value="Create" class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection
