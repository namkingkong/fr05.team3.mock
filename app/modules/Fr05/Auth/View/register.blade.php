@extends (VIEW_ADMIN . '::template')

@section('content')

<style>body { padding-left: 0; }</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
		
			<h1 class="ha-center text-uppercase bg-trans-dark-2 bd-rad-2 padding-4">Register</h1>
			
			<br>
			
			{{ Form::open(['class' => 'form']) }}
				<p>
					{{ Session::get('message')!=null ? Session::get('message') : "" }}
				</p>
				<div class="form-group ha-center">
					<label>Username</label>
					{{ Form::text('user[username]', Input::old('username'), ['class' => 'form-control ha-center']) }}
					{{ HTML::errorMessage('username') }}
				</div>
				<div class="form-group ha-center">
					<label>Password</label>
					{{ Form::password('user[password]', ['class' => 'form-control ha-center']) }}
					{{ HTML::errorMessage('password') }}
				</div>
				<div class="form-group ha-center">
					<label>Re-enter Password</label>
					{{ Form::password('user[cpassword]', ['class' => 'form-control ha-center']) }}
					{{ HTML::errorMessage('cpassword') }}
				</div>
				<div class="form-group ha-center">
					<label>Email</label>
					{{ Form::text('user[email]', Input::old('email'), ['class' => 'form-control ha-center']) }}
					{{ HTML::errorMessage('email') }}
				</div>
				<hr>
				<p class="ha-center">
					<button type="submit" class="btn btn-primary">Register</button>
					<span class="padding-10">|</span>
					<a href="{{ URL::to('auth/login') }}" class="btn btn-danger">Cancel</a>
				</p>
			{{ Form::close() }}
		</div>
	</div>
</div>

@stop