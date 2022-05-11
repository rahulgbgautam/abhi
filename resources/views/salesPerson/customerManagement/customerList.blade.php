@extends('layouts.salesPerson')
@section('content')
@section('customer_select','active') 
<div class="d-flex justify-content-start">
    <h5>Customers</h5>
</div>
<div class="d-flex justify-content-end m-3">
    <a href="{{route('customer.create')}}" class="btn btn-dark">Add Customer</a>
</div>
<table id="example2" class="table table-bordered table-hover">
    <thead>
          <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
      @if($customer ?? '')
            @foreach($customer ?? '' as $Data) 
              <tr>
                <td>{{ucwords($Data->customer_name)}}</td>
                <td>{{$Data->phone_no}}</td>
                <td>{{$Data->address}}</td>
                <td>
                    <a href="{{url(route('customer.edit',$Data->id))}}" class="btn btn-primary"  data-toggle="tooltip"  title="Edit">
                        Edit
                    </a>
                </td>
                <td>
                     <form action="{{url(route('customer.destroy',$Data->id))}}" method="POST"> 
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
@if(count($customer) < 1) 
        <div class="d-flex justify-content-center"><strong class="text-danger">No record found.</strong></div>
    @endif
        <div class="pagination">{{$customer->links()}}</div>
@endsection 