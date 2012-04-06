<?php
$cedula = $_POST['cedula'];

include("../conf/conexion.php");
$buscar = new conexion();
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

$actualizar_usuarios=new conexion();

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
?>
