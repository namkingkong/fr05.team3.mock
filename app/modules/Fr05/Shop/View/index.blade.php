@extends (VIEW_SHOP . '::template')

@section ('content')

	<!--    BEGIN   :   CONTENT -->
    <?php $banners = Fr05\Service\BannerService::getAll() ?>
    
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- BEGIN:	BANNER  -->
                <div id="banner" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                    	@for ($i = 0; $i < $banners->count(); ++$i)
                    		<li data-target="#banner" data-slide-to="{{ $i }}">
                    	@endfor
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                    	
                    	@foreach ($banners as $banner)
                    		<div class="item">
                    			@if ($banner->product->images->count())
                    				<img src='{{ URL::asset("public/img/product/{$banner->product_id}/{$banner->product->images[0]->path}") }}'>
                    			@else 
                    				<img src='{{ URL::asset("public/img/noImage.jpg") }}'>
                    			@endif
                    			<div class="carousel-caption">
                    				<strong>{{ $banner->product->name }}</strong>
                    			</div>
                    		</div>
                    	@endforeach
                    </div>

                    <!-- Controls -->
                    <a class="left carousel-control" href="#banner" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#banner" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
                <!-- END:	BANNER  -->
                
                <!-- BEGIN:	NEW PRODUCTS -->
                <div class="col-xs-12 padding-0">
                	<h2>New Products</h2>
                	<hr>
                	<div class="row">
	                	@foreach (Fr05\Service\ProductService::getLatestProduct(9) as $product)
	                		<div class="col-sm-4">
	                			<div class="thumbnail">
	                				<a href="{{ URL::to('/productdetail') }}/{{ $product->id }}">
		                				@if($product->images->count()!=0)
											<img alt="Product Main Image" style="width: 100%; height: 200px;"
												class="bd-rad-6"
												src='{{ URL::asset("public/img/product/{$product->id}/{$product->images[0]->path}") }}'>
										@else
											<img alt="Product Main Image" style="width: 100%; height: 200px;"
												class="bd-rad-6"
												src='{{ URL::asset("public/img/noImage.jpg") }}'>
										@endif
									</a>
									<div class="caption">
										<h3>{{ $product->name }}</h3>
										<p>{{ $product->brand ? $product->brand->name : 'Other' }}</p>
										<p>{{ $product->list_price }}</p>
										<p>
											<a href="javascript:void(0)" class="btn btn-primary btn-add-cart" data-id = "{{ $product->id }}"  role="button"><span class="glyphicon glyphicon-shopping-cart"></span>Add to cart</a>
											<a href="{{ URL::to('/productdetail') }}/{{ $product->id }}" class="btn btn-default" role="button">Details</a>
										</p>
									</div>
						    	</div>
	                		</div>
	                	@endforeach
	                	<script>
		                	$('.btn-add-cart').click(function() {
		    					var id = $(this).data('id');
		    					var url = '{{ URL::to("ajax/cart/set") }}';
		    					
		    					var req = addCart(url,id);

		    					req.done(function(resp) {
		    						alert(resp.message);
		    					});
		    				});
	                	</script>
	                </div>
                </div>
                <!-- END:	NEW PRODUCTS -->
            </div>
        </div>
    </div>
    <!--    END   :   CONTENT   -->

@stop
