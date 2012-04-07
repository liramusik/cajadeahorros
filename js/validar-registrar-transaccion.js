$(document).ready(function() {
	var sbancos = '<option value=""></option>';
	$(bancos).each(function(i) {
		sbancos += '<option value="'+this.id_banco+'">'+this.banco+'</option>';
	});
	$('#bancos').html(sbancos);
	$('#bancos').change(function() {
		var banco = $('#bancos').val();
		var pcuentas = $.grep(cuentas,function(n,i) {
			return (n.id_banco == banco); 
		});
		var scuentas = '<option value=""></option>';
		$(pcuentas).each(function(i) {
			scuentas += '<option value="'+this.id+'">'+this.cuenta+'</option>';
		});
		$('#cuentas').html(scuentas);
	});
});
$(document).ready(function() {
	$("#fecha").datepicker({
		dateFormat: 'dd/mm/yy',
		dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vier', 'Sab'],
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Séptiembre', 'Octubre', 'Noviembre', 'Diciembre']
	});
});
$(document).ready(function(){
            $("#crear-transaccion").validate({
                    rules: {
                            monto: {
                                    required: true,
                                    minlength: 2,
                            },
                            deposito: {
                                    required: true,
                                    minlength: 3,
                            },
                            bancos: { 
                                required: true,
                            },
                            cuentas: { 
                                required: true,
                            },
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
		}; 
});


