<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$cuenta = $_GET['cuenta'];
	if(isset($cuenta)) {
		$x = new connection();
		$x->setQuery("update tb_cuentas set estatus='f' where id=$cuenta;");
		if($x->getQuery()) {
			print '<div class="mensaje">La cuenta ha sido deshabilitado con éxito <a href="index.php">Aceptar</a></div>';
		}
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
