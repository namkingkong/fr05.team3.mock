@extends (VIEW_ADMIN . '::template')

@section ('content')
<style>
	#img-lib {
		overflow-x: scroll;
		white-space: nowrap;
	}
	#img-frame {
		width: 100%;
		text-align: center;
		border: solid 4px rgba(0,0,0,0.2);
		border-radius: 4px;
		padding: 4px;
	}
	#img-frame img {
		position: relative;
		max-width: 100%;
		border-radius: 4px;
	}
	#img-lib img {
		max-height: 100%;
	}
	#img-lib img+img {
		margin-left: 4px;
	}
	.main-image{
		border:5px solid red;
	}
</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h1 class="text-uppercase" >Edit Product</h1>
			<hr>
		</div>
		<div class="col-sm-6">
			{{ Form::open(['class' => 'form', 'files' => true]) }}
				<div class="form-group">
					<label>Product Name</label>
					{{ Form::text('product[name]', $product->name, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('name') }}
				</div>
				<div class="form-group">
					<label>List Price</label>
					{{ Form::text('product[list_price]', $product->list_price, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('list_price') }}
				</div>
				<div class="form-group">
					<label>Sales Price</label>
					{{ Form::text('product[sales_price]', $product->sales_price, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('sales_price') }}
				</div>
				<div class="form-group">
					<label>Brand</label>
					{{ HTML::printSelections('product[brand_id]', $brands, $product->brand_id) }}
					{{ HTML::errorMessage('brand_id') }}
				</div>
				<div class="form-group">
					<label>Category</label>
					{{ HTML::printCategories($categories, $product->categories) }}
					{{ HTML::errorMessage('category_id') }}
				</div>
				<div class="form-group">
					<label>Country</label>
					{{ Form::text('product[country]', $product->country, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('country') }}
				</div>
				<div class="form-group">
					<label>Quantity</label>
					{{ Form::text('product[quantity]', $product->quantity, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('quantity') }}
				</div>
				<div class="form-group">
					<label>Description</label>
					{{ Form::textarea('product[description]', $product->description, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('description') }}
				</div>
				
					<button type="submit" class="btn btn-primary pull-right">Save</button>	
					<a  class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
				
			{{ Form::close() }}
		</div>
		<div class="col-sm-6">
			<h3>Images</h3>
			<div id="img-lib" class="bd-rad-4 padding-4"
					style="border: solid 3px rgba(0,0,0,0.2); height: 80px;">
			</div>
			<hr>
			<p>
				{{ Form::open(['class' => 'form', 'files' => true, 'url' => URL::to('admin/product/image') ]) }}
					<input name = "product_id" value = "{{ $product->id }}" class="hidden" />
					<label>You can add {{ 10 - ($product->images->count()) }} more image(s)</label>
					<br>
					{{ Form::file('images[]', array('multiple'=>true, 'class' => 'inline-block')) }}
					<input type = "submit" id="btn-add-img" class="btn btn-primary" value ="Add" >
					{{ HTML::errorMessage('image') }}
				{{ Form::close() }}
				<button id="btn-delete-img" class="btn btn-danger">Delete</button>
				<button id="btn-set-main" class="btn btn-danger" >Set as main image</button>
			</p>
			<div id="img-frame">
				<img>
			</div>
		</div>
	</div>
</div>

<script>
	var images;
	var getImagesUrl = '{{ URL::to("ajax/image/get-images/{$product->id}") }}';

	/**
	 * GET Image from server
	 */
	 
	$.ajax({
		url: getImagesUrl,
	    type: "GET",
	    contentType: "application/json",
	    dataType: "json",
	    success: function(resp) {
			// Check response status

		    if (! resp.status) {
			    return alert(resp.message);
		    }

		    // Get images from response
		    images = resp.data;

		    /*
		     * ITERATE THROUGH IMAGES
		     */
		    $.each(images, function(index, image) {
			    // Add image to the tray
			    
				if (image.isMainImage == 1) {
					var imgElmt = $('<img>')
    				.attr('src', image.path)
    				.data('id', image.id)
    				.addClass('main-image')
    				.appendTo($('#img-lib'));
					} else {
						var imgElmt = $('<img>')
	    				.attr('src', image.path)
	    				.data('id', image.id)
	    				.appendTo($('#img-lib'));
							
						}

			    // Setup click event of images in the tray
				imgElmt.click(function() {
					$('#img-frame img')
						.attr('src', imgElmt.attr('src'))
						.data('id', $(this).data('id'));
				});
		    });

		    // Click the first image
	    	$('#img-lib img')[0].click();
	    },
	    error: function(resp) {
		    alert('Failed');
	    }
	});

	/**
	 * DELETE Image
	 */
	$('#btn-delete-img').click(function() {
		var imgId = $('#img-frame img').data('id');
		
		$.ajax({
			url: '{{ URL::to("ajax/image/delete") }}/' + imgId,
		    type: "GET",
		    contentType: "application/json",
		    dataType: "json",
		    success: function(resp) {
		    	if (! resp.status) {
			    	return alert(resp.message);
		    	}

		    	// Remove the image element having the ID of the deleted one
		    	$('#img-lib img').each(function() {
			    	if ($(this).data('id') == imgId) {
				    	$(this).remove();
			    	}
		    	});

		    	// Click the first image
		    	if ($('#img-lib img').size()) {
			    	$('#img-lib img')[0].click();
		    	} else {
			    	$('#img-frame img').attr('src', null);
		    	}
		    },
		    error: function(resp) {
			    alert('Failed');
		    }
		});
	});

	$('#btn-add-img').click(function() {
		$('#input-file').click();
	});

	$('#input-file').change(function() {
		
	});

	$('#btn-set-main').click(function(){

		var imgId = $('#img-frame img').data('id');
		
		$.ajax({
				url : '{{ URL::to("ajax/image/set-main") }}/' + imgId,
				type : 'GET',
				contentType : 'application/json',
				dataType : 'json',
				success : function(resp) {
					
						alert(resp.message);

						if (resp.status) {
							$('#img-lib img.main-image').removeClass('main-image');
							$('#img-lib img').each(function() {
								if ($(this).data('id') == imgId) {
									$(this).addClass('main-image');
								}
							});
						}
				},
				error : function(resp){
						alert('Failed');
				} 
			});
		
		});
</script>

@stop
