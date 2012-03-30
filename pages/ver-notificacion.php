<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$db_hostname = "localhost";
	$db_database = "db_cadeveher";
	$db_username = "user_cadeveher";
	$db_password = "123456";

	$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());

	$notificacion = $_GET['n_notificacion'];

	$query = "select fecha, asunto, mensaje, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula where id=$notificacion;";

	$result = pg_query($db_connect, $query);
	if(!$result) {
		print "Error " . pg_last_error();
	}

	while($rows = pg_fetch_object($result)) {
		$db_fecha = $rows->fecha;
		$db_asunto = $rows->asunto;
		$db_mensaje  = $rows->mensaje;
		$db_nombre = $rows->nombre;
		$db_apellido = $rows->apellido;
		$db_email = $rows->email;
	}
	?>	
	<h1>Notificación realizada a <?php print $db_nombre . " " . $db_apellido; ?></h1>
	<h2>Realizada el día <?php print date("d-m-Y", $db_fecha); ?> a las <?php print date("H:i a", $db_fecha); ?></h2>
	<div class="contenido">
		<div class="asunto">
			<h3><?php print $db_asunto; ?>
		</div>
		<div class="mensaje"><?php print $db_mensaje; ?></div>
	</div>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
