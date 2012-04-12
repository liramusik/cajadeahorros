<?php
include("../conf/conexion.php");
$tipo = $_POST['tipo'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$nacionalidad = $_POST['nacionalidad'];
$cedula = $_POST['cedula'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];
if(isset($_POST['aporte_mensual'])) {
	$aporte_mensual = $_POST['aporte_mensual'];
} else {
	$aporte_mensual = 0;
}
$fecha_ingreso = $_POST['fecha_ingreso'];
$usuario = $_POST['usuario'];
$password = md5($_POST['password']);

$fecha_split = preg_split("/\//", $fecha_ingreso);
$fecha = $fecha_split[2] . '-' . $fecha_split[1] . '-' . $fecha_split[0];

$hora = date("H:i:s", time());

$fecha .= " " . $hora;

$buscar = new conexion();
$buscar->setQuery("select cedula from tb_usuarios where cedula=$cedula");
$rows = pg_num_rows($buscar->getQuery());
if($rows > 0) {
	print "Error, el usuario ya existe";
} else {
	$x = new conexion();
	$x->setQuery("insert into tb_usuarios values($cedula, $nacionalidad, $tipo, '" . $nombre . "', '" . $apellido . "', '" . $telefono . "', '" . $email . "', '" . $direccion . "', $aporte_mensual, '" . $fecha . "', null, '" . $usuario . "', '" . $password . "', default);");

	if($x->getQuery()) {
		print 'El usuario se ha agregado correctamente';
	} else {
		print 'El usuario no se ha agregado';
	}
}

?>
