<?php
$id_solicitud = $_POST['id_solicitud'];
$id_estatus =$_POST['estatus'];
$monto =$_POST['monto'];
$pago =$_POST['pago'];
$observacion =$_POST['observacion'];
$respuesta =$_POST['respuesta'];
$fecha =$_POST['fecha'];

include("../conf/conexion.php");
$x = new conexion();
$x->setQuery("update tb_solicitud_prestamo set id_estatus_solicitud_prestamo=$id_estatus, respuesta='" . $respuesta . "' where id=$id_solicitud;");
if(!$x->getQuery()) {
	print 'Error ' . pg_last_error();	
} else {
	print 'El préstamo ha sido actualizado con éxito';
}
?>
