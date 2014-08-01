@extends (VIEW_ADMIN . '::template')
@section ('content')
<style>
	#tblProduct tbody tr td div {
		height: 80px;
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
		<h1 class="text-uppercase" >Product List</h1>

		<hr>
		<a class="btn btn-primary" href="{{URL::to('admin/product/create')}}">
			Create Product
		</a>
		<form style="display: inline-block; float:right " action="{{ URL::to('admin/product') }}" method='get'>
				<input placeholder="Search product" name='keyword' type='text' value="{{isset($keyword) ? $keyword : ''}}" />
				<input type='submit' class="btn btn-primary" name='ok' value='Search' />
		</form>

		<table class="table table-hover table-responsive" id="tblProduct">
			<thead>
				<th>Product Name</th>
				<th>Description</th>
				<th>List Price</th>
				<th>Sale Price</th>
				<th>Quantity</th>
				<th>Country</th>
				<th>Image</th>
				<th>Brand</th>
				<th>Belongs to Categories</th>
				<th>Slider</th>
				<th class="ha-right">Action</th>
			</thead>
			
			<tbody>
			
				@foreach($productList as $product)
					<tr>
						<td>{{ $product->name }}</td>
						<td><div><p>{{ $product->description }}</p></div>
							<a href="{{URL::to('admin/product/update')}}/{{$product->id}}" class="hidden">...more</a>
						</td>
						<td>{{ number_format($product->list_price, 0, ',', '.').' VND' }}</td>
						<td>{{ number_format($product->sales_price, 0, ',', '.').' VND' }}</td>
						<td>{{ $product->quantity }}</td>
						<td>{{ $product->country }}</td>
						<td>
						@if ($product->images->count())
							@foreach ($product->images as $image)
								@if ($image->isMainImage)
									<img style="width:100px; height:100px;"
										src='{{ URL::asset("public/img/product/$product->id/$image->path") }}'>
								@endif
							@endforeach
						@else 
							<img style="width:100px; height:100px;"
										src='{{ URL::asset("public/img/noImage.jpg") }}'>
						@endif
						</td>
						<td>{{ $product->brand != null ? $product->brand->name : '' }}</td>
						<td><?php
								foreach ($product->categories as $cate){
									echo $cate->name.', ';
								}  
							?>
						</td>
						<td><input type="checkbox" class="sliderCheckbox" value="{{ $product->id }}" 
							<?php foreach($banners as $banner){
									if ($banner->product_id == $product->id)
										echo 'checked';
							} ?>
							/>
						</td>
						<td><a class="btn btn-info btn-sm" href='{{ URL::to("admin/product/update/{$product->id}") }}'>Update</a>
						<a 	class="btn btn-default btn-sm btn-delete"
								href='{{ URL::to("admin/product/delete/{$product->id}") }}'>Delete</a></td>
					</tr>
						@endforeach
				</tbody>
			</table>
			
			{{$productList->links()}}
			</div>
	</div>
</div>
			
<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
<script>
	
	$('#tblProduct tr div').each(function(key,value){
			
			if($(value).height() <= $(value).children('p').height()) {
				$(value).next().removeClass('hidden');
			}
			
	});				
	
							
	$(document).ready(function() {
		$('#tblProduct').dataTable({
			paging:	false,
			info:	false,
			stateSave:	true,
			bFilter: false
			});

		$('.sliderCheckbox').click(function(){
			var proId = $(this).attr("value");	
			
			$.ajax({
				url: "{{ URL::to('admin/banner/update/') }}/" + proId,
			    type: "POST",
			    contentType: "application/json",
			    complete: function(resp) {
				    if (resp['success']) {
					    alert('Saved');
				    }
			    },
			    error: function(resp) {
				    alert('Failed');
			    }
			});
		});
	});

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
