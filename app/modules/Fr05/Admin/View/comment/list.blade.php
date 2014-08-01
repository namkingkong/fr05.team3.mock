@extends (VIEW_ADMIN.'::template')

@section ('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
		
		<h1 class="text-uppercase" >Comments managers</h1>
		
		<hr>
		<table class="table table-hover table-responsive" id="tblComment">
			
			<thead>
				<th>Product name</th>
				<th>Number of comments</th>
				<th>Edit</th>
			</thead>
			
			<tbody>
				@foreach ($commentList as $key => $list)
					<tr>
						<td>{{ $commentList[$key]['name'] }}</td>
						<td>{{ $commentList[$key]['numberComment'] }}</td>
						<td><a href = '{{URL::to("admin/comment/edit/{$key}")}}'>Edit</a>
						
							</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		
		<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
					<script>
						$(document).ready(function() {
							$('#tblComment').dataTable({
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