$(document).ready(function() {
	$("#login").validate({
		rules: {
			usuario: {
				required: true,
			},
			password: {
				required: true,
			},
		},
	});
});
