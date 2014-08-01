@extends (VIEW_ADMIN.'::template')

@section ('content')
<style>
	.colreview {
		width: 300px;
	    overflow:hidden;
	    display: inline-block;
	    white-space: nowrap;
	}
	.review:hover {
		background:#ccddee;
	}
	#tblReview tbody tr td div {
		max-width: 200px;
		max-height: 100px;
		overflow: hidden;
	}
	p{
		word-wrap:break-word;
		text-align:justify;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
		
		<h1 class="text-uppercase" >Reviews managers</h1>
		
		<hr>
		
		<table  id="tblReview">
			
			<thead>
				<th style="display: none" ></th>
				<th>Posted on</th>
				<th>Email</th>
				<th>Product name</th>
				<th>Review</th>
				<th>Rating</th>
				<th class="ha-right" >Action</th>
			</thead>
			
			<tbody>
				@foreach ($reviewsList as $key => $review)
					<tr class ="review" >
						<td style="display: none" >{{ $review['id'] }}</td>
						<td>{{ $review['created_at'] }}</td>
						<td>{{ $review['email'] }}</td>
						<td>{{ $review['product_name']}}</td>
						<td >
							<div>
								<p>{{ $review['review'] }}</p>
							</div>
							<a href="{{URL::to('admin/review/edit')}}/{{$review['id']}}" class="hidden">...more</a>
						</td>
						<td>{{ $review['rating'] }}</td>
						<td class="ha-right" style="width:200px" >
							@if(!$review->isApproved)
							<button class="btn btn-primary btn-approve ">Aprrove</button>
							@endif
							<button class="btn btn-default btn-delete " >Delete</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		@if ($enablePagination)
			{{$reviewsList->links()}}
		@endif
		
		<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
					<script>
						$(document).ready(function() {
							$('#tblReview').dataTable({
								paging:	false,
								info:	false,
								bFilter: false,
								"aaSorting": []
								});
						});
					</script>
		
		</div>
	</div>
</div>
<script>
	$('#tblReview tr div').each(function(key,value){
		
		if($(value).height() <= $(value).children('p').height()) {
			$(value).next().removeClass('hidden');
		}
		
	});			
					
	$(".btn-approve").click(function(){
		var td = $(this).parents('tr').first().find("td:first");
		var id = $(td).html();

		var curBtn = $(this);
		$.ajax({
			url: '{{ URL::to("ajax/review/approve") }}/' + id,
		    type: "GET",
		    contentType: "application/json",
		    dataType: "json",
		    success: function(resp) {
		    	if (resp.status) {
			    	$(curBtn).remove();
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

	$(".btn-delete").click(function(){
		var td = $(this).parents('tr').first().find("td:first");
		var id = $(td).html();

		var tr = $(this).parents('tr').first();
		$.ajax({
			url: '{{ URL::to("ajax/review/delete") }}/' + id,
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
		
	});
</script>
@stop