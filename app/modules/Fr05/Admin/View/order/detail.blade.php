@extends (VIEW_ADMIN . '::template')
<style>
	.tbl_orderdetail{
		border: 1px solid;
	}
	.tbl_orderdetail{
		border: 1px solid;
	}

</style>

@section('content')
<h1 class="text-uppercase"> Order Detail </h1>
<hr>
	<fieldset>
    	<legend> About customer </legend>
    	@if($order->user_id)
    		Name: {{$order->user->name}} </br>
    		Email: {{$order->user->email}} </br>
    		Address: {{$order->user->address}} </br>
    		Phone: {{$order->user->phone}} </br>
    	@else
    		Name: {{$order->customer_name}} </br>
			Email: {{$order->customer_email}} </br>
			Address:{{$order->customer_address}} </br>
			Phone: {{$order->customer_phone}} </br>
    	@endif	
    	@if($order->isPaid)
    		Status: IsPaid
    	@else
    		Status: Not Paid
    	@endif
	</fieldset>   		

<hr>	
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
		<table class="table table-hover table-responsive" id="tblOrderDetail">
			<thead>
				<th>Product Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</thead>
			<tbody>
				<?php $billTotal = 0 ;?>
				@foreach($order->orderDetails as $detail)
					<?php $total = $detail->price * $detail->quantity ?>
					<?php $billTotal += $total ?>
					<tr>
						<td>{{$detail->product_name}}</td>
						<td>{{ number_format($detail->price, 0, ',', '.').' VND' }}</td>
						<td>{{$detail->quantity}}</td>
						<td>{{ number_format($total, 0, ',', '.').' VND' }}</td>
						
					</tr>
				@endforeach
			</tbody>
		</table>
		
		<strong style="float:right;">Bill Total: {{ number_format($billTotal, 0, ',', '.').' VND' }}</strong> 
						
		
		<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
			<script>
				$(document).ready(function() {
					$('#tblOrderDetail').dataTable({
						paging:	false,
						info:	false,
						stateSave:	true,
						scrollY:	'400px',
						scrollCollapse: true,
						bFilter: false
					});
				});
			</script>
			
		</div>
	</div>
</div>
@stop
			
						
		
		
		
		
		
		
		