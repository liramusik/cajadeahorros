<?php
$id = $_POST['id'];
if(isset($id)) {
	include("../conf/conexion.php");
	$deshabilitar_cuenta = new conexion();
	$deshabilitar_cuenta->setQuery("update tb_cuentas set estatus='f' where id=$id;");
	if(!$deshabilitar_cuenta->getQuery()) {
		print 'error ' . pg_last_error();
	} else {
		print 'La cuenta ha sido deshabilitada';
	}
}
?>
