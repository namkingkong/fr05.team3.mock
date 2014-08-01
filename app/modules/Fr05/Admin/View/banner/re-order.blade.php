@extends (VIEW_ADMIN . '::template')

@section ('content')

<h1 class="text-uppercase	">Manage Sliders</h1>

<hr>
<div class="clearfix">
	<div class="pull-right">
		<a class="btn btn-default" href="{{ URL::to('admin/banner') }}">Cancel</a>
		<button class="btn btn-danger" id="btnSave">Save</button>
	</div>
</div>
<hr>

{{ HTML::bannersList($banners, $sliders) }}

<script src="{{ URL::asset('public/js/jquery.nestable.js') }}"></script>
<script>
	$('#lstBanners').nestable({
		"maxDepth" : 1,
		"expandBtnHTML" : "<button class='btn btn-default btn-expand' data-action='expand'>+</button>",
		"collapseBtnHTML" : "<button class='btn btn-default btn-collapse' data-action='collapse'>-</button>"
	});

	$('#btnSave').click(function() {
		var bannerls = [];

		$('#lstBanners .dd-item').each(function() {
			// Add an object containing ID (of the current element), and its parent's ID to the JSON array
			bannerls.push({
				id			: $(this).data('id'),
				index		: $(this).index() + 1
			});
		});

		// Send to backend
		$.ajax({
		    type: "POST",
		    data: JSON.stringify(bannerls),
		    contentType: "application/json",
		    complete: function(resp) {
			    if (resp['success']) {
					location.reload();
			    	alert('Saved');
			    }
		    },
		    error: function(resp) {
			    alert('Failed');
		    }
		});

		// Log for testing
		console.log(JSON.stringify(bannerls));
	});
</script>

@stop
