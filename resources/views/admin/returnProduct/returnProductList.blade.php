
@extends('layouts.admin')
@section('content')
@section('return_select','active') 
<div class="d-flex justify-content-start">
    <h5>Return</h5>
</div>
<table id="example2" class="table table-bordered table-hover mt-5">
    <thead>
          <tr>
            <th>Sales Person Name</th>
            <th colspan="2" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
      @if($Allotment ?? '')
            @foreach($Allotment ?? '' as $Data) 
              @if($Data->name)
                <tr>
                  <td>{{ucwords($Data->name)}}</td>
                  <td>
                      <a href="{{url('admin/sales-person-return-product',$Data->sales_person_id)}}" class="btn btn-primary"  data-toggle="tooltip"  title="Edit">
                         View Todays Return 
                      </a>
                  </td>
                  <td>
                      <a href="{{url('admin/sales-person-return-all-product',$Data->sales_person_id)}}" class="btn btn-primary"  data-toggle="tooltip"  title="Edit">
                         View Previous Return 
                      </a>
                  </td>
                </tr>
              @endif  
            @endforeach
        @endif         
    </tbody>
</table>
@endsection 