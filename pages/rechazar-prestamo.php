<?php
$id = $_POST['id'];
if(isset($id)) {
	include("../conf/conexion.php");
	$rechazar_transaccion = new conexion();
	$rechazar_transaccion->setQuery("update tb_solicitud_prestamo set id_estatus_solicitud_prestamo=3 where id=$id;");
	if(!$rechazar_transaccion->getQuery()) {
		print "Error " . pg_last_error();
	} else {
		print "La solicitud ha sido rechazada";
	}
}
?>
