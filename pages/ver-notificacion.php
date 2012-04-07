<?php
$id = $_GET['id'];

$buscar_notificacion = new conexion();
$buscar_notificacion->setQuery("select to_char(fecha, 'DD/MM/YYYY-HH:MI a.m.') as fecha, asunto, mensaje, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula where id=$id;");

while($rows = pg_fetch_object($buscar_notificacion->getQuery())) {
	$fecha = $rows->fecha;
	$asunto = $rows->asunto;
	$mensaje  = $rows->mensaje;
	$nombre = $rows->nombre;
	$apellido = $rows->apellido;
	$email = $rows->email;
}
$fecha = preg_split("/-/", $fecha);
?>
<h1>Notificación realizada a <?php print $nombre . " " . $apellido; ?></h1>
<h2>Realizada el día <?php print $fecha[0]; ?> a las <?php print $fecha[1]; ?></h2>
<div class="contenido">
	<div class="asunto">
		<h3><?php print $asunto; ?>
	</div>
	<div class="mensaje"><?php print $mensaje; ?></div>
</div>
