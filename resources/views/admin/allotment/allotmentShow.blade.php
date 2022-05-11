@extends('layouts.admin')
@section('content')
@section('allotment_select','active') 
<div class="d-flex justify-content-start">
    <h5>Alloted Product</h5>
</div>
<div class="d-flex justify-content-end m-3">
    <a href="{{route('allotment.index')}}" class="btn btn-dark">Back</a>
</div>
@if($todayAllotedProd ?? '')
    <table id="example2" class="table table-bordered table-hover">
        <thead>
              <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th class="text-center" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
                
                @foreach($todayAllotedProd ?? '' as $Data) 
                  <tr>
                    <td>{{ucwords($Data->product_name)}}</td>
                    <td>{{ucwords($Data->quantity)}}</td>
                    <td>
                         <a href="{{url(route('allotment.edit',$Data->id))}}" class="btn btn-primary"  data-toggle="tooltip"  title="Edit">
                            Edit
                        </a>
                    </td>
                    <td>
                    	<form action="{{url(route('allotment.destroy',$Data->id))}}" method="POST"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick=" return confirm('Are you sure want to delete this record?');" data-toggle="tooltip" title="Delete">Delete</button>
                        </form>
                    </td>
                  </tr>
                @endforeach           
        </tbody>
    </table>
    @if(count($todayAllotedProd) < 1) 
        <div class="d-flex justify-content-center"><strong class="text-danger">No record found.</strong></div>
    @endif
        <div class="pagination">{{$todayAllotedProd->links()}}</div>
@endif  

@if($allotedProd ?? '')
    <table id="example2" class="table table-bordered table-hover">
        <thead>
              <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Product Alloted Date</th>
            </tr>
        </thead>
        <tbody>
                @foreach($allotedProd ?? '' as $Data)
                  <tr>
                    <td>{{ucwords($Data->product_name)}}</td>
                    <td>{{ucwords($Data->quantity)}}</td>
                    <td>{{date('d/m/Y', strtotime($Data->created_at))}}</td>
                  </tr>
                @endforeach
        </tbody>
    </table>
    @if(count($allotedProd) < 1) 
        <div class="d-flex justify-content-center"><strong class="text-danger">No record found.</strong></div>
    @endif
        <div class="pagination">{{$allotedProd->links()}}</div>
@endif
@endsection 