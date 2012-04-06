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
		include("formulario-modificar-usuarios.php");
	} else {
		$cedula = $_POST['cedula'];
		$buscar = new connection();
		$buscar->setQuery("select nombre, apellido, telefono, direccion, email from tb_usuarios where cedula=$cedula");

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
		$post_password = $_POST['password'];
		

		$actualizar_usuarios=new connection();
		if($post_nombre != $db_nombre) {
			$actualizar_usuarios->setQuery("update tb_usuarios set nombre = '" . $post_nombre . "' where cedula=$cedula");
			if(!$actualizar_usuarios->getQuery()){
				print "<p>No se pudo modificar Nombre de usuario: $post_nombre </p>";
			} else {
				print "<p>El nombre se actualizo con exito por : $post_nombre </p>";
			}	
		}
		if ($post_apellido != $db_apellido) {
			$actualizar_usuarios->setQuery("update tb_usuarios set apellido = '" . $post_apellido . "' where cedula=$cedula");
			if(!$actualizar_usuarios->getQuery()){
				print "<p>No se pudo modificar Apellido de usuario: $post_apellido </p>";
			} else {
				print "<p>El apellido se actualizo con exito por : $post_apellido </p>";
			}	
		}
		if($post_telefono != $db_telefono) {
			$actualizar_usuarios->setQuery("update tb_usuarios set telefono = '" . $post_telefono . "' where cedula=$cedula");
			if(!$actualizar_usuarios->getQuery()){
				print "<p>No se pudo modificar Telefono de usuario: $post_telefono </p>";
			} else {
				print "<p>El telefono se actualizo con exito por : $post_telefono </p>";
			}	
		}
		if($post_email != $db_email) {
			$actualizar_usuarios->setQuery("update tb_usuarios set email = '" . $post_email . "' where cedula=$cedula");
			if(!$actualizar_usuarios->getQuery()){
				print "<p>No se pudo modificar Email de usuario: $post_email </p>";
			} else {
				print "<p>El campo email se actualizo con exito por : $post_email </p>";
			}	
		}
		if($post_direccion != $db_direccion) {
			$actualizar_usuarios->setQuery("update tb_usuarios set direccion = '" . $post_direccion . "' where cedula=$cedula");
			if(!$actualizar_usuarios->getQuery()){
				print "<p>No se pudo modificar Nombre de usuario: $post_direccion</p>";
			} else {
				print "<p>El campo nombre se actualizo con exito por : $post_direccion </p>";
			}	
		}
		if(!empty($post_password)) {
			$actualizar_usuarios->setQuery("update tb_usuarios set password = '" . md5($post_password) . "' where cedula=$cedula");
			if(!$actualizar_usuarios->getQuery()) {
				print "<p>No se pudo modificar Clave de usuario: $post_password</p>";
			} else {
				print "<p>El campo clave se actualizo con exito por : $post_password</p>";
			}
		}
		print '<div class="mensaje">Se han realizado los cambios con exito <a href="index.php">Aceptar</a></div>';
	}
?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
