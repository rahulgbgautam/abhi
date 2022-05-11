@extends('layouts.salesPerson')
@section('content')
@section('sale_select','active') 
<h5 class="text-left m-2">Sell To Customer</h5>
<div class="admin-head d-flex align-items-center justify-content-end m-4">
    <div class=""><a href="{{url('sales-person/sale')}}" class="btn btn-primary">Back</a></div>
</div>
<div class="col-12">
	<form action="{{url('sales-person/sale-store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<div class="row mt-5 mb-4">
			<div class="col-2">
				<label>Paying Amount</label>
				<input type="text" name="paying_amount" class="form-control" required>
			</div>
			<div class="col-2">
				<label>Discount</label>
				<input type="text" name="discount" class="form-control" required>
			</div>
			<div class="col-4">
				<!-- <h5>Select Sales Person</h5>  -->
			</div>
			<div class="col-4">
				<h5>Select Customer</h5>
				<select name="customer_id" class="form-control" required> 
					<option></option> 
					@if($customer)
						@foreach($customer as $Data)
							<option value="{{$Data->id}}">{{$Data->customer_name}}</option>
						@endforeach
					@endif
				</select>
				@error('customer')
					<span class="text-danger" role="alert">
						<strong>{{$message}}</strong>
					</span>
				@enderror 
			</div> 
		</div>   
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
						<select name="product[]" id="dept" required> 
							<option></option> 
							@if($allotedProduct)
								@foreach($allotedProduct as $Data)
									<option value="{{$Data->product_id}}">{{$Data->product_name}}&emsp;&emsp;&emsp;&emsp;available:{{$Data->quantity-$Data->sell_quantity}}</option>
								@endforeach
							@endif
						</select> 
						@error('product.*')
							<span class="text-danger" role="alert">
								<strong>Product is required</strong>
							</span>
						@enderror 
				    </td> 
				    <td id="col1"> 
						<input type="text" name="sell_quantity[]"/ required>
						<!-- <label class="text-danger"></label><br> -->
						@if(session()->has('quantityMsg'))
							<span class="text-danger" role="alert">
								<strong>Maximum quantity you can sell is {{session('quantityMsg')}} </strong>
							</span>
			            @endif 	 
						@error('quantity.*')
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
				<td><input type="button" value="Add Product" onclick="addRows()" /></td> 
				<td><input type="button" value="Delete Product" onclick="deleteRows()" /></td> 
				<td class="text-right"><input type="submit" name="check_invoice"value="Check Invoice"/></td> 
				<td class="text-right"><input type="submit" value="Sell Products"/></td> 
			</tr>  
		</table> 
	</form>	
</div>
<script type="text/javascript">
function addRows(){ 
	var table = document.getElementById('emptbl');
	var rowCount = table.rows.length;
	var cellCount = table.rows[0].cells.length; 
	var row = table.insertRow(rowCount);
	for(var i =0; i <= cellCount; i++){
		var cell = 'cell'+i;
		cell = row.insertCell(i);
		var copycel = document.getElementById('col'+i).innerHTML;
		cell.innerHTML=copycel;
		if(i == 3){ 
			var radioinput = document.getElementById('col3').getElementsByTagName('input'); 
			for(var j = 0; j <= radioinput.length; j++) { 
				if(radioinput[j].type == 'radio') { 
					var rownum = rowCount;
					radioinput[j].name = 'gender['+rownum+']';
				}
			}
		}
	}
}
function deleteRows(){
	var table = document.getElementById('emptbl');
	var rowCount = table.rows.length;
	if(rowCount > '2'){
		var row = table.deleteRow(rowCount-1);
		rowCount--;
	}
	else{
		alert('There should be atleast one row');
	}
}
</script>
@endsection






	