<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
        <h1>Lista de Reportes</h1>
        <form action="pages/buscar-reportes.php" method="post" id="listar-Reportes" class="form">
		<fieldset>
			<legend>Reportes</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="listar_reporte">Seleccione el reporte </label>
					</td>
					<td>
						<select name="listar_reporte" id="listar_reporte">
								<option value="0">Listar socios </option>
								<option value="1">Listar intereses </option>
						</select>
					</td>
				</tr>
			</table>
		</fieldset>
		<input id="submit" type="submit" value="Aceptar" name="submit" class="boton1"/>
	</form>
<?php endif; ?>
