<?php
$cedula = $_POST['cedula'];
if(isset($cedula)) {
	include("../conf/conexion.php");
	$deshabilitar_usuario = new conexion();
	$deshabilitar_usuario->setQuery("update tb_usuarios set estatus='f' where cedula=$cedula;");
	if(!$deshabilitar_usuario->getQuery()) {
		print "Error " . pg_last_error();
	} else {
		print "El usuario ha sido deshabilitado";
	}
}
?>
