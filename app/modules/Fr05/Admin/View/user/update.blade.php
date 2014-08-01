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
			
			<h1>Update User</h1>
			
			<hr/>
			</div>
		<div class="col-sm-6">
			{{ Form::open() }}
			
				<p>
					{{ Form::label('Username') }}
					{{ Form::text('user[username]',$user->username,['autofocus','class' => 'form-control margin-0']) }}
					{{ HTML::errorMessage('username') }}
					
				</p>
				<p>
					{{ Form::label('Email') }}
					{{ Form::text('user[email]',$user->email,['autofocus','class' => 'form-control margin-0']) }}
					{{ HTML::errorMessage('email') }}
				</p>
				<p>
					{{ Form::label('Full name') }}
					{{ Form::text('user[name]',$user->name,['autofocus','class' => 'form-control margin-0']) }}
					{{ HTML::errorMessage('name') }}
				</p>
				<p>
					{{ Form::label('Address') }}
					{{ Form::text('user[address]',$user->address,['autofocus','class' => 'form-control margin-0']) }}
					{{ HTML::errorMessage('address') }}
				</p>
				<p>
					{{ Form::label('Phone') }}
					{{ Form::text('user[phone]',$user->phone,['autofocus','class' => 'form-control margin-0']) }}
					{{ HTML::errorMessage('phone') }}
				</p>
				<p>
					{{ Form::label('Authorization') }}
					{{ Form::select(
							'user[authorization]',
							array('1' => 'Admin', '2' => 'User'),
							$user->authorization, ['class' => 'form-control'])
					}}
					
					{{ HTML::errorMessage('aothorization') }}
				</p>
				<button type="submit" class="btn btn-primary">Save</button>
				<a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
			
			{{ Form::close() }}
			</div>
		</div>
</div>
@stop	