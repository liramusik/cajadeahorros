$(document).ready(function() {
	$("#crear-usuario").validate({
		rules: {
			fecha_ingreso: {
				required: true,
				digits: true,
			},
		},
	});
});
$(document).ready(function() {
	$("#fecha").keydown(function(event) {
		if(event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
			 return;
		} else {
			if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
				event.preventDefault(); 
			}   
		}
	});
});
$(document).ready(function() {
	$("#fecha").datepicker({
		dateFormat: 'dd/mm/yy',
		dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vier', 'Sab'],
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Séptiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		maxDate: 'Now'
	});
});
$(document).ready(function() { 
	var opciones = {
		success: mostrarRespuesta,
	};
	$('.form').ajaxForm(opciones);
	function mostrarRespuesta(responseText) {
		alert("Mensaje: " + responseText);
	}; 
}); 
