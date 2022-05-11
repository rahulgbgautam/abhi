@extends('layouts.admin')
@section('content')		
@section('product_select','active')	
<h5 class="text-left m-2">Add Product</h5>
<div class="admin-head d-flex align-items-center justify-content-end m-4">
    <div class=""><a href="{{url(route('product.index'))}}" class="btn btn-primary">Back</a></div>
</div>
<div class="col-8">
	<form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="product_name" class="form-control" value="{{old('product_name')}}">
			@error('product_name')
			<span class="text-danger" role="alert">
				<strong>{{$message}}</strong>
			</span>
			@enderror
		</div>
		<div class="form-group">
			<label>Cost Price</label>
			<input type="text" name="cost_price" class="form-control" value="{{old('cost_price')}}">
			@error('cost_price')
	            <span class="text-danger" role="alert">
	                <strong>{{$message}}</strong>
	            </span>
	        @enderror
		</div>
		<div class="form-group">
			<label>Selling Price</label>
			<input type="text" name="selling_price" class="form-control" value="{{old('selling_price')}}">
			@error('selling_price')
	            <span class="text-danger" role="alert">
	                <strong>{{$message}}</strong>
	            </span>
	        @enderror
		</div>
		<div class="text-left mb-4">
			<button type="submit" class="btn btn-success">Add Product</button>
		</div>
	</form>	
</div>
@endsection