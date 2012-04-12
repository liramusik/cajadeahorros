$(document).ready(function() { 
	$("#notificar").validate({
		rules: {
			asunto: {
				required: true,
				minlength: 3,
			},
			mensaje: {
				required: true,
				minlength: 5,
			},
		},
	});
});
$(document).ready(function() { 
	var opciones = {
		success: mostrarRespuesta,
	};
	$('.form').ajaxForm(opciones);
	function mostrarRespuesta(responseText) {
		alert("Mensaje: " + responseText);
		$('.form').resetForm();
	}; 
}); 

