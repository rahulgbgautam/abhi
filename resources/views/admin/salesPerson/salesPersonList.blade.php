@extends('layouts.admin')
@section('content')
@section('sales_person_select','active') 
<div class="d-flex justify-content-start">
    <h5>Sales Person</h5>
</div>
<div class="d-flex justify-content-end m-3">
    <a href="{{route('sales-person.create')}}" class="btn btn-dark">Add Sales Person</a>
</div>
<table id="example2" class="table table-bordered table-hover">
    <thead>
          <tr>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
      @if($salesPerson ?? '')
            @foreach($salesPerson ?? '' as $Data) 
              <tr>
                <td>{{ucwords($Data->name)}}</td>
                <td>{{$Data->phone_no}}</td>
                <td>{{$Data->email}}</td>
                <td>
                    <a href="{{url(route('sales-person.edit',$Data->id))}}" class="btn btn-primary"  data-toggle="tooltip"  title="Edit">
                        Edit
                    </a>
                </td>
                <td>
                     <form action="{{url(route('sales-person.destroy',$Data->id))}}" method="POST"> 
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
@if(count($salesPerson) < 1) 
    <div class="d-flex justify-content-center"><strong class="text-danger">No record found.</strong></div>
@endif
    <div class="pagination">{{$salesPerson->links()}}</div>
@endsection 