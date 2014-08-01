@extends (VIEW_SHOP . '::template')

@section ('content')

<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Your Cart</h1>
			<hr>
			{{ Form::open() }}
				<table id="tblCart" class="table table-responsive">
					<thead>
						<tr>
							<th>Product</th>
							<th class="ha-right">Price</th>
							<th class="ha-right">Quantity</th>
							<th class="ha-right">Total</th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					@if (count($cart))
						<tbody>
							<?php $totalPrice = 0; ?>
							
							@foreach ($cart as $productId => $item)
								<?php $price = $item['product']->sales_price ? $item['product']->sales_price : $item['product']->list_price ?>
								<?php $totalPrice += $price ?>
								<tr>
									<td>
										{{ $item['product']->name }}
									</td>
									<td class="ha-right">
										{{ $price }}
									</td>
									<td class="ha-right">
										<input type="number" min="1"
												class="ha-right"
												name="cart[{{ $item['product']->id }}]"
												value="{{ $item['quantity'] }}"
												onChange="changeTableTotalPrice()">
									</td>
									<td class="ha-right">
										{{ $price * $item['quantity'] }}
									</td>
									<td class="ha-right">
										<a class="btn btn-default btn-remove" data-id="{{ $productId }}">Remove</a>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr class="text-orange">
								<td colspan="3">
									<strong>Total</strong>
								</td>
								<td colspan="1" class="ha-right">
									<strong id="lblTotalPrice">{{ $totalPrice }}</strong>
								</td>
								<td></td>
							</tr>
						</tfoot>
					@else
						<tr>
							<td colspan="5" class="bg-orange text-white">
								<strong>Your cart is empty</strong>
							</td>
						</tr>
					@endif
				</table>
				
				<p class="ha-right">
					<button type="button" class="btn btn-default btn-clear-cart">Clear Cart</button>
					<button type="submit" class="btn bg-orange text-white text-strong">It's OK! Checkout</button>
				</p>
			{{ Form::close() }}
		</div>
	</div>
</div>

<script>
	/**
	 * Calculate and print TOTAL PRICE of Cart table
	 */
	function changeTableTotalPrice() {
		window.tableTotalPrice = 0;
		
		$('#tblCart tbody tr').each(function() {
			var price = $('td:eq(1)', this).text();
			var quantity = $('td:eq(2) input', this).val();
			var total = price * quantity;

			$('td:eq(3)', this).text(total);

			window.tableTotalPrice += total;
		});

		$('#lblTotalPrice').text(window.tableTotalPrice);
	}
</script>
<script>
	$('.btn-remove').click(function() {
		window.clickedBtnRemove = $(this);
		
		var id = $(this).data('id');

		var ajaxUrl = "{{ URL::to('ajax/cart/remove') }}";

		var req = deleteCart(ajaxUrl, id);

		req.done(function(resp) {
			// Remove successfully
			if (resp.status) {
				$(window.clickedBtnRemove).parents('tr').first().remove();
				changeTableTotalPrice();
			}
		});
	});

	$('.btn-clear-cart').click(function() {
		var url = "{{ URL::to('ajax/cart/clear') }}";

		var req = clearCart(url);

		req.done(function(resp) {
			// Clear successfully
			if (resp.status) {
				var contentRow = $(document.createElement('tr'));
				var contentCell = $(document.createElement('td'))
								.attr('colspan', 5)
								.addClass('bg-orange text-white')
								.html('<strong>Your cart is empty</strong>');

				$('#tblCart tbody').html(contentRow.html(contentCell));

				$('#tblCart tfoot').remove();
			}
		});
	});
</script>

@stop
