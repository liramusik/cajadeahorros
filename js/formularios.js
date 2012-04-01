$(document).ready(function(){
	$("#login").validate({
		rules: {
			'usuario': 'required',
			'password': 'required'
		},
		messages: {
			'usuario': 'Atributo usuario requerido',
			'password': 'Atributo password requerido'
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
