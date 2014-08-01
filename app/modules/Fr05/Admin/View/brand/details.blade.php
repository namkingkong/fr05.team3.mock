@extends (VIEW_ADMIN . '::template')

@section ('content')

{{ $brand }}

<ol>
	@foreach ($products as $product)
	<li>{{ $product->name }}</li>
	@endforeach
</ol>

@stop
