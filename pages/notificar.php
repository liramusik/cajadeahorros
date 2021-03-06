<?php if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	if(isset($_GET['cedula'])) { $cedula = $_GET['cedula']; }
	if($cedula != "all") {
		$buscar_usuario = new conexion();
		$buscar_usuario->getBuscarUsuario($cedula);
		while($rows = pg_fetch_object($buscar_usuario->getQuery())) {
			$nombre = $rows->nombre;
			$apellido = $rows->apellido;
			$cedulas[] = $rows->cedula;
			$emails[] = $rows->email;
		}
	} else {
		$buscar_usuarios = new conexion();
		$buscar_usuarios->getBuscarUsuarios();
		while($rows = pg_fetch_object($buscar_usuarios->getQuery())) {
			$cedulas[] = $rows->cedula;
			$emails[] = $rows->email;
		}
	}
	?>

	<script type="text/javascript" src="/cajadeahorros/js/validar-enviar-notificaciones.js">
	</script>
	<h1>Notificaciones</h1>
	<form action="pages/registrar-notificacion.php" method="post" id="notificar" class="form">
		<fieldset>
			<legend>Notificar Usuario</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="destinatarios">Destinatario</label>
					</td>
					<td>
						<?php if(isset($cedula) and ($cedula == 'all')): ?>
							<p>Todos<p/>
						<?php else: ?>
							<p><?php print $nombre . " " . $apellido; ?></p>
						<?php endif; ?>
						<input type="hidden" name="cedulas" value="<?php foreach($cedulas as $v) { print "$v,"; } ?>" />
						<input type="hidden" name="emails" value="<?php foreach($emails as $v) { print "$v,"; } ?>" />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="asunto">Asunto</label>
					</td>
					<td>
						<input type="text" id="asunto" name="asunto" />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="mensaje">Mensaje</label>
					</td>
					<td>
						<textarea name="mensaje" id="mensaje" cols="40" rows="5" maxlength="250"></textarea>
					</td>
				</tr>

			</table>
		</fieldset>
		<input class="boton1" type="submit" value="Enviar" />
	</form>

<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
