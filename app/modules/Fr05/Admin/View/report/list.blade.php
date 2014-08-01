@extends (VIEW_ADMIN . '::template')
<style>
	
</style>
@section ('content')



<div class="container-fluid">
	<div class="row">
		<div class="col-sm-5">
			<div class="panel panel-primary">
				<div class="panel-heading">Time period</div>
				<div class="panel-body">
					<form action='' method='get'>
						<div class="form-group">
							<label>From</label>
							<input type="date" name="start_date" class="form-control" value="{{$time['start']}}">
						</div>
						<div class="form-group">
							<label>To</label>
							<input type="date" name="end_date" class="form-control" value="{{$time['end']}}">
						</div>
						<input class="btn btn-primary" type='submit' name='btnok' value='Submit'>
						<input class="btn btn-default" type='button' name='reset' value='Reset' onclick="window.location.href='report'">
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-7">
			<div class="row">
				<div class="col-sm-12 margin-bottom-15">
					<div class="panel panel-primary">
						<div class="panel-heading">Best selling product</div>
						<div class="panel-body">
							<ul>
							@foreach($productList as $product)
								<li>{{ "{$product->name} &nbsp &nbsp ({$product->sum_quantity})<br>" }}</li>
							@endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="col-sm-12">
					<div class="panel panel-danger">
						<div class="panel-heading">Best selling category</div>
						<div class="panel-body">
							<ul>
							@foreach($categoryList as $category)
								<li>{{ "{$category->category_name} &nbsp &nbsp ({$category->sum_quantity})<br>" }}</li>
							@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop