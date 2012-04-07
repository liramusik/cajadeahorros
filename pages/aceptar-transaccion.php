<?php
$id = $_POST['id'];
if(isset($id)) {
	include("../conf/conexion.php");
	$aceptar_transaccion = new conexion();
	$aceptar_transaccion->setQuery("update tb_transacciones set id_estatus_transaccion=2 where id=$id;");
	if(!$aceptar_transaccion->getQuery()) {
		print "Error " . pg_last_error();
	} else {
		print "La transaccion ha sido aceptada";
	}
}
?>
