@extends (VIEW_SHOP . '::template')

@section ('content')

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h2>Your Contact Info</h2>
			<hr>
			{{ Form::open(['class' => 'form']) }}
				<div class="form-group">
					<label>Your Name</label>
					{{ Form::text('customer[customer_name]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('customer_name') }}
				</div>
				<div class="form-group">
					<label>Address</label>
					{{ Form::text('customer[customer_address]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('customer_address') }}
				</div>
				<div class="form-group">
					<label>Email</label>
					{{ Form::text('customer[customer_email]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('customer_email') }}
				</div>
				<div class="form-group">
					<label>Phone</label>
					{{ Form::text('customer[customer_phone]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('customer_phone') }}
				</div>
				<p class="padding-top-15">
					<button type="submit" class="btn bg-orange text-white text-strong">It's OK! Checkout</button>
				</p>
			{{ Form::close() }}
		</div>
		
		<hr class="visible-xs">
		
		<div class="col-md-6">
			<h2>Your Cart</h2>
			<hr>
			<table class="table">
				<thead>
					<tr>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
				
					<?php $totalPrice = 0; ?>
					
					@if (count($cart))
						@foreach ($cart as $item)
							<?php $price = $item['product']->sales_price ? $item['product']->sales_price : $item['product']->list_price ?>
							<?php $curTotalPrice = $price * $item['quantity'] ?>
							<?php $totalPrice += $curTotalPrice ?>
							
							<tr>
								<td>{{ $item['product']->name }}</td>
								<td>{{ $price }}</td>
								<td>{{ $item['quantity'] }}</td>
								<td>{{ $curTotalPrice }}</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="5" class="bg-orange text-white">
								<strong>Your cart is empty</strong>
							</td>
						</tr>
					@endif
				</tbody>
				<tfoot>
					<tr class="text-orange">
						<td colspan="3">
							<strong>Total</strong>
						</td>
						<td>
							<strong>{{ $totalPrice }}</strong>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

@stop
