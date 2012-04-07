<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$listado_bancos = new conexion();
	$listado_bancos->getListarNombreBancos();
	$tipo_cuentas = new conexion();
	$tipo_cuentas->getListarTipoCuentas();
	?>

	<script type="text/javascript">
		$(document).ready(function() {
			var availableTags = [
				<?php
				$bancos = array();
				while($rows = pg_fetch_object($listado_bancos->getQuery())) {
					$bancos[] = $rows->nombre;
					print "\"$rows->nombre\",\n";
				}
				?>
			];
			$("#nombre_banco").autocomplete({
				source: availableTags
			});
		});
		$(document).ready(function(){
			$("#crear-cuentas").validate({
				rules: {
					nombre_banco: {
						required: true,
						minlength: 3,
					},
					cuenta: {
						required: true,
						minlength: 20,
						digits: true
					}
				},
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
	</script>	

	<h1>Añadir Cuentas</h1>
	<form action="pages/registrar-cuenta.php" method="post" id="crear-cuentas" class="form">
		<fieldset>
			<legend>Información</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="nombre_banco">Nombre del banco <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="nombre_banco" id="nombre_banco" maxlength="40" placeholder="Nombre del Banco" autocomplete="on" required />
						<input type="hidden" name="bancos" id="bancos" maxlength="40" value="<?php foreach($bancos as $v) { print "$v,"; } ?>" />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="tipo_cuenta">Tipo de cuenta <span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="tipo_cuenta" id="tipo_cuenta">
							<?php while($rows = pg_fetch_object($tipo_cuentas->getQuery())): ?>
								<option value="<?php print $rows->id; ?>" <?php ($rows->id == 1) ? print "selected" : print ""; ?>><?php print $rows->tipo; ?></option>
							<?php endwhile; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="cuenta">Número de cuenta <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="cuenta" id="cuenta" maxlength="20" pattern="[0-9]{3,}" placeholder="Número de cuenta" autocomplete="on" required />
					</td>
				</tr>
			</table>
		</fieldset>
		<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
	</form>
<?php endif; ?>
