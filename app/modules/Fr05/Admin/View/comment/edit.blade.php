@extends (VIEW_ADMIN. '::template')

@section ('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
		
			<h1 class="text-uppercase" >Edit Comments</h1>
			
			<hr>
			<table width="100%">
				<tr><td width="5%"><a  class="btn btn-default" href="{{ URL::previous() }}">Back</a></td>
			
				<td align="center"><h3>{{$product->name}}</h3></td>
				<td width="5%">&nbsp</td></tr>
			</table>
			
			<table class="table table-hover table-responsive" id="tblEditReview">
			
				<thead>
					<th>Posted on</th>
					<th>Email or username</th>
					<th>Content</th>
					<th class="ha-right" >Action</th>
				</thead>
				<tbody>
					@foreach ($product->comments as $comment)
						<tr>
							<td style="display: none" >{{$comment->id}}</td>
							<td>{{$comment->created_at}}</td>
							@if ($comment->guestEmail)
								<td>{{$comment->guestEmail}}</td>
							@endif
							
							@if ($comment->user_id)
								<td>{{$comment->user_id}}</td>
							@endif
							
							<td>{{$comment->content}}</td>
							
							<td class="ha-right" ><button class = "btn-delete" >Delete</button></td>
						
						
						</tr>
					@endforeach
				</tbody>
				
			
			</table>
			<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
					<script>
						$(document).ready(function() {
							$('#tblEditReview').dataTable({
								paging:	false,
								info:	false,
								stateSave:	true,
								scrollY: '400px',
								scrollCollapse: true,
								bFilter: false
								});
						});
					</script>
			
		</div>
	</div>
</div>
<script>
	$(".btn-delete").click(function(){
		var td = $(this).parents('tr').first().find("td:first");
		var id = $(td).html();

		var tr = $(this).parents('tr').first();
		$.ajax({
			url: '{{ URL::to("ajax/comment/delete") }}/' + id,
		    type: "GET",
		    contentType: "application/json",
		    dataType: "json",
		    success: function(resp) {
		    	if (resp.status) {
			    	$(tr).remove();
			    	return alert(resp.message);
		    	} else {
					return alert(resp.message);
			    }
		    },
		    error: function(resp) {
			    alert('Failed');
		    }
		});
		
	});
</script>


@stop