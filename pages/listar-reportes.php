<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<h1>Lista de Reportes</h1>
	<form action="pages/buscar-reporte.php" method="post" id="listar-reportes" class="form">
		<fieldset>
			<legend>Reportes</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="listar-reporte">Seleccione el reporte </label>
					</td>
					<td>
						<select name="listar-reporte" id="tipo_cuenta">
								<option value="1"> Litar socios </option>
						</select>
					</td>
				</tr>
			</table>
		</fieldset>
		<input id="submit" type="submit" value="Aceptar" name="submit" class="boton1"/>
	</form>
<?php endif; ?>