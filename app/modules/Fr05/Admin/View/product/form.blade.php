@extends (VIEW_ADMIN . '::template')
@section ('content')
<style>
	#img-lib {
		overflow-x: scroll;
		white-space: nowrap;
	}
	#img-frame {
		width: 100%;
		text-align: center;
		border: solid 4px rgba(0,0,0,0.2);
		border-radius: 4px;
		padding: 4px;
	}
	#img-frame img {
		position: relative;
		max-width: 100%;
		border-radius: 4px;
	}
	#img-lib img {
		max-height: 100%;
	}
	#img-lib img+img {
		margin-left: 4px;
	}
</style>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
			<h1 class = "text-uppercase" >Create Product</h1>
			<hr>
		</div>
		<div class="col-sm-6">
			{{ Form::open(['files' => true]) }}
			
				<div class="form-group">
					{{ Form::label('Product name') }}
					{{ Form::text('product[name]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('name') }}
					
				</div>
				<div class="form-group">
					{{ Form::label('List price') }}
					{{ Form::text('product[list_price]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('list_price') }}
				</div>
				<div class="form-group">
					{{ Form::label('Sale price') }}
					{{ Form::text('product[sales_price]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('sales_price') }}
				</div>
				<div class="form-group">
					{{ Form::label('Brand') }}
					{{ HTML::printSelections('product[brand_id]', $brands) }}
					{{ HTML::errorMessage('brand_id') }}
				</div>
				<div class="form-group">
					{{ Form::label('Category') }}
		<!-- 			<select name = 'category_id[]' multiple = "yes" > -->
						{{ HTML::printCategories($categories) }}
		<!-- 			</select> -->
					{{ HTML::errorMessage('category_id') }}
				</div>
				<div class="form-group">
					{{ Form::label('Country') }}
					{{ Form::text('product[country]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('country') }}
				</div>
				<div class="form-group">
					{{ Form::label('Quantity') }}
					{{ Form::text('product[quantity]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('quantity') }}
				</div>
				<div class="form-group">
					{{ Form::label('Description') }}
					{{ Form::textarea('product[description]', null, ['class' => 'form-control']) }}
					{{ HTML::errorMessage('description') }}
				</div>
				<div class="form-group">
					{{ Form::label('Images (Takes only the first 10 files)') }}	
					{{ Form::file('images[]', array('multiple'=>true)) }}
					{{ HTML::errorMessage('image') }}
				</div>
				<button type="submit" class="btn btn-primary pull-right">Save</button>	
				<a  class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
				
			</div>
		{{ Form::close() }}
@stop
