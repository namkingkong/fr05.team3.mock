@extends (VIEW_ADMIN . '::template')

@section('content')

<h1>{{ $caption }}</h1>

<hr>

<form method="post" class="form">
	<div class="form-group">
		<label>Name: </label>
		{{ Form::text('category[name]',
				$category->name,
				['class' => 'form-control']) }}
		@if ($errors->first('name'))
		<div class='padding-5 padding-left-10 margin-top-10 bd-rad-4 bg-danger text-white'>{{ $errors->first('name') }}</div>
		@endif
	</div>
	<div class="form-group">
		<label>Parent Category</label>
		{{ HTML::createCategoryComboBox(['class' => 'form-control'], $category->parent ? $category->parent->id : null) }}
	</div>
	
	<div class="clearfix padding-top-15">
		<a class="btn btn-default" href="{{ URL::to('admin/category') }}">Cancel</a>
		<button type="submit" class="btn btn-primary pull-right">Save</button>
	</div>
</form>

<?php

// function getChildren($cateList = array(), $parentCate)
// {
// 	$children = array();
// 	foreach($cateList as $cate)
// 	{
// 		if($cate->parent_id == $parentCate->id)
// 		{
// 			$children[] = $cate;
// 		}
// 	}

// 	if(count($children) == 0)
// 	{
// 		return false;
// 	}
// 	else {
// 		return $children;
// 	}
// }
// function printChildren($cateList, $cate, $margin)
// {
// 	$children = getChildren($cateList, $cate);
// 	if($children)
// 	{
// 		foreach($children as $child)
// 		{
// 			echo "<option value=".$child->id.">";
// 					for($i=0;$i<=$margin;$i++){
// 						echo "&nbsp";
// 					}
// 					echo $child->name.'<br>';			
// 			echo "</option>";
// 			if(getChildren($cateList,$child))
// 			{
// 				printChildren($cateList, $child, $margin+10);
// 			}
// 		}
// 	}

// }

// $margin = 10;
// $children = getChildren($categories, $cate);
// printChildren($categories, $cate, $margin);
?>

@stop