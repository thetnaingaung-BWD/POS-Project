@extends('Admin_dashboard.layouts.master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-4 offset-1 ">
            <!-- Create Payment Form -->

                <div class="card shadow mb-4 ">
                    <div class="card-header py-3">
                        <div class="">
                            <div class="">
                                <h6 class="m-0 font-weight-bold text-primary">Payment Method</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('createPayment')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Payment Name</label>
                                <input type="text" name="AcName" value="{{old('AcName')}}" class="form-control @error('AcName') is-invalid @enderror" placeholder="">
                                @error('AcName') <small class="invalid-feedback">{{$message}}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Payment Number</label>
                                <input type="number" name="AcNumber" value="{{old('AcNumber')}}" class="form-control @error('AcNumber') is-invalid @enderror" placeholder="">
                                @error('AcNumber') <small class="invalid-feedback">{{$message}}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-control @error('banking') is-invalid @enderror" aria-label="Default select example" name="banking">
                                    <option  value='' >Open this select your payment method</option>
                                    <option @if(old('banking')== 'Kpay') selected  @endif value="Kpay">Kpay</option>
                                    <option @if(old('banking')== 'KBZ') selected  @endif value="KBZ">KBZ</option>
                                    <option @if(old('banking')== 'CB Pay' ) selected  @endif value="CB Pay">CB Pay</option>
                                    <option @if(old('banking')== 'CB') selected  @endif value="CB">CB</option>
                                    <option @if(old('banking')== 'AYA Pay') selected  @endif value="AYA Pay">AYA Pay</option>
                                    <option @if(old('banking')== 'AYA') selected  @endif value="AYA">AYA</option>
                                </select>
                                @error('banking') <small class="invalid-feedback">{{$message}}</small> @enderror
                            </div>
                            <input type="submit" value="Confirm" class="btn btn-primary">
                        </form>
                    </div>
                </div>


        </div>
        <div class="col-7">
            <!-- Payment List -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="">
                        <div class="">
                            <h6 class="m-0 font-weight-bold text-primary">Payment List</h6>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Payment Name</th>
                                <th>Payment Number</th>
                                <th>Payment Type</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paymentList as $item)
                            <tr>
                                <td> {{$item->account_name}}</td>
                                <td>{{$item->account_number}}</td>
                                <td>{{$item->type}}</td>
                                <td class=" m-0 text-center ">
                                    <a href="{{route('deletePaymentList',$item->id)}}" class="btn btn-danger" ><i class="fa-solid fa-trash"></i></a>
                                    <a href="{{route('UpdatePaymentList',$item->id)}}" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <small class="d-flex justify-content-end px-4">{{$paymentList->links()}}</small>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


