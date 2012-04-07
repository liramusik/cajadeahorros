<?php
$cedula = $_POST['cedula'];
$monto = $_POST['monto'];
$tiempo = $_POST['tiempo'];
$tipo_pago = $_POST['tipo_pago'];
$porcentaje = $_POST['porcentaje'];
$observacion = trim($_POST['observacion']);
$fecha = date("Y-m-d", time());

include("../conf/conexion.php");

$registrar_solicitud = new conexion();
$registrar_solicitud->setQuery("insert into tb_solicitud_prestamo values(default, default, $tipo_pago, $cedula, $monto, '" . $fecha . "', $tiempo, $porcentaje,'" . $observacion . "')");

if(!$registrar_solicitud->getQuery()) {
	print "Error " . pg_last_error();
} else {
	print "La solicitud se ha registrado";
}

?>
