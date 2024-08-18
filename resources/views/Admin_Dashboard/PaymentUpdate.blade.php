@extends('Admin_dashboard.layouts.master')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-6 offset-2 ">
            <!-- Update Payment Form -->
            {{$UpdatepaymentList}}
                <div class="card shadow mb-4 ">
                    <div class="card-header py-3">
                        <div class="">
                            <div class="">
                                <h6 class="m-0 font-weight-bold text-primary">Update Payment Detail</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('UpdatePaymentProcess')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="PaymentId" value="{{$UpdatepaymentList->id}}">
                                <label for="exampleFormControlInput1" class="form-label">Payment Name</label>
                                <input type="text" name="AcName" value="{{old('AcName',$UpdatepaymentList->account_name)}}" class="form-control @error('AcName') is-invalid @enderror" placeholder="">
                                @error('AcName') <small class="invalid-feedback">{{$message}}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Payment Number</label>
                                <input type="number" name="AcNumber" value="{{old('AcNumber',$UpdatepaymentList->account_number)}}" class="form-control @error('AcNumber') is-invalid @enderror" placeholder="">
                                @error('AcNumber') <small class="invalid-feedback">{{$message}}</small> @enderror
                            </div>
                            <div class="mb-3">
                                <select class="form-select form-control @error('banking') is-invalid @enderror" aria-label="Default select example" name="banking">
                                    <option  value='' >Open this select your payment method</option>
                                    <option @if(old('banking',$UpdatepaymentList->type)== 'KBZ') selected  @endif value="KBZ">KBZ</option>
                                    <option @if(old('banking',$UpdatepaymentList->type)== 'Kpay') selected  @endif value="Kpay">Kpay</option>
                                    <option @if(old('banking',$UpdatepaymentList->type)== 'CB Pay' ) selected  @endif value="CB Pay">CB Pay</option>
                                    <option @if(old('banking',$UpdatepaymentList->type)== 'CB') selected  @endif value="CB">CB</option>
                                    <option @if(old('banking',$UpdatepaymentList->type)== 'AYA Pay') selected  @endif value="AYA Pay">AYA Pay</option>
                                    <option @if(old('banking',$UpdatepaymentList->type)== 'AYA') selected  @endif value="AYA">AYA</option>
                                </select>
                                @error('banking') <small class="invalid-feedback">{{$message}}</small> @enderror
                            </div>
                            <a href="{{route('ShowPaymentBlade')}}"><button type="button" class="btn btn-dark" >Back</button></a>
                            <input type="submit" value="Confirm" class="btn btn-primary">
                        </form>
                    </div>
                </div>


        </div>

    </div>
</div>
@endsection
