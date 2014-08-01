@extends (VIEW_ADMIN . '::template')

@section ('content')

<h1 class="text-uppercase	">Reorder Categories</h1>

<hr>
<div class="clearfix">
	<div class="pull-right">
		<a class="btn btn-default" href="{{ URL::to('admin/category') }}">Cancel</a>
		<button class="btn btn-danger" id="btnSave">Save</button>
	</div>
</div>
<hr>

{{ HTML::categoriesNestedList($categories) }}

<script src="{{ URL::asset('public/js/jquery.nestable.js') }}"></script>
<script>
	$('#lstNestedCategories').nestable({
		"maxDepth" : 100,
		"expandBtnHTML" : "<button class='btn btn-default btn-expand' data-action='expand'>+</button>",
		"collapseBtnHTML" : "<button class='btn btn-default btn-collapse' data-action='collapse'>-</button>"
	});

	$('#btnSave').click(function() {
		var categories = [];

		$('#lstNestedCategories .dd-item').each(function() {
			// Get only the first parent found (because there may be grandparent, grand grandparent...)
			var parent = $(this).parents('.dd-item')[0];

			// Add an object containing ID (of the current element), and its parent's ID to the JSON array
			categories.push({
				id			: $(this).data('id'),
				parent_id	: parent == null ? null : $(parent).data('id'),
				index		: $(this).index() + 1
			});
		});

		// Send to backend
		$.ajax({
		    type: "POST",
		    data: JSON.stringify(categories),
		    contentType: "application/json",
		    complete: function(resp) {

		    	resp = resp.responseJSON;
			    
			    if (resp['success']) {
				    alert('Saved');
				    console.log(resp.data);
			    }
		    },
		    error: function(resp) {
			    alert('Failed');
		    }
		});

		// Log for testing
		console.log(JSON.stringify(categories));
	});
</script>

@stop
