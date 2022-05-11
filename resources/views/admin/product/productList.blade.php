@extends('layouts.admin')
@section('content')
@section('product_select','active') 
<div class="d-flex justify-content-start">
    <h5>Products</h5>
</div>
<div class="d-flex justify-content-end m-3">
    <a href="{{route('product.create')}}" class="btn btn-dark">Add Product</a>
</div>
<table id="example2" class="table table-bordered table-hover">
    <thead>
          <tr>
            <th>Product Name</th>
            <th>Cost Price</th>
            <th>Selling Price</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
      @if($product ?? '')
            @foreach($product ?? '' as $Data) 
              <tr>
                <td>{{ucwords($Data->product_name)}}</td>
                <td>{{$Data->cost_price}}</td>
                <td>{{$Data->selling_price}}</td>
                <td>
                    <a href="{{url(route('product.edit',$Data->id))}}" class="btn btn-primary"  data-toggle="tooltip"  title="Edit">
                        Edit
                    </a>
                </td>
                <td>
                     <form action="{{url(route('product.destroy',$Data->id))}}" method="POST"> 
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick=" return confirm('Are you sure want to delete this record?');" data-toggle="tooltip" title="Delete">Delete</button>
                    </form>
                </td>
              </tr>
            @endforeach
        @endif         
    </tbody>
</table>
@if(count($product) < 1) 
    <div class="d-flex justify-content-center"><strong class="text-danger">No record found.</strong></div>
@endif
    <div class="pagination">{{$product->links()}}</div>
@endsection 