<?php
include("../conf/conexion.php");

$cedula = $_POST['cedula'];
$tipo = $_POST['tipo'];
$banco = $_POST['bancos'];
$cuenta = $_POST['cuentas'];
$fechas = $_POST['fecha'];
$monto = $_POST['monto'];
$deposito = $_POST['deposito'];

$fecha_split = preg_split("/\//", $fechas);
$fecha = $fecha_split[2] . '-' . $fecha_split[1] . '-' . $fecha_split[0];

$insertar_transacciones = new conexion();
$insertar_transacciones->setQuery("insert into tb_transacciones values(default, $cedula, $cuenta, $tipo, default, '" . $fecha . "' , $monto, $deposito);");

if($insertar_transacciones->getQuery()) {
	print 'La transaccion se ha creado correctamente';
} else {
	print 'La transaccion no se ha creado';
}
?>
