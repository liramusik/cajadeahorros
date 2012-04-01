<?php
$cedula = $_SESSION['session_cedula'];
$monto = $_POST['monto'];
$tiempo = $_POST['tiempo'];
$pago = $_POST['pago'];
$porcentaje = $_POST['porcentaje'];
$observacion = trim($_POST['observacion']);
$fecha = date("Y-m-d", time());

$c->setQuery("insert into tb_solicitud_prestamo values(default, default, $pago, $cedula, $monto, '" . $fecha . "', $tiempo, $porcentaje,'" . $observacion . "')");

if($c->getQuery()) {
	print '<div class="mensaje">Su solicitud de prestamos se realizo con exito <a href="index.php">Aceptar</a></div>';
}

?>
