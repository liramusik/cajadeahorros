<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	if(!isset($_POST['submit'])) {
		$x = new connection();
		$x->setQuery("select * from tb_roles;");
		$y = new connection();
		$y->setQuery("select * from tb_nacionalidad;");

		print $_SERVER['PHP_SELF'];
		include("formulario-agregar-usuarios.php");
	} elseif(isset($_POST['submit'])) {
		unset($x);
		unset($y);

		$cedula = $_POST['cédula'];
		$nombre = $_POST['nombre'];
		$apellidpo = $_POST['apellido'];

		$x = new connection();
		$x->setQuery = "";
		print '<div class="mensaje">El usuario se ha agregado correctamente <a href="index.php">Regresar</a></div>';
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
