@extends('layouts.admin')
@section('content')
@section('sales_person_select','active')	
<h5 class="text-left m-2">Edit SalesPerson</h5>
<div class="admin-head d-flex align-items-center justify-content-end m-4">
    <div class=""><a href="{{url(route('sales-person.index'))}}" class="btn btn-primary">Back</a></div>
</div>
<div class="col-8">
	@if($salesPerson)
	<form action="{{route('sales-person.update',$salesPerson->id)}}" method="post" enctype="multipart/form-data">
		@csrf
		@method('put')
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control" value="{{$salesPerson->name}}">
			@error('name')
				<span class="text-danger" role="alert">
					<strong>{{$message}}</strong>
				</span>
			@enderror
		</div>
		<div class="form-group">
			<label>Phone</label>
			<input type="text" name="phone_no" class="form-control" value="{{$salesPerson->phone_no}}">
			<input type="hidden" name="old_phone_no" class="form-control" value="{{$salesPerson->phone_no}}">
			@error('phone_no')
				<span class="text-danger" role="alert">
					<strong>{{$message}}</strong>
				</span>
			@enderror
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" class="form-control" value="{{$salesPerson->email}}" readonly>
			@error('email')
				<span class="text-danger" role="alert">
					<strong>{{$message}}</strong>
				</span>
			@enderror
		</div>
		<div class="text-left">
			<button type="submit" class="btn btn-success">Update</button>
		</div>
	</form>	
	@endif			
</div>
@endsection
