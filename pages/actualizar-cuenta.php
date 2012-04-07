<?php
$id_cuenta = $_POST['id_cuenta'];

include("../conf/conexion.php");

$buscar = new conexion();
$buscar->setQuery("select id_banco, id_tipo_cuenta, cuenta from tb_cuentas where id=$id_cuenta");

while($rows = pg_fetch_object($buscar->getQuery())) {
	$db_id_banco = $rows->id_banco;
	$db_tipo_cuenta = $rows->id_tipo_cuenta;
	$db_cuenta = $rows->cuenta;
}

$array_bancos = array();
$post_nombre_banco = $_POST['nombre_banco'];
$post_tipo_cuenta = $_POST['tipo_cuenta'];
$post_cuenta = $_POST['cuenta'];

$array_bancos = preg_split("/\,/", $_POST['bancos']);

if(!in_array($post_nombre_banco, $array_bancos)) {
	$actualizar_banco = new conexion();
	$actualizar_banco->setQuery("update tb_bancos set nombre='" . $post_nombre_banco . "' where id=$db_id_banco;");
	if(!$actualizar_banco->getQuery()) {
		print "Error " . pg_last_error();
	} else {
		print "La cuenta ha sido actualizada";
	}
}
unset($actualizar_banco);

if(($db_cuenta != $post_cuenta) || ($db_tipo_cuenta !=$post_tipo_cuenta)) { 
	$actualizar = new conexion();
	$actualizar->setQuery("update tb_cuentas set cuenta='" . $post_cuenta . "', id_tipo_cuenta=$post_tipo_cuenta where id=$id_cuenta");
	if(!$actualizar->getQuery()) {
	       print "No se pudo modificar la cuenta " . pg_last_error();
	} else {
		print "La cuenta ha sido actualizada";
	}
}
?>
