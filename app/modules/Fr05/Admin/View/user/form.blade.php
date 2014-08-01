@extends (VIEW_ADMIN . '::template')
<style>
	.error{
	color:red;
	}
</style>
@section ('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
		
			<h1>Create User</h1>
			
			<hr/>
			
			</div>
		<div class="col-sm-6">
		
			{{ Form::open() }}
			
				<p>
					{{ Form::label('Username') }}
					{{ Form::text('user[username]', null,['autofocus','class' => 'form-control margin-0']) }}
					{{ HTML::errorMessage('username') }}
					
				</p>
				<p>
					{{ Form::label('Password') }}
					{{ Form::password('user[password]', ['class' => 'form-control']) }}
					{{ HTML::errorMessage('password') }}
				</p>
				<p>
					{{ Form::label('Email') }}
					{{ Form::text('user[email]',null,['class' => 'form-control']) }}
					{{ HTML::errorMessage('email') }}
				</p>
				<p>
					{{ Form::label('Full name') }}
					{{ Form::text('user[name]',null,['class' => 'form-control']) }}
					{{ HTML::errorMessage('name') }}
				</p>
				<p>
					{{ Form::label('Address') }}
					{{ Form::text('user[address]',null,['class' => 'form-control']) }}
					{{ HTML::errorMessage('address') }}
				</p>
				<p>
					{{ Form::label('Phone') }}
					{{ Form::text('user[phone]',null,['class' => 'form-control']) }}
					{{ HTML::errorMessage('phone') }}
				</p>
				<p>
					{{ Form::label('Authorization') }}
					{{ Form::select('user[authorization]',array(''=>'','1' => 'Admin', '2' => 'User'), null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('authorization') }}
				</p>
				
				<button type="submit" class="btn btn-primary">Create</button>
				<a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
			
			{{ Form::close() }}
		</div>
	</div>
</div>
@stop	