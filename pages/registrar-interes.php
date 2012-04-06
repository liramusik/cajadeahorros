<?php
include("conexion.php");

$cuentas = $_POST['cuentas'];
$fecha = $_POST['fecha'];
$monto = $_POST['monto'];

$fecha_split = preg_split("/\//", $fecha);
$fecha = $fecha_split[2] . '-' . $fecha_split[1] . '-' . $fecha_split[0];

$hora = date("H:i:s", time());

$fecha .= " " . $hora;

$interes = new conexion();
$interes->setQuery("insert into tb_intereses values(default, $cuentas, '" . $fecha . "', $monto)");
if(!$interes->getQuery()) {
	print 'Ha ocurrido un error inesperado' . pg_last_error();
} else {
	print 'La inserción se ha realizado con éxito</div>';
}
unset($interes);
?>
