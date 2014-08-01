@extends (VIEW_ADMIN . '::template')
<style>
	.tbl_user{
		border:1px solid ;
	}
	.tbl_user td{
		border:1px solid ;
	}
</style>
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
	<h1 class="text-uppercase" >List User</h1>
	
	<hr>
	
	<a class="btn btn-primary" href="{{ URL::to('admin/user/create') }}" href="{{URL::to('admin/user/create')}}">
		Create User
	</a>
	
	<table class="table table-hover table-responsive text-info" id="tblUser">
		<thead>
			<th style="display: none" ></th>
			<th>Username</th>
			<th>Email</td>
			<th>Full name</td>
			<th>Address</td>
			<th>Phone</td>
			<th>Authorization</th>
			<th class="ha-right">Action</th>
		</thead>
		<tbody>
		@foreach($listUser as $value)
			<tr>
			<td style="display: none" >{{ $value['id'] }}</td>
			<td>{{ $value['username'] }}</td>
			<td>{{ $value['email'] }}</td>
			<td>{{ $value['name'] }}</td>
			<td>{{ $value['address'] }}</td>
			<td>{{ $value['phone'] }}</td>
			<td>{{ $value['authorization'] === 1 ? 'Admin' : 'User' }}</td>
			<td class="ha-right">
				<a class="btn btn-info btn-sm" 
					href="{{URL::action('Fr05\Admin\Controller\UserController@getUpdate') }}/{{ $value->id }}">Update</a>
				<a class="btn btn-default btn-sm delete">Delete</a></td>
			</tr>
		@endforeach
		</tbody>	
	</table>
	@if(isset($paginationEnable))
					{{$listUser->links()}}
			@endif
	
		<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
			<script>
				$(document).ready(function() {
					$('#tblUser').dataTable({
						paging:	false,
						info:	false,
						order: [[0, 'asc']],
						bFilter: false
					});
				});

				$(".delete").click(function() {
					if(confirm("Are you sure?")){
						var td = $(this).parents('tr').first().find("td:first");
						var id = $(td).html();

						var tr = $(this).parents('tr').first();
						$.ajax({
							url: '{{ URL::to("admin/user/delete") }}/' + id,
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
							    return alert('Failed');
						    }
						});
					}
				});
			</script>
	
		</div>
	</div>
</div>
@stop