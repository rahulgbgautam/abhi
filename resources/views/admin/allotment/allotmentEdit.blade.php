@extends('layouts.admin')
@section('content')		
@section('allotment_select','active')	
<h5 class="text-left m-2">Allotment</h5>
<div class="admin-head d-flex align-items-center justify-content-end m-4">
    <div class=""><a href="{{url(route('allotment.index'))}}" class="btn btn-primary">Back</a></div>
</div>
	<form action="{{route('allotment.update',$allotmentData->id)}}" method="post" enctype="multipart/form-data">
		@csrf  
		@method('put')
		<table id="emptbl" class="table table-bordered table-hover">
    		<thead>
				<tr>
					<th>Select Product</th>
					<th>Quantity</th> 
				</tr> 
			</thead>
			<tbody>	
				<tr> 
					<td id="col0"> 
						<select name="product" id="dept" required> 
							<option></option> 
							@if($product)
								@foreach($product as $Data)
									<option value="{{$Data->id}}" @if($allotmentData->product_id == $Data->id) selected="selected" @endif>{{$Data->product_name}}</option>
								@endforeach
							@endif
						</select> 
						@error('product')
							<span class="text-danger" role="alert">
								<strong>Product is required</strong>
							</span>
						@enderror 
				    </td> 
				    <td id="col1"> 
						<input type="text" name="quantity"/ required value="{{$allotmentData->quantity}}"> 
						@error('quantity')
							<span class="text-danger" role="alert">
								<strong>Quantity is required</strong>
							</span>
						@enderror
				    </td> 
				</tr>  
			</tbody>		
		</table>  
		<table> 
			<tr> 
				<td><input type="submit" value="Update" /></td> 
			</tr>  
		</table> 
	 </form>
@endsection