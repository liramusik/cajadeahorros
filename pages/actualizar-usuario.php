<?php
$cedula = $_POST['cedula'];

include("../conf/conexion.php");
$buscar = new conexion();

$post_tipo = $_POST['tipo'];
$post_nombre = $_POST['nombre'];
$post_apellido = $_POST['apellido'];
$post_telefono = $_POST['telefono'];
$post_email = $_POST['email'];
$post_direccion = $_POST['direccion'];
$post_password = $_POST['password'];
if(isset($_POST['aporte_mensual'])) {
	$aporte_mensual = $_POST['aporte_mensual'];
} else {
	$aporte_mensual = 0;
}
$actualizar_usuarios=new conexion();

if(empty($post_password)) {
	$actualizar_usuarios->setQuery("update tb_usuarios set id_rol=tipo, aporte_mensual=$aporte_mensual, nombre='" . $post_nombre . "', apellido='" . $post_apellido . "', telefono='" . $post_telefono . "',  email = '" . $post_email . "', direccion = '" . wordwrap($post_direccion) . "' where cedula=$cedula");
	if(!$actualizar_usuarios->getQuery()){
		print "No se pudo modificar el usuario";
	} else {
		print "El usuario se actualizo con éxito";
	}	
} else {
	$actualizar_usuarios->setQuery("update tb_usuarios set nombre='" . $post_nombre . "', apellido='" . $post_apellido . "', telefono='" . $post_telefono . "',  email = '" . $post_email . "', direccion = '" . $post_direccion . "', password='" . md5($post_password) . "' where cedula=$cedula");
	if(!$actualizar_usuarios->getQuery()) {
		print "No se pudo modificar el  usuario";
	} else {
		print "El usuario se actualizo con éxito";
	}
}
?>
