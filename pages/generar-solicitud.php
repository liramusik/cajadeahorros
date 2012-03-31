<?php
$cedula = $_SESSION['session_cedula'];
$monto = $_POST['monto'];
$tiempo = $_POST['tiempo'];
$pago = $_POST['pago'];
$observacion = trim($_POST['observacion']);
$fecha = date("Y-m-d", time());
$c->setQuery("insert into tb_solicitud_prestamo(id_tipo_pago, cedula_usuario, monto, fecha, tiempo, observacion) values($pago, $cedula, $monto, '" . $fecha . "', $tiempo, '" . $observacion . "')");

?>
<div class="mensaje">Su solicitud de prestamos se realizo con exito <a href="index.php">Aceptar</a></div>
