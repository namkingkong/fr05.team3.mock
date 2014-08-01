@extends (VIEW_SHOP . '::template')
@section ('content')
<link rel="stylesheet" href="{{ URL::asset('public/css/shop/productDetail.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('public/raty/lib/jquery.raty.css') }}" type="text/css"/>
<script type="text/javascript" src="{{ URL::asset('public/raty/lib/jquery.raty.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/jssorSlider/js/jssor.core.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/jssorSlider/js/jssor.utils.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/jssorSlider/js/jssor.slider.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('public/js/jssorSlider/prodetailSlider.js') }}"></script>
<style>
	.error{
		color: red;
	}
	
	.alert{
		font-size: 15px;
	}
</style>

<div id='productInfo'>
	<!-- Jssor Slider Begin -->
    <div id="productImages" class="col-ms-6"
	    	style="position: relative; top: 0px; left: 0px; width: 600px;
	        	height: 300px; background: #191919; overflow: hidden;">
	
        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url({{ URL::asset("public/css/shop/img/loading.gif") }}) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>
	
        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 120px; top: 0px; width: 480px; height: 300px; overflow: hidden;">
        	@if($product->images->count()!=0)
            	@foreach ($product->images as $image)
            		<div>
	                	<img u="image" src='{{ URL::asset("public/img/product/$product->id/$image->path") }}' />
	                	<img u="thumb" src='{{ URL::asset("public/img/product/$product->id/$image->path") }}' />
		            </div>
				@endforeach
			@else
				<div>
	    	            <img u="image" src='{{ URL::asset("public/img/noImage.jpg") }}' />
	        	        <img u="thumb" src='{{ URL::asset("public/img/noImage.jpg") }}' />
		        </div>
		    @endif
        </div>
	        
        <!-- Arrow Navigator Skin Begin -->
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 158px; left: 128px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 158px; right: 8px">
        </span>
        <!-- Arrow Navigator Skin End -->
	        
        <!-- Thumbnail Navigator Skin 02 Begin -->
        <div u="thumbnavigator" class="jssort02" style="position: absolute; width: 120px; height: 300px; left:0px; bottom: 0px;">
        
            <!-- Thumbnail Item Skin Begin -->
            <div u="slides" style="cursor: move;">
                <div u="prototype" class="p" style="position: absolute; width: 99px; height: 66px; top: 0; left: 0;">
                	<div class=w><thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate></div>
                    <div class=c>
                    </div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        
        <!-- Thumbnail Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">content slider</a>
	    <!-- Jssor Slider End -->
	</div>
		
	<div id='productDetails' class="col-sm-6">
		<label class='big-font black-text'>{{ $product->brand ? $product->brand->name.': '.$product->name : $product->name }}</label>
		<label class='big-font black-text'>{{ $product->quantity > 0 ? 'Available' : 'Out of store' }}</label>
		<label class='black-text normal-font'>{{ $product->country ? 'Country: '.$product->country : ''}}</label>
		<label class='big-font'>{{ number_format($product->list_price, 0, ',', '.').' VND' }}</label>
		<label class='bigger-font'>{{ $product->sales_price > 0 ? 'ON SALES: '.number_format($product->sales_price, 0, ',', '.').' VND' : '' }}</label>
		<p>{{ $product->description }}</p>
		<a href="javascript:void(0)" data-id="{{ $product->id }}"  class="btn btn-primary btn-add-cart">
			<span class="glyphicon glyphicon-shopping-cart"></span> Add to cart
		</a>
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
	
<br/><br/>
<div id='productReviews' class="panel panel-primary">
	<div class="panel-heading">
	    <h3 class="panel-title">&nbsp;&nbsp;<span class="glyphicon glyphicon-comment">&nbsp;Reviews</span></h3>
  	</div>
  	<div class="panel-body">
	<form method='post'>
		<label>Name: </label>
		<input type="text" name="input[name]"/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<label>Email: </label>
		<input type="text" name="input[email]"/><br/>
		<span class='error'>{{isset($errors) ? $errors->first('name') : ''}}</span>
		<span class='error'>{{isset($errors) ? $errors->first('email') : ''}}</span>
		<br /><br />
		<div id="rate">Score: &nbsp;&nbsp;</div>	
		<input id='score' type='text' name="input[score]" hidden />
		<input id='score' type='text' name="input[product_id]" value="{{ $product->id }}" hidden />
		<br />
		<label>Review: </label>
		<span class='error'>{{isset($errors) ? $errors->first('content') : ''}}</span><br />
		<textarea class="reviewTxt" name="input[content]" style="width: 600;height:150"></textarea><br />
		<span class='alert'><i>{{Session::get('successAlert')}}</i></span>
		<br />
		
		<input type='submit' name='ok' class="btn btn-primary" value="Send review"/>		
	</form>
	<hr style="background-color: black; border-top: 1px solid grey;">

	<div id="previousReview">
	<?php $index = 1; ?>
		@if(count($product->reviews))
			@foreach($product->reviews as $key=>$review)
				@if($review->isApproved)
				<div class='review'>
					
					<label>{{$review->name }} - {{ $review->email }} - {{ $review->created_at }} </label><br />
					
					<div id="{{'rated'.$index++}}" data-score="{{$review->rating}}">Score: </div>	 
					
					<label>Content: </label>
					<span class='reviewText'>{{ $review->review }}</span>
					<hr>		
				</div>
				@endif
			@endforeach
		@else
			<span>No review</span>
		@endif
	</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#rate').raty({
			half: true, 
			path: "{{ URL::asset('public/raty/lib/images') }}",
			target: '#score',
			targetType : 'score',
			targetKeep : true,
		});

		for(i=1;i<={{$index}};i++) {
			$('#rated'+i).raty({
				readOnly: true,
				score: function() {
				    return $(this).attr('data-score');
				},										
				half: true, 
				path: "{{ URL::asset('public/raty/lib/images') }}",
				target: '#score',
				targetType : 'score',
				targetKeep : true,
			});
		}
	});
</script>
@stop