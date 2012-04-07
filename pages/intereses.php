<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$bancos = new conexion();
	$bancos->getListarBancosEnCuentas();
	$cuentas = new conexion();
	$cuentas->getListarCuentas();
	?>
	<script type="text/javascript">
		var bancos = [
			<?php
			while($rows = pg_fetch_object($bancos->getQuery())) {
				print "{'id_banco':'$rows->id_banco','banco':'$rows->nombre'},";
			}
			?>
		];
		var cuentas = [
			<?php
			while($rows = pg_fetch_object($cuentas->getQuery())) {
				print "{'id_banco':'$rows->id_banco','id':'$rows->id','cuenta':'$rows->cuenta'},";
			}
			?>
		];
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
			var opciones = {
				success: mostrarRespuesta,
			};
			$('.form').ajaxForm(opciones);
			function mostrarRespuesta(responseText) {
				alert("Mensaje: " + responseText);
				$('.form').resetForm();
			}; 
        });
        $(function() {
			$("#fecha").datepicker({
                dateFormat: 'dd/mm/yy',
                    dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vier', 'Sab'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Séptiembre', 'Octubre', 'Noviembre', 'Diciembre']
			});
		});
	</script>
	<h1>Registrar Intereses</h1>
	<form action="pages/registrar-interes.php" method="post" id="registrar-interes" class="form">
		<fieldset>
			<legend>Registrar Interés</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="bancos">Banco <span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="bancos" id="bancos">
							<option></option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="cuentas">Cuentas <span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="cuentas" id="cuentas">
							<option></option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="fecha">Fecha <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="datetime" name="fecha" id="fecha" maxlength="40" placeholder="Fecha" autocomplete="on" required />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="monto">Monto <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="monto" id="monto" maxlength="7" pattern="[0-9]{3,}" placeholder="Monto" autocomplete="on" required />
					</td>
				</tr>
			</table>
		</fieldset>
		<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
		<div id="message"></div>
	</form>
<?php endif; ?>
