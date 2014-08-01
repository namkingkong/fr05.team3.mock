@extends (VIEW_ADMIN . '::template')
<style>
	.error{
	 	color:red;
	}
</style>

@section ('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="text-uppercase">Brand List</h1>
			
			<hr>
			
			<a class="btn btn-primary" href="{{ URL::to('admin/brand/create') }}">
				Create new Brand
			</a>
			<form action='brand' method='post' style="display: block-inline; float:right">
					<input placeholder="Search brand" name='keyword' type='text' value="{{isset($keyword) ? $keyword : ''}}" />
					<input type='submit' name='ok' value='Search' />
			</form>
			<table class="table table-hover table-responsive text-info" id="tblBrand">
				<thead>
					<tr>
						<th style="display: none"></th>
						<th>Name</th>
						<th class="ha-right">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($brands as $brand)
					<tr>
						<td style="display: none" >{{$brand->id}}</td>
						<td >{{ $brand->name }}</td>
						<td class="ha-right">
							<a class="btn btn-info btn-sm"
								href='{{ URL::to("admin/brand/update/$brand->id") }}'>Update</a>
							<button class="btn btn-default btn-sm delete">Delete</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			@if(isset($paginationEnable))
					{{$brands->links()}}
			@endif
			<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
			<script>
				$(document).ready(function() {
					$('#tblBrand').dataTable({
						paging:	false,
						info:	false,
						order: [[0, 'asc']],
						bFilter: false
					});
				});
			</script>
		</div>
	</div>
</div>
<script>

	$(".delete").click(function() {
		if(confirm("Are you sure?")){
			var td = $(this).parents('tr').first().find("td:first");
			var id = $(td).html();

			var tr = $(this).parents('tr').first();
			$.ajax({
				url: '{{ URL::to("admin/brand/delete") }}/' + id,
			    type: "DELETE",
			    contentType: "application/json",
			    dataType: "json",
			    success: function(resp) {
			    	if (resp.status) {
				    	$(tr).remove();
				    	return alert(resp.message);
			    	} 
			    	else 
				    {
						return alert(resp.message);
				    }
			    },
			    error: function(resp) {
				    alert('Failed');
			    }
			});
		}
	});
</script>
@stop