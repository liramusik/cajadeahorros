<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$id = $_GET['id'];
	$listado_bancos = new conexion();
	$listado_bancos->getListarNombreBancos();
	$buscar_banco = new conexion();
	$buscar_banco->getBuscarBancoEnCuenta($id);
	$tipo_cuentas = new conexion();
	$tipo_cuentas->getListarTipoCuentas();
	while($rows = pg_fetch_object($buscar_banco->getQuery())) {
		$id_cuenta = $rows->id;
		$nombre = $rows->nombre;
		$cuenta = $rows->cuenta;
		$id_tipo_cuenta = $rows->id_tipo_cuenta;
	}
	?>
	<script type="text/javascript">	
		$(document).ready(function(){
			$("#modificar-cuenta").validate({
				rules: {
					cuenta: {
						required: true,
						minlength: 20,
						digits: true
					}
				},
			});
		});
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
				$("#contenido").load("includes/pages.php?page=listar-cuentas");
			}; 
		}); 
		</script>	
	<h1>Modificar Cuenta</h1>
	<form action="pages/actualizar-cuenta.php" method="post" id="modificar-cuenta" class="form">
		<fieldset>
			<legend>Información</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="nombre_banco">Nombre del banco <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="nombre_banco" id="nombre_banco" maxlength="40" value="<?php print $nombre; ?>"  placeholder="Nombre del Banco" autocomplete="on" required />
						<input type="hidden" name="bancos" id="bancos" maxlength="40" value="<?php foreach($bancos as $v) { print "$v,"; } ?>" />
						<input type="hidden" name="id_cuenta" id="id_cuenta" value="<?php print $id_cuenta; ?>" />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="tipo_cuenta">Tipo de cuenta <span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="tipo_cuenta" id="tipo_cuenta">
							<?php while($rows = pg_fetch_object($tipo_cuentas->getQuery())): ?>
								<option value="<?php print $rows->id; ?>" <?php ($rows->id == $id_tipo_cuenta) ? print "selected" : print ""; ?>><?php print $rows->tipo; ?></option>
							<?php endwhile; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="cuenta">Número de cuenta <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="cuenta" id="cuenta" maxlength="20" value="<?php print $cuenta; ?>" pattern="[0-9]{3,}" placeholder="Número de cuenta" autocomplete="on" required />
					</td>
				</tr>
			</table>
		</fieldset>
            <input id="submit" type="submit" value="Actualizar" name="submit" class="boton1"/>
		<div id="message"></div>
	</form>
<?php endif; ?>
