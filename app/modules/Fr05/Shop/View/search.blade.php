@extends (VIEW_SHOP . '::template')

@section ('content')

<style>
#sidebar {
	float: left;
	width: 275px;
}


#content {
	padding-left: 300px;
}

#lstCategories .list-group {
	display: none;
	position: absolute;
	left: 100%;
	top: -1px;
	z-index: 2;
	border: solid 1px lightgray;
	white-space: nowrap;
}
#lstCategories .list-group-item:hover>.list-group {
	display: block;
}
</style>

<!-- BEGIN:	CONTENT -->
<div class="container">
	<div class="row">
		<div class="col-xs-12">

			<div id="sidebar">
				<!-- BEGIN:	CATEGORIES -->
				<div class="panel panel-default">
					<div class="panel-heading">Category</div>
					<div id="lstCategories" class="list-group">
						<div class="list-group-item"><a data-id="0" class="active">ALL CATEGORIES</a></div>
						{{ HTML::shop_search_categories_menu() }}
					</div>
				</div>
				<!-- END:	CATEGORIES -->
				<!-- BEGIN:	PRICE -->
				<div class="panel panel-default">
					<div class="panel-heading">Price</div>
					<div class="panel-body">
						<label for="txtAmount">Price range:</label>
						<input type="text" id="txtAmount" readonly style="border: 0; color: #f6931f; font-weight: bold;">
						<div id="slider-range"></div>
					</div>
				</div>
				<!-- END:	PRICE -->
				<!-- BEGIN:	BRAND -->
				<div class="panel panel-default">
					<div class="panel-heading">Brand</div>
					<div id="lstBrands" class="list-group">
						@foreach (Fr05\Service\BrandService::getAll() as $brand)
						<div class="list-group-item">
							<label>
								<input type="checkbox" value="{{ $brand->id }}" name="brand_id" class="brand-id">
								&nbsp;
								<span class="brand-name">{{ $brand->name }}</span>
							</label>
						</div>
						@endforeach
					</div>
				</div>
				<!-- END:	BRAND -->
			</div>

			<!-- BEGIN:	MAIN CONTENT -->
			<div id="content">
				<div id="categoryName">
					<script>
						document.write($('#lstCategories .list-group-item a.active').html());
					</script>
				</div>
				<div class="ha-right" >
					Sort by
					<select name="sort_field" id="sort_field">
						<option value='name'>Name</option>
						<option value='list_price'>Price</option>
						<option value='id'>Date</option>
					</select>
					<select name="sort_direction" id="sort_direction">
						<option value='desc'>Desc</option>
						<option value='asc'>Asc</option>
					</select>
					<br/><br/>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<ul id="lstProducts" class="list-group">
						</ul>
					</div>
					<div id="paginationBar"></div>
				</div>
			</div>
			<!-- END:	MAIN CONTENT -->

		</div>
	</div>
</div>
<!-- END:	CONTENT -->


<script>

var highestPrice = {{ Fr05\Service\ProductService::getPrice('highest',$_GET['category_id']) }};
var lowestPrice = {{ Fr05\Service\ProductService::getPrice('lowest',$_GET['category_id']) }};
function changePrice(lowestPrice,highestPrice){		

	$( "#slider-range" ).slider({
		range: true,
		min: lowestPrice,
		max: highestPrice,
		values: [lowestPrice, highestPrice],
		animate: "slow",
		step: 100000,
		slide: function( event, ui ) {
			$( "#txtAmount" ).val(ui.values[ 0 ] + " VND - " + ui.values[1] + " VND");
		},
		change: function(event, ui) {
			printProducts(1);
		}
	});
	
	$( "#txtAmount" ).val($("#slider-range").slider("values", 0) + " VND - " + $("#slider-range").slider("values", 1) + " VND");
}

changePrice(lowestPrice,highestPrice);
</script>

<script>
	function printProducts(page) {
		var category_id = $('#lstCategories .list-group-item a.active').data('id');

		var sort_field = $("#sort_field").val();
		
		var sort_direction = $("#sort_direction").val();

		var lowest_price = $( "#slider-range" ).slider("values", 0);
		var highest_price = $( "#slider-range" ).slider("values", 1);

		var arr_brand_id = [];
		$('.brand-id:checked').each(function(key, value) {
			arr_brand_id.push($(this).val());
		});
		
		$.ajax({
			url: "{{ URL::to('/get')}}",
			type: "GET",
			data: {
				page: page,
				category_id: category_id,
				sort_field: sort_field,
				sort_direction: sort_direction,
				lowest_price: lowest_price,
				highest_price: highest_price,
				brand_id: arr_brand_id
			 },
			contentType: "application/json",
			dataType: "json",
			success: function(resp) {
				var link = '';
				
				$.each(resp.data.data, function(key, item) {
					var brand_name = '';

					if(item.images.length) {
						$.each(item.images,function(key,value){
								image_path = "public/img/product/"+item.id+"/"+value.path;
						});
					} else{
						image_path = "public/img/noImage.jpg";
					}
					
					if(item.brand != null){ 
						brand_name = item.brand.name;}
					else {
						brand_name = "Others";
					}

					link += toThumbnails(item.id,item.name,item.list_price,brand_name,image_path);
				});

				$('#lstProducts').html(link);

				$('.btn-add-cart').click(function() {
					var id = $(this).data('id');
					var url = '{{ URL::to("ajax/cart/set") }}';
					
					var req = addCart(url,id);

					req.done(function(resp) {
						alert(resp.message);
					});
				});
				
				var pagination = myPagination(resp.data.current_page,resp.data.last_page);

				$('#paginationBar').html(pagination);

				$('#categoryName').html($('#lstCategories .list-group-item a.active').html());
				
			},	
			fail: function() {
				alert('Failed');
			}
		});
	}
	
	function toThumbnails(id,name,list_price,brand_name,image_path) {
		var thumb = "<div class='col-sm-6 col-md-3' style='height:400px'>";
	    thumb += "<div class='thumbnail'>";
	    thumb += "<a href='{{ URL::to('/productdetail') }}/" + id + "'><img class='bd-rad-6' style='width:100%;height:200px' src='"+image_path+"' > </div></a>";
	    thumb += "<div class='caption'>";
	    thumb += "<h3 style='height:50px' >" + name + "</h3>";
	    thumb += "<p>" + brand_name + "</p>";
	    thumb += "<p>" + list_price +"</p>";
	    thumb += "<a  class='btn btn-primary btn-add-cart' href='javascript:void(0)'  data-id='"+id+"' ><span class='glyphicon glyphicon-shopping-cart'></span>Add to cart</a>";
	    thumb += "<a href='{{ URL::to('/productdetail') }}/" + id + "' class='btn btn-default' role='button'>Details</a></p></div></div>";
		    
    	return thumb;
	}
	
	function myPagination(current_page,last_page){
		var string = "<ul class ='pagination' >";
		if (current_page == 1){
				string += "<li class='disabled'><span>&laquo;</span></li>";
		} else{	 
				string += "<li><a class='page' onclick='printProducts("+(current_page - 1)+");' href='javascript:void(0)' rel='prev'>&laquo;</a></li>";
		}
		
		for(var i=1; i<=last_page; i++){
			if (i==current_page){
					string += "<li class='active' ><span>"+i+"</span></li>";
			}
			else{ 	
					string += "<li><a class='page'  onclick='printProducts("+i+");' href='javascript:void(0)' >"+i+"</a></li>";
			}
		}
		
		if (current_page == last_page){
				string += "<li class='disabled'><span>&raquo;</span></li>";
		}
		else{
				string += "<li><a class='page' onclick='printProducts("+(current_page + 1)+");' href = 'javascript:void(0)'  rel='next' >&raquo;</a></li>";
		}
		string += "</ul>"
		return string;
	}

	function $_GET(q,s) {
	    s = (s) ? s : window.location.search;
	    var re = new RegExp('&amp;'+q+'=([^&amp;]*)','i');
	    return (s=s.replace(/^\?/,'&amp;').match(re)) ?s=s[1] :s='';
	}

	function changePriceSlider(){
		var category_id = $('#lstCategories .list-group-item a.active').data('id');
		var arr_brand_id = [];
		$('.brand-id:checked').each(function(key, value) {
			arr_brand_id.push($(this).val());
		});

		$.ajax({
				url : "{{URL::asset('/price')}}",
				type : "GET",
				data : {
						category_id : category_id,
						brand_id : arr_brand_id
					},
				contentType : 'application/json',
				dataType : 'json',
				success: function(resp){
						changePrice(resp.lowestPrice,resp.highestPrice);
					}, 
				error : function(resp){
						alert("Failed");
					}
			});
	}
	/*
	 * --------------------- CALL FUNCTION ---------------------
	 */
	
	$("#sort_field").change(function(){
		printProducts(1);
	});
	$("#sort_direction").change(function(){
		printProducts(1);
	});
	$('#lstCategories .list-group-item a').click(function(){
		if($(this).hasClass('active')) {
			return;
		}
		
		$('#lstCategories .list-group-item a.active').removeClass('active');
		$(this).addClass('active');
		changePriceSlider();
	});
	$('.brand-id').click(function() {
		changePriceSlider();
	});
	/*
	 * Phan tich Parameter, va chinh lai cac truong theo nhung param da chon
	 */
	
	/*
	 * AUTORUN THIS FUNCTION
	 */
	$('#lstCategories .list-group-item a.active').removeClass('active');
	var category_id = $_GET('category_id');
	$("#lstCategories .list-group-item a[data-id='"+category_id+"']").addClass('active');
	printProducts(1);
	
	
</script>
@stop
