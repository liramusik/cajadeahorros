<?php
$cedula = $_POST['cedula'];
$fecha = date("yy-m-d H:i:s", time());
if(isset($cedula)) {
	include("../conf/conexion.php");
	$deshabilitar_usuario = new conexion();
	$deshabilitar_usuario->setQuery("update tb_usuarios set estatus='f', fecha_egreso='" . $fecha . "' where cedula=$cedula;");
	if(!$deshabilitar_usuario->getQuery()) {
		print "Error " . pg_last_error();
	} else {
		print "El usuario ha sido deshabilitado";
	}
}
?>
