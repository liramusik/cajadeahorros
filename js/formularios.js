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
	$("#agregar-usuario").validate({
		rules: {
			'nombre': 'required',
			'nombre': {
				required: true,
				minlength: 3
			},
			'apellido': 'required',
			'apellido': {
				required: true,
				minlength: 5
			},
			'cedula': 'required',
			'cedula': {
				required: true,
				minlength: 8,
				number: true
			},
			'telefono': 'required',
			'telefono': {
				required: true,
				minlength: 11,
				number: true
			},
			'email': 'required',
			'email': {
				required: true,
				minlength: 15,
				email: true
			},
			'direccion': 'required',
			'direccion': {
				required: true,
				minlength: 15,
			},
			'fecha_ingreso': 'required',
			'usuario': 'usuario',
			'usuario': {
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
		messages: {
		}
	});
});
