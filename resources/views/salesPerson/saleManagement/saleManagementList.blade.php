@extends('layouts.salesPerson')
@section('content')
@section('sale_select','active') 
<div class="d-flex justify-content-start">
    <h5>Sale</h5>
</div>
 <div class="d-flex justify-content-end m-3">
        <a href="{{url('sales-person/sale-create')}}" class="btn btn-success"  data-toggle="tooltip"  title="Edit">
                        Sell
        </a>
</div>
<table id="example2" class="table table-bordered table-hover mt-5">
    <thead>
          <tr>
            <th>Product Name</th>
            <th>Alloted Quantity</th>
            <th>Selled Quanity</th>
        </tr>
    </thead>
    <tbody>
      @if($allotedProduct ?? '')
            @foreach($allotedProduct ?? '' as $Data) 
              <tr>
                <td>{{ucwords($Data->product_name)}}</td>
                <td>{{$Data->quantity}}</td>
                <td>
                   {{$Data->sell_quantity}}
                </td>
              </tr>
            @endforeach
        @endif         
    </tbody>
</table>
@if(count($allotedProduct) < 1) 
        <div class="d-flex justify-content-center"><strong class="text-danger">No record found.</strong></div>
    @endif
        <div class="pagination">{{$allotedProduct->links()}}</div>
@endsection 