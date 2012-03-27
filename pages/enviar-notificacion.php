<?php if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$emails = preg_split("/\,/", $_POST['emails']);
	$cedulas = preg_split("/\,/", $_POST['cedulas']);
	$fecha = time();
	$asunto = $_POST['asunto'];
	$mensaje = $_POST['mensaje'];

	$db_hostname = "localhost";
	$db_database = "db_cadeveher";
	$db_username = "user_cadeveher";
	$db_password = "123456";

	$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());

	for($i = 0; $i < sizeof($cedulas) - 1; $i++) {
		$ced = $cedulas[$i];
		$querys = "insert into tb_notificaciones values(default, $ced, $fecha, '" . $asunto . "','" . $mensaje . "')";
		$results = pg_query($db_connect, $querys);
		if(!$results) {
			print "Ha ocurrido un error " . pg_last_error();
		}
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
