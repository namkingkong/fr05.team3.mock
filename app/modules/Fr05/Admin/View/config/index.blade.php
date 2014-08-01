@extends (VIEW_ADMIN . '::template')

@section ('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-3">
			<h1>Du Hast</h1>
			<hr>
			{{ Form::open() }}
				@foreach ($configList as $key => $val)
				<div class="form-group">
					<label>{{ $key }}</label>
					{{ Form::text("config[{$key}]", $val, ['class' => 'form-control']) }}
				</div>
				@endforeach
				<p class="ha-center">
					<button type="submit" class="btn btn-primary">Save</button>
				</p>
			{{ Form::close() }}
		</div>
	</div>
</div>

@stop
