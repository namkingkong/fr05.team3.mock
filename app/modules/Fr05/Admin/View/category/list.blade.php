@extends (VIEW_ADMIN . '::template')
<style>
	.tbl_category{
		border:1px solid ;
	}
	.tbl_category td{
		border:1px solid ;
	}
</style>

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
		<h1 class="text-uppercase" >List Category</h1>
		
		<hr>
		<a class="btn btn-primary" href="{{URL::to('admin/category/create')}}">
			Create Category
		</a>
		
		<a class="btn btn-default" href="{{URL::to('admin/category/reorder')}}">
			Re-order
		</a>
		<table class="table table-hover table-responsive" id="tblCategory">
			<thead>
			
			<th>Category Name</th>
			<th class = "ha-right" >Action</th>
			</thead>
		<tbody>
		@foreach($categoryList as $cate)
			@if($cate->parent_id == null)
				<?php $margin = 10; ?>
				<tr>
					
					<td>{{ $cate->name }}</td>
					<td class="ha-right" >
						<a class="btn btn-info btn-sm" 
							href='{{ URL::to("admin/category/update/{$cate->id}") }}'>Update</a>
						<a class="btn btn-default btn-sm btn-delete"
							href='{{ URL::to("admin/category/delete/{$cate->id}") }}'>Delete</a>
					</td>
				</tr>
				<?php 
				$children = HTML::getChildren($categoryList, $cate);
				HTML::printChildren($categoryList, $cate, $margin);
				?>
			@endif
		@endforeach
	</tbody>
</table>
<hr>
<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#tblCategory').dataTable({
			paging:	false,
			info:	false,
			order: [],
			bFilter: false
		});
	});

</script>

<script>

	$(".btn-delete").click(function() {
		
		if(confirm("Are you sure?")) {

			var tr = $(this).parents('tr').first();
			var href = $(this).attr('href');

			$.ajax({
				url: href,
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

		return false;
	});
</script>

@stop
