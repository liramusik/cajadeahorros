$(document).ready(function() {
	$("#modificar-usuario").validate({
		rules: {
			nombre: {
				required: true,
				minlength: 3,
			},
			apellido: {
				required: true,
				minlength: 3,
			},
			telefono: {
				required: true,
				minlength: 11,
				digits: true,
			},
			email: {
				required: true,
				email: true,
			},
			direccion: {
				required: true,
			},
			aporte_mensual: {
				required: true,
				minlength: 2,
				digits: true,
			},
			confirmar_password: {
				equalTo: "#password",
			},
		},
	});
});
$(document).ready(function() {
	$("#cedula").keydown(function(event) {
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
	$("#telefono").keydown(function(event) {
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
	$("#aporte_mensual").keydown(function(event) {
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
	$("#fecha_ingreso").datepicker({
		dateFormat: 'dd/mm/yy',
		dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vier', 'Sab'],
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Séptiembre', 'Octubre', 'Noviembre', 'Diciembre'],
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

