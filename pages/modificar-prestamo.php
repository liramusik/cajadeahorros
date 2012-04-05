<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$prestamo = $_GET['prestamo'];
	$monto =$_POST['monto'];

	if(isset($cedula)) {
		$x = new connection();
		$x->setQuery("update tb_solisitud_prestamo set monto=$monto where prestamo=$prestamo;");
		if($x->getQuery()) {
			print '<div class="mensaje">El monto del prestamo ha sido modificado con éxito <a href="index.php">Aceptar</a></div>';
		}
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
