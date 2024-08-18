@extends('Admin_dashboard.layouts.master')
@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            
                            <th>Date</th>
                            <th>Order Code</th>
                            <th>User Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userOrder as $item)
                            <tr>
                                <input type="hidden" id="order_code" value="{{$item->order_code}}">
                                <td>{{$item->created_at->format('j - F - Y')}}</td>
                                <td><a href="{{route('details',$item->order_code)}}">{{$item->order_code}}</a></td>
                                <td><a href="{{route('userinfo',$item->userId)}}">{{$item->name}}</a></td>
                                <td>
                                    <select name="checkOrder" class="form-control changeStatus"  >
                                        <option value="0" @if($item->status == 0) selected @endif >Pending</option>
                                            <option value="1" @if($item->status == 1) selected @endif >Accept</option>
                                        <option value="2" @if($item->status == 2) selected @endif >Reject</option>
                                    </select>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <small class="d-flex justify-content-end">{{$userOrder->links()}}</small>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script-section')
<script>
$(document).ready(function(){
    $('.changeStatus').change(function(){
        $orderCode = $(this).parents('tr').find('#order_code').val();
        $status = $(this).val();
        $data = {
            'order_code' : $orderCode,
            'status' : $status,
        }
        $.ajax({
            type : 'get',
            url : 'status',
            'data' : $data,
            'dataType' : $data,
            'dataType' : 'json'

        })
        // console.log($data);


    })
})
</script>
@endsection
