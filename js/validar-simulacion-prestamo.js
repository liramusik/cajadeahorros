$(document).ready(function(){
        $("#simular").validate({
                rules: {
                        monto: {
                                required: true,
                                minlength: 2,
                                digits: true,
                        },
                        tiempo: {
                                required: true,
                                minlength: 2,
                                digits: true,
                        },
                },
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
	var opciones = {
		success: mostrarRespuesta,
	};
	$('.form').ajaxForm(opciones);
	function mostrarRespuesta(responseText) {
		alert("Mensaje: " + responseText);
		$('.form').resetForm();
		$("#contenido").load("includes/pages.php?page=cuentas");
	}; 
}); 
