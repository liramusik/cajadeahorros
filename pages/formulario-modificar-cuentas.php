<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<script type="text/javascript">
		$(document).ready(function() {
			var availableTags = [
				<?php
				$listado_bancos = new connection();
				$listado_bancos->setQuery("select nombre from tb_bancos;");
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
	</script>	
	<h1>Crear Cuentas</h1>
	<form action="index.php?page=modificar-cuenta" method="post" id="crear-cuentas">
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
						<input type="text" name="cuenta" id="cuenta" maxlength="20" value="<?php print "$cuenta"; ?>" pattern="[0-9]{3,}" placeholder="Nombre del Banco" autocomplete="on" required />
						<input type="hidden" name="id_cuenta" id="id_cuenta" value="<?php print $id_cuenta; ?>" />
					</td>
				</tr>
			</table>
		</fieldset>
		<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
		<div id="message"></div>
	</form>
<?php endif; ?>
