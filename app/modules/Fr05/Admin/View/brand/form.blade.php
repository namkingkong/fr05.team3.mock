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
			<h1 class="text-uppercase">Form Brand</h1>
			
			<hr>
		</div>
		<div class="col-sm-6" >
			<form method="post" class="form">
				<div class="form-group">
					<label >
						<h3 class="margin-0">Name</h3>
					</label>
						{{
							Form::text('brand[name]', $brand->name,
								['class' => 'form-control margin-0']
							)
						}}
						{{ HTML::errorMessage('name') }}
				</div>
					
			</form>
			<p class="clearfix">
				<button type="submit" class="btn btn-primary pull-right">Save</button>	
				<a  class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
			</p>
		</div>
	</div>
</div>

@stop