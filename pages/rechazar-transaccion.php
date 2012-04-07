<?php
$id = $_POST['id'];
if(isset($id)) {
	include("../conf/conexion.php");
	$rechazar_transaccion = new conexion();
	$rechazar_transaccion->setQuery("update tb_transacciones set id_estatus_transaccion=3 where id=$id;");
	if(!$rechazar_transaccion->getQuery()) {
		print "Error " . pg_last_error();
	} else {
		print "La transaccion ha sido rechazada";
	}
}
?>
