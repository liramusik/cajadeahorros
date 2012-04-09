<?php
include("../conf/conexion.php");
$cedula = $_POST['cedula'];
$id_banco = $_POST['bancos'];
$id_cuenta = $_POST['cuentas'];
$id_tipo_transaccion = $_POST['tipo'];
$id_prestamo = $_POST['prestamo'];
$fechas = $_POST['fecha'];
$monto = $_POST['monto'];
$numero_deposito = $_POST['deposito'];

$fecha_split = preg_split("/\//", $fechas);
$fecha = $fecha_split[2] . '-' . $fecha_split[1] . '-' . $fecha_split[0];

$hora = date("H:i:s", time());

$fecha .= " " . $hora;

$mes = (int) $fecha_split[1];

if($id_tipo_transaccion == 1) {
	$buscar_aporte_mensual = new conexion();
	$buscar_aporte_mensual->setQuery("select aporte_mensual from tb_usuarios where cedula=$cedula");
	while($rows = pg_fetch_object($buscar_aporte_mensual->getQuery())) {
		$aporte_mensual = $rows->aporte_mensual;
	}
	if($monto >= $aporte_mensual) {
		if($monto > $aporte_mensual) {
			$excedente = $monto - $aporte_mensual;
			$monto -= $excedente;
			$insertar_excedente = new conexion();
			$insertar_excedente->setQuery("insert into tb_transacciones values(default, $cedula, $id_cuenta, 5, 1, '" . $fecha . "', $excedente, '" . $numero_deposito . "')");
		}
		$insertar_transaccion = new conexion();
		$insertar_transaccion->setQuery("insert into tb_transacciones values(default, $cedula, $id_cuenta, 1, 1, '" . $fecha . "', $monto, '" . $numero_deposito . "')");
	} else {
		print "El monto que usted desea registrar es inferior al aporte mensual establecido";
	}
	print "Se ha registrado con éxito la transacción. Esperando confirmación";
}

if($id_tipo_transaccion == 2) {
	if($mes < 2) {
		$insertar_transaccion = new conexion();
		$insertar_transaccion->setQuery("insert into tb_transacciones values(default, $cedula, $id_cuenta, 2, 1, '" . $fecha . "', $monto, '" . $numero_deposito . "')");
		print "Se ha registrado con éxito la transacción. Esperando confirmación";
	} else {
		print "No se puede registrar el aporte especial";
	}
}

if($id_tipo_transaccion == 3) {
	$insertar_transaccion = new conexion();
	$insertar_transaccion->setQuery("insert into tb_transacciones values(default, $cedula, $id_cuenta, 3, 1, '" . $fecha . "', $monto, '" . $numero_deposito . "')");

	$buscar_id_transaccion = new conexion();
	$buscar_id_transaccion->setQuery("select id from tb_transacciones where cedula_usuario=$cedula order by id desc limit 1");

	while($rows = pg_fetch_object($buscar_id_transaccion->getQuery())) {
		$id_transaccion = $rows->id;
	}

	$insertar_prestamo = new conexion();
	$insertar_prestamo->setQuery("insert into tb_prestamo values($id_prestamo, $id_transaccion)");
	if(!$insertar_prestamo) {
		print "Error " . pg_last_error();
	} else {
		print "La cuota del préstamo ha sido registrada. Esperando confirmación";
	}
}
?>
