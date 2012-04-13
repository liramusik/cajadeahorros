<script type="text/javascript">
	$(document).ready(function() { 
		$('#listar-reportes').submit(function(e) {
			e.preventDefault();
			var val = $('#reportes').attr('value');
			url = 'pages/reportes/'+val+'.php';;
			//$(location).attr('href', url);
			window.open(url, '_BLANK');
		});
	});
</script>

<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<h1>Lista de Reportes</h1>
	<form action="#" method="post" id="listar-reportes" class="form">
		<fieldset>
			<legend>Reportes</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="listar-reporte">Seleccione el reporte </label>
					</td>
					<td>
						<select name="listar-reporte" id="reportes">
							<option value="reporte-listar-usuarios">Listar Usuarios</option>
						</select>
					</td>
				</tr>
			</table>
		</fieldset>
		<input id="submit" type="submit" value="Aceptar" name="submit" class="boton1"/>
	</form>
<?php endif; ?>
