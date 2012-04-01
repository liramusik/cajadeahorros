<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$cedula = $_GET['cedula'];
	if(isset($cedula)) {
		$x = new connection();
		$x->setQuery("update tb_usuarios set estatus=false where cedula=$cedula;");
		if($x->getQuery()) {
			print '<div class="mensaje">El usuario ha sido deshabilitado con éxito <a href="index.php">Regresar</a></div>';
		}
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
