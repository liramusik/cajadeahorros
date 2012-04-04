<script type="text/javascript">
	$(document).ready(function() {
		var availableTags = [
			<?php
				while($rows = pg_fetch_object($listado_bancos->getQuery())) {
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
<form action="index.php?page=crear-cuentas" method="post" id="crear-cuentas">
	<fieldset>
		<legend>Información</legend>
		<table>
			<tr>
				<td class="etiqueta">
					<label for="nombre_banco">Nombre del banco <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="nombre_banco" id="nombre_banco" pattern="[a-zA-Z|(áéíóúñ)]{3,}" maxlength="40" placeholder="Nombre del Banco" autocomplete="on" required />
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

		</table>
	</fieldset>
	<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
	<div id="message"></div>
</form>
