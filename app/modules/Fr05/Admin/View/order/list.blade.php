@extends (VIEW_ADMIN . '::template')
<style>
	.tbl_order{
		border: 1px solid;
	}
	.tbl_order{
		border: 1px solid;
	}
	td vertical-align:top;
</style>

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
		<h1 class="text-uppercase"> Order List </h1>
		
		<hr>
		<table class="table table-hover table-responsive" id="tblOrder">
			<thead>
				<th>Time</th>
				<th>Customer Name</th>
				<th>User/Guest</th>
				<th>IsPaid</th>
				<th class="">Action</th>
			</thead>
			<tbody>
				@foreach($orderList as $order)
					<tr>
						<td>{{$order->time}}</td>
						@if($order->user_id)
						<td>{{$order->user->name}}</td>
						<td>User</td>
						@else
						<td>{{$order->customer_name}}</td>
						<td>Guest</td>
						@endif
						@if($order->isPaid)
						<td>isPaid</td>
						@else
						<td>Not Paid</td>
						@endif
						<td>
							<a class="btn btn-info btn-sm"
								href='{{ URL::to("admin/order/detail/{$order->id}") }}'>Detail</a>
							<a 	class="btn btn-default btn-sm" onclick="return confirm('Are you sure?')"
									href='{{ URL::to("admin/order/delete/{$order->id}") }}'>Delete</a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@if(isset($paginationEnable))
			{{$orderList->links()}}
		@endif
		
		<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
			<script>
				$(document).ready(function() {
					$('#tblOrder').dataTable({
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
			
						
		
		
		
		
		
		
		