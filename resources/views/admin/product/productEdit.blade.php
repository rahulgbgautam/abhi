@extends('layouts.admin')
@section('content')
@section('product_select','active')	
<h5 class="text-left m-2">Edit Product</h5>
<div class="admin-head d-flex align-items-center justify-content-end m-4">
    <div class=""><a href="{{url(route('product.index'))}}" class="btn btn-primary">Back</a></div>
</div>
<div class="col-8">
	@if($product)
	<form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
		@csrf
		@method('put')
		<div class="form-group">
			<label>Product Name</label>
			<input type="text" name="product_name" class="form-control" value="{{$product->product_name}}">
			@error('product_name')
				<span class="text-danger" role="alert">
					<strong>{{$message}}</strong>
				</span>
			@enderror
		</div>
		<div class="form-group">
			<label>Cost Price</label>
			<input type="text" name="cost_price" class="form-control" value="{{$product->cost_price}}">
			@error('cost_price')
	            <span class="text-danger" role="alert">
	                <strong>{{$message}}</strong>
	            </span>
	        @enderror
		</div>
		<div class="form-group">
			<label>Selling Price</label>
			<input type="text" name="selling_price" class="form-control" value="{{$product->selling_price}}">
			@error('selling_price')
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
