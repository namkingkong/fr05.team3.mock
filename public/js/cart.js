function addCart(url, product_id) {
	return $.ajax({
		url : url,
		data : { product_id : product_id },
		contentType : 'application/json',
		dataType : 'json',
		success : function(resp) {
			$('#countCart').html("(" + resp.totalQuantity + ")");
		},
		error: function(resp){
			alert("Failed");
		}
	});
}

function getListCart(url){
	return $.ajax({
		url : url,
		contentType : 'application/json',
		dataTypre : 'json',
		error: function(resp) {
			alert("Failed");
		}
	});
}

function deleteCart(url, product_id) {
	return $.ajax({
		url : url,
		data : { product_id : product_id },
		contentType : 'application/json',
		dataType : 'json',
		success : function(resp) {
			$('#countCart').html("(" + resp.totalQuantity + ")");
		},
		error: function(resp){
			alert("Failed");
		}
	});
}

function clearCart(url) {
	return $.ajax({
		url: url,
		dataType: 'json',
		success: function() {
			$('#countCart').html('(0)');
		},
		error: function() {
			alert('Failed');
		},
	});
}
