$('.btn-file > input[type="file"]').hide();
$('.btn-file').click(function() {
	$('input[type="file"]', this)[0].click();
});