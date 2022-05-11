@extends('layouts.admin')
@section('content')
@section('allotment_select','active') 
<div class="d-flex justify-content-start">
    <h5>Allotment</h5>
</div>
<div class="d-flex justify-content-end m-3">
    <a href="{{route('allotment.create')}}" class="btn btn-dark">Allot</a>
</div>
<table id="example2" class="table table-bordered table-hover">
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
                            <a href="{{url(route('allotment.show',$Data->sales_person_id))}}" class="btn btn-primary"  data-toggle="tooltip"  title="Edit">
                               View Todays Record 
                            </a>
                        </td>
                        <td>
                            <a href="{{url('admin/allotment-previous-record',$Data->sales_person_id)}}" class="btn btn-primary"  data-toggle="tooltip"  title="Edit">
                               View Previous Record 
                            </a>
                        </td>
                  </tr>
                @endif    
            @endforeach
        @endif         
    </tbody>
</table>
@if(count($Allotment) < 1) 
        <div class="d-flex justify-content-center"><strong class="text-danger">No record found.</strong></div>
    @endif
        <div class="pagination">{{$Allotment->links()}}</div>
@endsection 