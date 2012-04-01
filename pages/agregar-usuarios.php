<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	if(!isset($_POST['submit'])) {
		$x = new connection();
		$x->setQuery("select * from tb_roles;");
		$y = new connection();
		$y->setQuery("select * from tb_nacionalidad;");

		print $_SERVER['PHP_SELF'];
		include("formulario-agregar-usuarios.php");
	} else {
		unset($x);
		unset($y);

		$tipo = $_POST['tipo'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$nacionalidad = $_POST['nacionalidad'];
		$cedula = $_POST['cedula'];
		$telefono = $_POST['telefono'];
		$email = $_POST['email'];
		$direccion = $_POST['direccion'];
		$fecha_ingreso = $_POST['fecha_ingreso'];
		$usuario = $_POST['usuario'];
		$password = md5($_POST['password']);

		$fecha_split = preg_split("/\//", $fecha_ingreso);
		$fecha = $fecha_split[2] . '-' . $fecha_split[0] . '-' . $fecha_split[1];

		$hora = date("H:i:s", time());

		$fecha .= " " . $hora;

		$x = new connection();
		$x->setQuery("insert into tb_usuarios values($cedula, $nacionalidad, $tipo, '" . $nombre . "', '" . $apellido . "', '" . $telefono . "', '" . $email . "', '" . $direccion . "', '" . $fecha . "', null, '" . $usuario . "', '" . $password . "', default);");

		if($x->getQuery()) {
			print '<div class="mensaje">El usuario se ha agregado correctamente <a href="index.php">Regresar</a></div>';
		}
		unset($x);
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
