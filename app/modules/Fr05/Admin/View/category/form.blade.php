@extends (VIEW_ADMIN . '::template')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12">
		<h1>Form Category</h1>
			
			<hr/>
			
			</div>
		<div class="col-sm-6">
			<form method="post">
				<label>Name: </label>
				{{ Form::text('category[name]', isset($category['name']) ? $category['name'] : '',['autofocus','class' => 'form-control margin-0']) }}
				{{ HTML::errorMessage('name') }}
				<br/>
				<label>Parrent: </label> 
				<select name="category[parent_id]" class="form-control">
					<?php $margin = 10; ?>
					<option value=''>--- No parent ---</option>
					@foreach($categories as $cate)
						@if($cate->parent_id == null)
							<option value='{{$cate->id}}' {{ $category->parent_id === $cate->id ? 'selected' : null }} >{{$cate->name}} </option>
							<?php 
								$children = getChildren($categories, $cate);
								printChildren($categories, $cate, $margin,$category->parent_id);
							?>
						@endif
					@endforeach
				</select>
				</br>
				
				<button type="submit" class="btn btn-primary pull-right">Save</button>	
				<a  class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
			</form>
		</div>
	</div>
</div>
<?php
function getChildren($cateList = array(), $parentCate)
{
	$children = array();
	foreach($cateList as $cate)
	{
		if($cate->parent_id == $parentCate->id)
		{
			$children[] = $cate;
		}
	}

	if(count($children) == 0)
	{
		return false;
	}
	else {
		return $children;
	}
}

function printChildren($cateList, $cate, $margin,$parentCateId)
{
	$children = getChildren($cateList, $cate);
	if($children)
	{
		foreach($children as $child)
		{
			if($child->id==$parentCateId){
				echo "<option value='".$child->id."' selected >";
						for($i=0;$i<=$margin;$i++){
							echo "&nbsp";
						}
				echo $child->name.'<br>';			
				echo "</option>";
			} else {
				echo "<option value='".$child->id."'>";
					for($i=0;$i<=$margin;$i++){
						echo "&nbsp";
					}
				echo $child->name.'<br>';
				echo "</option>";
			}
			if(getChildren($cateList,$child))
			{
				printChildren($cateList, $child, $margin+10,$parentCateId);
			}
		}
	}

}
?>
@stop