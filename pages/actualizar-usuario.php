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
$aporte_mensual = $_POST['aporte_mesual'];
$post_password = $_POST['password'];

$actualizar_usuarios=new conexion();

if(empty($post_password)) {
	$actualizar_usuarios->setQuery("update tb_usuarios set nombre='" . $post_nombre . "', apellido='" . $post_apellido . "', telefono='" . $post_telefono . "',  email = '" . $post_email . "', direccion = '" . $post_direccion . "' where cedula=$cedula");
	if(!$actualizar_usuarios->getQuery()){
		print "No se pudo modificar el usuario";
	} else {
		print "El usuario se actualizo con exito";
	}	
} else {
	$actualizar_usuarios->setQuery("update tb_usuarios set nombre='" . $post_nombre . "', apellido='" . $post_apellido . "', telefono='" . $post_telefono . "',  email = '" . $post_email . "', direccion = '" . $post_direccion . "', aporte_mensual=$aporte_mensual, password='" . md5($post_password) . "' where cedula=$cedula");
	if(!$actualizar_usuarios->getQuery()) {
		print "No se pudo modificar el  usuario";
	} else {
		print "El usuario se actualizo con exito";
	}
}
?>
