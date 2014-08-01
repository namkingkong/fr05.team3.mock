@extends (VIEW_SHOP.'::template')

@section ('content')

<style>
	.row{
		margin-top:20px;
	}
</style>
<div class="container" >
		All
		<input type="radio" class ="category" name="category" id="0" value ="0"  />
	@foreach($categories as $category)
		{{ $category->name }}
		<input type="radio" class ="category" name="category" id="{{ $category->id }}" value ="{{ $category->id }}"  />
	@endforeach
	<br/>
		Sort by <select name="sort_field" id="sort_field">
					<option value='name' >Name</option>
					<option value='list_price'>Price</option>
					<option value ='id' >Date</option>
				</select> 
				<select name="sort_direction" id="sort_direction">
					<option value='desc' >Desc</option>
					<option value='asc'>Asc</option>
				</select> 
						
	<div class="row" >
		<div class="col-xs-12">
			<ul id="lstProducts" class="list-group">
			</ul>
		</div>
		<div id="paginationBar">
		
		
		</div>
	</div>
</div>

<div class="row">
   
</div>
<script>
function printProducts(page) {
	category_id = $(".category:checked").val();
	sort_field = $("#sort_field").val();
	sort_direction = $("#sort_direction").val();
	$.ajax({
		url: "{{ URL::to('/get')}}",
		type: "GET",
		data: { page: page,
				category_id:category_id,
				sort_field: sort_field,
				sort_direction: sort_direction
				 },
		contentType: "application/json",
		dataType: "json",
		success: function(resp) {
			console.log(resp);
			var link = '';
			
			$.each(resp.data.data, function(key, item) {
				if(item.images != null){
					$.each(item.images,function(key,value){
							image_path = "public/img/product/"+item.id+"/"+value.path;
						});
					} else{
						image_path = "";
						}
				if(item.brand != null){ 
						brand_name = item.brand.name;}
				else {
						brand_name = "Others";
					}
				link += toThumbnails(item.id,item.name,item.list_price,brand_name,image_path);
				
				
			});
			$('#lstProducts').html(link);
			var pagination = myPagination(resp.data.current_page,resp.data.last_page);
			$('#paginationBar').html(pagination);
			
			
		},	
		fail: function() {
			alert('Failed');
		}
	});
}

function toThumbnails(id,name,list_price,brand_name,image_path){
	var $thumb = "<div class='col-sm-6 col-md-3'>";
    $thumb += "<div class='thumbnail'>";
    $thumb += "<a href='{{ URL::to('/productdetail') }}/" + id + "'><img style='width:100%;height:200px' src='"+image_path+"' > </div></a>";
    $thumb += "<div class='caption'>";
    $thumb += "<h3>"+name+"</h3>";
    $thumb += "<p>"+list_price+"</p>";
    $thumb += "<p>";
    $thumb +=      "<a href='#' class='btn btn-primary' role='button'>Add to cart</a>"
    $thumb += "<a href='#' class='btn btn-default' role='button'>Details</a></p></div></div>"
    	return $thumb;
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


/*
 * --------------------- CALL FUNCTION ---------------------
 */

// Phan tich Parameter, va chinh lai cac truong theo nhung param da chon
$('.category').change(function(){
	printProducts(1);
});
$("#sort_field").change(function(){
	printProducts(1);
});
$("#sort_direction").change(function(){
	printProducts(1);
});

printProducts(1);
</script>

@stop