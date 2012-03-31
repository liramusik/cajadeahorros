<?php
$solicitud = $_GET['solicitud'];
$x = new connection();

$x->setQuery("select tb_solicitud_prestamo.id, cedula, nombre, apellido, monto, fecha, tiempo, porcentaje, observacion, respuesta, tb_estatus_solicitud_prestamo.estatus from tb_solicitud_prestamo left join tb_estatus_solicitud_prestamo on tb_solicitud_prestamo.id_estatus_solicitud_prestamo = tb_estatus_solicitud_prestamo.id left join tb_usuarios on cedula_usuario = cedula where tb_solicitud_prestamo.id=$solicitud");
while($rows = pg_fetch_object($x->getQuery())) {
	$cedula = $rows->cedula;
	$nombre = $rows->nombre;
	$apellido = $rows->apellido;
	$monto = $rows->monto;
	$fecha = $rows->fecha;
	$tiempo = $rows->tiempo;
	$porcentaje = $rows->porcentaje;
	$observacion = $rows->observacion;
	$respuesta = $rows->respuesta;
	$estatus = $rows->estatus;
}
unset($x);
?>
