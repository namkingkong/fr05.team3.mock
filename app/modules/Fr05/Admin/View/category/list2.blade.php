@extends (VIEW_ADMIN . '::template')

@section('content')

<h1>List Category</h1>

<hr>

<a class="btn btn-primary" href="{{ URL::to('admin/category/create') }}">Create Category</a>
<a class="btn btn-default" href="{{ URL::to('admin/category/reorder') }}">Re-order</a>

<hr>

<table class="table table-hover table-responsive" id="tblCategory">
	<thead>
		<tr>
			<th>Category Name</th>
			<th class="ha-right">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach($categoryList as $cate)
			<tr>
				<td>{{ $cate->name }}</td>
				<td class="ha-right">
					<a class="btn btn-info btn-sm"
						href='{{URL::to("/admin/category/update/$cate->id") }}'>Update</a>
					<a 	class="btn btn-default btn-sm"
						onclick="return confirm('Are you sure?')"
						href='{{URL::to("/admin/category/delete/$cate->id") }}'>Delete</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
<hr>

<script src="{{ URL::asset('public/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
<script>
	$(document).ready(function() {
		$('#tblCategory').dataTable();
	});

</script>

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

function printChildren($cateList, $cate, $margin)
{
	$children = getChildren($cateList, $cate);
	if($children)
	{
		foreach($children as $child)
		{
			echo "<tr>";
				echo "<td>";
					for($i=0;$i<=$margin;$i++){
						echo "&nbsp";
					}
					echo $child->name.'<br>';
				echo "</td>";
				
				echo "<td><a class='btn btn-info btn-sm' href=".URL::action('Fr05\Admin\Controller\CategoryController@getUpdate')."/".$child->id.">Update</a></td>";
				echo "<td><a class='btn btn-default btn-sm' onclick='return confirm("."'Are you sure?'".")' href=".URL::action('Fr05\Admin\Controller\CategoryController@getDelete')."/".$child->id.">Delete</a></td>";
			echo "</tr>";
			if(getChildren($cateList,$child))
			{
				printChildren($cateList, $child, $margin+10);
			}
		}
	}

}
?>

@stop
