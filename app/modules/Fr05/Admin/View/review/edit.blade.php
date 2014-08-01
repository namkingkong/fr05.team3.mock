@extends (VIEW_ADMIN. '::template')

@section ('content')
<style>

	.review{
		background:#ddd;
		width:500px;
	}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
		
			<h1 class="text-uppercase" >Edit Reviews</h1>
			
			<hr>
			<table width="100%">
				<tr><td width="5%"><a  class="btn btn-default" href="{{ URL::previous() }}">Back</a></td>
				<td align="center"><h3>{{$product_name}}</h3></td>
				<td width="5%">&nbsp</td></tr>
			</table>
			<hr/>
			<input style="display: none" class="id" value="{{$review->id}}"/>
			<div>
				<font>Email: {{$review->guestEmail}}</font>
			</div>
			<div>
				<font>Rating: {{$review->rating}}</font>
			</div>
			<div>
				<font>Status: {{$review->isApproved?"Approved":"Pending"}}</font>
			</div>
			<div>
				<font>Posted on: {{$review->created_at}}</font>
			</div>
			<div>
				<font>Review:</font>
				<div class="review"> {{$review->review}}</div>
			</div>
			<br/>
			<div>
				<button class="btn btn-default btn-delete" >Delete</button>
				@if(!$review->isApproved)
						<button class="btn btn-primary btn-approve">Aprrove</button>
				@endif
			</div>
		</div>
	</div>
</div>
<script>
	
					
	$(".btn-approve").click(function(){
		var id = $('.id').val();

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
		var id = $('.id').val	();
		
		$.ajax({
			url: '{{ URL::to("ajax/review/delete") }}/' + id,
		    type: "DELETE",
		    contentType: "application/json",
		    dataType: "json",
		    success: function(resp) {
		    	if (resp.status) {
			    	window.location.href = "{{URL::to('admin/review')}}";
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