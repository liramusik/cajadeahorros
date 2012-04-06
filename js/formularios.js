$(document).ready(function(){
	$("#login").validate({
		rules: {
			'usuario': 'required',
			'password': 'required'
		},
		messages: {
			'usuario': 'Ingrese un usuario',
			'password': 'Ingrese la contraseña'
		}
	});
});

$(document).ready(function(){
	$("#crear-usuario").validate({
		rules: {
			nombre: {
				required: true,
				minlength: 3,
			},
			apellido: {
				required: true,
				minlength: 3,
			},
			cedula: {
				required: true,
				minlength: 8,
				digits: true
			},
			telefono: {
				required: true,
				minlength: 11,
				digits: true
			},
			email: {
				required: true,
				minlength: 15,
				email: true
			},
			direccion: {
				required: true,
				minlength: 15,
			},
			fecha_ingreso: {
				required: true,
				minlength: 10,
			},
			usuario: {
				required: true,
				minlength: 8,
			},
			password: {
				required: true,
				minlength: 5
			},
			confirmar_password: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			}
		},
	});
});

$(document).ready(function(){
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
				digits: true
			},
			email: {
				required: true,
				minlength: 15,
				email: true
			},
			direccion: {
				required: true,
				minlength: 15,
			},
			usuario: {
				required: true,
				minlength: 8,
			},
			password: {
				minlength: 5
			},
			confirmar_password: {
				minlength: 5,
				equalTo: "#password"
			}
		},
	});
});

$(document).ready(function(){
	$("#solicitar-prestamo").validate({
		rules: {
			monto: {
				required: true,
				minlength: 3,
				maxlength: 7,
				digits: true
			},
			tiempo: {
				required: true,
				minlength: 1,
				maxlength: 2,
				digits: true
			},
		},
	});
});

$(document).ready(function(){
	$("#registrar-interes").validate({
		rules: {
			bancos: {
				required: true,
			},
			cuentas: {
				required: true,
			},
			fecha: {
				required: true,
			},
			monto: {
				required: true,
				minlength: 3,
				maxlength: 7,
				digits: true
			}
		},
	});
});

/* Para la cédula */
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

/* Para el teléfono */
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
	$("#monto").keydown(function(event) {
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
	$("#tiempo").keydown(function(event) {
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
	$("#cuenta").keydown(function(event) {
		if(event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
			 return;
		} else {
			if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
				event.preventDefault(); 
			}   
		}
	});
});
