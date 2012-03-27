<?php
$cedula = $_SESSION['session_cedula'];
$monto = $_POST['monto'];
$tiempo = $_POST['tiempo'];
$pago = $_POST['pago'];
$observacion = trim($_POST['observacion']);
$fecha = time();

$db_hostname = "localhost";
$db_database = "db_cadeveher";
$db_username = "user_cadeveher";
$db_password = "123456";

$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());

$query = "insert into tb_solicitud_prestamo(id_tipo_pago, cedula_usuario, monto, fecha, tiempo, observacion) values($pago, $cedula, $monto, $fecha, $tiempo, '" . $observacion . "')";

$result = pg_query($db_connect, $query);
if(!$result) {
	print "Error " . pg_last_error();
}

?>
<div class="mensaje">Su solicitud de prestamos se realizo con exito <a href="index.php">Aceptar</a></div>
