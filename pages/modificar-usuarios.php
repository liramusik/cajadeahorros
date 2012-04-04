<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	if(!isset($_POST['submit'])) {
		
		$cedula = $_GET['cedula'];

		$c->setQuery("select cedula, nombre, apellido, telefono, email, direccion, to_char(fecha_ingreso, 'DD/MM/YYYY') as fecha_ingreso, to_char(fecha_egreso, 'DD/MM/YYYY') as fecha_egreso, nacionalidad, id_rol, usuario from tb_usuarios left join tb_nacionalidad on id_nacionalidad = tb_nacionalidad.id left join tb_roles on id_rol = tb_roles.id where cedula=$cedula");

		$x = new connection();
		$x->setQuery("select * from tb_roles");

		while($rows = pg_fetch_object($c->getQuery())) {
			$cedula = $rows->cedula;
			$nombre = $rows->nombre;
			$apellido = $rows->apellido;
			$telefono = $rows->telefono;
			$email = $rows->email;
			$direccion = $rows->direccion;
			$fecha_ingreso = $rows->fecha_ingreso;
			$fecha_egreso = $rows->fecha_egreso;
			$nacionalidad = $rows->nacionalidad;
			$id_rol = $rows->id_rol;
			$usuario = $rows->usuario;
		}
	} else {
		
		$buscar = new connection();
		$buscar->setQuery("select nombre, apellido, telefono, direccion, email from tb_usuarios");

		while($rows = pg_fetch_object($buscar->getQuery())) {
			$db_nombre = $rows->nombre;
			$db_apellido = $rows->apellido;
			$db_telefono = $rows->telefono;
			$db_email = $rows->email;
			$db_direccion = $rows->direccion;
		}

		$post_nombre = $_POST['nombre'];
		$post_apellido = $_POST['apellido'];
		$post_telefono = $_POST['telefono'];
		$post_email = $_POST['email'];
		$post_direccion = $_POST['direccion'];

		if($post_nombre == $db_nombre){
		
		}

}

	
	?>
	<?php
	if(($_SESSION['session_id_rol'] == 1) || ($_SESSION['session_cedula'] == $cedula)) {
		include("formulario-modificar-usuarios.php");
	} else {
		print '<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>';
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
