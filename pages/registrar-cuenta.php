<?php
include("conexion.php");
$insertar_banco = new conexion();

$array_bancos = array();
$nombre_banco = $_POST['nombre_banco'];
$tipo_cuenta = $_POST['tipo_cuenta'];
$cuenta = $_POST['cuenta'];

$array_bancos = preg_split("/\,/", $_POST['bancos']);

if(!in_array($nombre_banco, $array_bancos)) {
	$insertar_banco->setQuery("insert into tb_bancos values(default, '" . $nombre_banco . "')");
	if(!$insertar_banco->getQuery()) {
		print "No se pudo insertar el banco";
	}
	unset($insertar_banco);
}

$buscar_banco  = new conexion();
$buscar_banco->setQuery("select id from tb_bancos where nombre='" . $nombre_banco . "'");
while($rows = pg_fetch_object($buscar_banco->getQuery())) {
	$id_banco = $rows->id;
}

$buscar_cuenta = new conexion();
$buscar_cuenta->setQuery("select id, cuenta from tb_cuentas where cuenta='" . $cuenta . "' limit 1;");
if(pg_num_rows($buscar_cuenta->getQuery()) > 0) {
	while($rows = pg_fetch_object($buscar_cuenta->getQuery())) {
		if($rows->cuenta == $cuenta) {
			print "Esta cuenta ya ha sido creada";
		}
	}
} else {
	$insertar_cuenta = new conexion();
	$insertar_cuenta->setQuery("insert into tb_cuentas values(default, $id_banco, $tipo_cuenta, '" . $cuenta . "', default)");
	if(!$insertar_cuenta->getQuery()) {
		print "Se ha generado un error " . pg_last_error();
	} else {
		print "La cuenta se ha registrado exitosamente";
	}
}
?>
