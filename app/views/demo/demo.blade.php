<html>
<head>
<script src="{{ URL::asset('public/js/jquery-1.11.1.min.js') }}"></script>
</head>
<body>
	<table id="my-table">
		<tr data-id="123">
			<td>SP 1</td>
			<td><button class="btn-delete-sp">Delete</button></td>
		</tr>
		<tr data-id="579">
			<td>SP 2</td>
			<td><button class="btn-delete-sp">Delete</button></td>
		</tr>
		<tr data-id="asd">
			<td>SP ASD</td>
			<td><button class="btn btn-default btn-sm btn-delete-sp">Delete</button></td>
		</tr>
	</table>
	<input id="my-id">
	<button id="btn-send">Send</button>
</body>
<script>
	$(".btn-delete-sp").click(function() {
		// Tim tr gan nhat
		var tr = $(this).parents('tr').first();

		// Lay ra id cua SP
		var productId = $(tr).data('id');

		// Gui bang AJAX
		$.ajax({
			url: "{{ URL::to('demo/delete') }}/" + productId,
			type: "DELETE",
			contentType: "application/json",
			success: function(resp) {
				if (resp.status) {
					alert('thanh cong: ' + resp.message);
				}
				else {
					alert('that bai: ' + resp.message);
				}
			},
			error: function() {
				alert('Co loi khi gui');
			}
		});
	});
</script>
</html>