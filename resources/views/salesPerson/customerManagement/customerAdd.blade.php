@extends('layouts.salesPerson')
@section('content')		
@section('customer_select','active')	
<h5 class="text-left m-2">Add Customer</h5>
<div class="admin-head d-flex align-items-center justify-content-end m-4">
    <div class=""><a href="{{url(route('customer.index'))}}" class="btn btn-primary">Back</a></div>
</div>
<div class="col-8">
	<form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="customer_name" class="form-control" value="{{old('customer_name')}}">
			@error('customer_name')
			<span class="text-danger" role="alert">
				<strong>{{$message}}</strong>
			</span>
			@enderror
		</div>
		<div class="form-group">
			<label>Phone</label>
			<input type="text" name="phone_no" class="form-control" value="{{old('phone_no')}}">
			@error('phone_no')
	            <span class="text-danger" role="alert">
	                <strong>{{$message}}</strong>
	            </span>
	        @enderror
		</div>
		<div class="form-group">
			<label>Address</label>
			<textarea name="address" class="form-control" value="{{old('address')}}" style="height: 150px;"></textarea>  
			@error('address')
	            <span class="text-danger" role="alert">
	                <strong>{{$message}}</strong>
	            </span>
	        @enderror
		</div>
		<div class="text-left mb-4">
			<button type="submit" class="btn btn-success">Add Customer</button>
		</div>
	</form>	
</div>
@endsection