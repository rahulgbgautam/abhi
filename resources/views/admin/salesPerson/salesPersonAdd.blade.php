@extends('layouts.admin')
@section('content')		
@section('sales_person_select','active')	
<h5 class="text-left m-2">Add Sales Person</h5>
<div class="admin-head d-flex align-items-center justify-content-end m-4">
    <div class=""><a href="{{url(route('sales-person.index'))}}" class="btn btn-primary">Back</a></div>
</div>
<div class="col-8">
	<form action="{{route('sales-person.store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control" value="{{old('name')}}">
			@error('name')
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
			<label>Email</label>
			<input type="text" name="email" class="form-control" value="{{old('email')}}">
			@error('email')
	            <span class="text-danger" role="alert">
	                <strong>{{$message}}</strong>
	            </span>
	        @enderror
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="text" name="password" class="form-control" value="{{old('password')}}">
			@error('password')
	            <span class="text-danger" role="alert">
	                <strong>{{$message}}</strong>
	            </span>
	        @enderror
		</div>
		<div class="text-left mb-4">
			<button type="submit" class="btn btn-success">Add Sales Person</button>
		</div>
	</form>	
</div>
@endsection