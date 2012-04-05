<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$prestamo = $_GET['prestamo'];
	if(isset($prestamo)) {
		$x = new connection();
		$x->setQuery("update tb_solicitud_prestamo set id_estatus_solicitud_prestamo=2 where id=$prestamo;");
		if($x->getQuery()) {
			print '<div class="mensaje">El prestamo ha sido Aprobado con éxito <a href="index.php">Aceptar</a></div>';
		}
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
