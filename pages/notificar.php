<?php if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$db_hostname = "localhost";
	$db_database = "db_cadeveher";
	$db_username = "user_cadeveher";
	$db_password = "123456";

	$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());

	$cedula = trim($_GET['n_cedula']);

	if(isset($cedula) and ($cedula == 'all')) {
		$query = "select cedula, nombre, apellido, email from tb_usuarios where estatus=true";
	} elseif($cedula != 'all') {
		$query = "select cedula, nombre, apellido, email from tb_usuarios where cedula=$cedula";
	}
	$result = pg_query($db_connect, $query);

	if(!$result) {
		print "Error " . pg_last_error();
	}

	while($rows = pg_fetch_object($result)) {
		$db_cedula[] = $rows->cedula = $rows->cedula;;
		$db_nombre[] = $rows->nombre;
		$db_apellido[] = $rows->apellido;
		$db_email[] = $rows->email;
	}
	?>
	<h1>Notificaciones</h1>
	<form action="index.php?page=enviar-notificacion" method="post" id="notificar">
		<fieldset>
			<legend>Solicitud de Préstamo</legend>
			<table>
				<tr>
					<td>
						<label for="destinatarios">Destinatarios</label>
					</td>
					<td>
						<?php if(isset($cedula) and ($cedula == 'all')): ?>
							<p>Todos<p/>
						<?php elseif($cedula != 'all'): ?>
							<p><?php print $db_nombre[0] . " " . $db_apellido[0]; ?></p>
						<?php endif; ?>
						<input type="hidden" name="cedulas" value="<?php foreach($db_cedula as $v) { print "$v,"; } ?>" />
						<input type="hidden" name="emails" value="<?php foreach($db_email as $v) { print "$v,"; } ?>" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="asunto">Asunto</label>
					</td>
					<td>
						<input type="text" name="asunto" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="mensaje">Mensaje</label>
					</td>
					<td>
						<textarea name="mensaje" maxlength="250"></textarea>
					</td>
				</tr>

			</table>
		</fieldset>
		<input class="boton1" type="submit" value="Enviar" />
	</form>

<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
