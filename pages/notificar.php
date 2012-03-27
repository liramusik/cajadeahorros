<?php if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$db_hostname = "localhost";
	$db_database = "db_cadeveher";
	$db_username = "user_cadeveher";
	$db_password = "123456";

	$cedula = trim($_GET['n_cedula']);

	$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());
	$query = "select nombre, apellido, email from tb_usuarios where cedula=$cedula";
	$result = pg_query($db_connect, $query);

	if(!$result) {
		print "Error " . pg_last_error();
	}

	while($rows = pg_fetch_object($result)) {
		$db_nombre = $rows->nombre;
		$db_apellido = $rows->apellido;
		$db_email = $rows->email;
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
