$(document).ready(function(){
	$("#login").validate({
		rules: {
			'usuario': 'required',
			'password': 'required'
		},
		messages: {
			'usuario': 'Es necesario ingresar un Usuario',
			'password': 'Es necesario ingresar una Contraseña'
		}
	});
});
$(document).ready(function(){
	$("#agregar-usuario").validate({
		rules: {
		},
		messages: {
		}
	});
});
