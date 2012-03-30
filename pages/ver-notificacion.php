<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$notificacion = $_GET['notificacion'];

	$c->setQuery("select fecha, asunto, mensaje, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula where id=$notificacion;");

	while($rows = pg_fetch_object($n->getQuery())) {
		$db_fecha = $rows->fecha;
		$db_asunto = $rows->asunto;
		$db_mensaje  = $rows->mensaje;
		$db_nombre = $rows->nombre;
		$db_apellido = $rows->apellido;
		$db_email = $rows->email;
	}
	?>	
	<h1>Notificación realizada a <?php print $db_nombre . " " . $db_apellido; ?></h1>
	<h2>Realizada el día <?php print date("d-m-Y", $db_fecha); ?> a las <?php print date("H:i a", $db_fecha); ?></h2>
	<div class="contenido">
		<div class="asunto">
			<h3><?php print $db_asunto; ?>
		</div>
		<div class="mensaje"><?php print $db_mensaje; ?></div>
	</div>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
