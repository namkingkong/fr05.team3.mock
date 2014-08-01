@extends (VIEW_ADMIN . '::template')

@section('content')

<style>body { padding-left: 0; }</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
		
			<h1 class="ha-center text-uppercase bg-trans-dark-2 bd-rad-2 padding-4">Login</h1>
			
			<br>
			
			{{ Form::open(['class' => 'form']) }}
				<div class="form-group ha-center">
					<label>Username</label>
					{{ Form::text('username', Input::old('username'), ['class' => 'form-control ha-center']) }}
					{{ HTML::errorMessage('username') }}
				</div>
		
				<div class="form-group ha-center">
					{{ Form::label('password', 'Password') }}
					{{ Form::password('password', ['class' => 'form-control ha-center']) }}
					{{ HTML::errorMessage('password') }}
				</div>
		
				<p class="ha-center">
					<a href="{{ URL::to('/') }}" class="btn btn-danger">Cancel</a>
					<span class="padding-10">|</span>
					<button type="submit" class="btn btn-primary">Login</button>
					
				</p>
			{{ Form::close() }}
		</div>
	</div>
</div>

@stop