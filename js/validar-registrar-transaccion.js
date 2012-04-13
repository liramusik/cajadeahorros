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
		monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Séptiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		maxDate: 'Now'
	});
});
$(document).ready(function() {
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
	function mostrarRespuesta(responseText) {
		alert("Mensaje: " + responseText);
		$('.form').resetForm();
	};
	$('#crear-transaccion').submit(function(e) {
		e.preventDefault();
		var id_tipo_transaccion = $('#tipo').val();
		if((id_tipo_transaccion == 1) || (id_tipo_transaccion == 2)) {
			var id_prestamo = $('#prestamo').val();
			var hay_prestamo = $('#prestamo').length;
			if(hay_prestamo == 0 || id_prestamo == 0) {
				var opciones = {
					success: mostrarRespuesta,
				};
				$('#crear-transaccion').ajaxSubmit(opciones);
			} else {
				alert('La transacción no puede ser asociada al préstamo');
				$('#prestamo').focus();
			}
		}
		if((id_tipo_transaccion == 3) || (id_tipo_transaccion == 4)) {
			var id_prestamo = $('#prestamo').val();
			if(id_prestamo == 0) {
				alert('Por favor seleccione un préstamo');
				$('#prestamo').focus();
			} else {
				var opciones = {
					success: mostrarRespuesta,
				};
				$('#crear-transaccion').ajaxSubmit(opciones);
			}
		}
	});
});
