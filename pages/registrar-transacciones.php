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

/*
 * Me traigo toda la información del préstamo
 */
$buscar_detalle_prestamo = new conexion();
$buscar_detalle_prestamo->getDetallePrestamo($id_prestamo);
while($rows = pg_fetch_object($buscar_detalle_prestamo->getQuery())) {
	$dp_tipo_pago = $rows->id_tipo_pago;
	$dp_monto = $rows->monto;
	$dp_fecha = $rows->fecha;
	$dp_tiempo = $rows->tiempo;
	$dp_porcentaje = $rows->porcentaje;
	$dp_id_estatus = $rows->id_estatus_solicitud_prestamo;
}
unset($buscar_detalle_prestamo);

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

if(($id_tipo_transaccion == 3) && ($dp_id_estatus == 2)) {
	/*
	 * Cuenta el total de las depósitos cuyos estatus deben ser de tipo 2 (aprobado) de x préstamo.
	 */
	$buscar_total_transacciones = new conexion();
	$buscar_total_transacciones->getTotalCuotas($id_prestamo);
	$filas = pg_num_rows($buscar_total_transacciones->getQuery());
	if($filas > 0) {
		while($rows = pg_fetch_object($buscar_total_transacciones->getQuery())) {
			$total_transacciones = $rows->total;
		}
	}
	unset($buscar_total_transacciones);

	/*
	 * Si el total de depósitos es menor al tiempo de pago entonces deposito
	 */
	if($total_transacciones <= $dp_tiempo) {
		$monto_depositar = getMontoPagar($dp_tipo_pago, $dp_monto, $dp_tiempo, $dp_porcentaje);
		/*
		 * Si el monto a depositar es mayor a la cuota del préstamo entonces deposito el excedente
		 */
		if($monto > $monto_depositar) {
			$excedente = $monto - $monto_depositar;
			$monto -= $excedente;
			$insertar_excedente = new conexion();
			$insertar_excedente->setQuery("insert into tb_transacciones values(default, $cedula, $id_cuenta, 5, 1, '" . $fecha . "', $excedente, '" . $numero_deposito . "')");
		}
		$insertar_transaccion = new conexion();
		$insertar_transaccion->setQuery("insert into tb_transacciones values(default, $cedula, $id_cuenta, 3, 1, '" . $fecha . "', $monto, '" . $numero_deposito . "')");

		/*
		 * Inserto también en la tabla préstamo
		 */
		$buscar_id_transaccion = new conexion();
		$buscar_id_transaccion->setQuery("select id from tb_transacciones where cedula_usuario=$cedula order by id desc limit 1");

		$filas = pg_num_rows($buscar_id_transaccion->getQuery());
		if($filas > 0) {
			while($rows = pg_fetch_object($buscar_id_transaccion->getQuery())) {
				$id_transaccion = $rows->id;
			}
			$insertar_prestamo = new conexion();
			$insertar_prestamo->setQuery("insert into tb_prestamo values($id_prestamo, $id_transaccion)");
		}
		if($total_transacciones == $dp_tiempo) {
			$actualizar_estatus_prestamo = new conexion();
			$actualizar_estatus_prestamo->setQuery("update tb_solicitud_prestamo set id_estatus_solicitud_prestamo=4 where id=$id_prestamo;");
		}
	}
	print "La cuota del préstamo ha sido registrada. Esperando confirmación";
}

if($id_tipo_transaccion == 4) {
	$insertar_transaccion = new conexion();
	$insertar_transaccion->setQuery("insert into tb_transacciones values(default, $cedula, $id_cuenta, 4, 1, '" . $fecha . "', $monto, '" . $numero_deposito . "')");

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

function getMontoPagar($p_tipo_pago, $p_monto, $p_tiempo, $p_porcentaje) {
	if($p_tipo_pago == 1) {
		$monto_pagar = ($p_monto * $p_porcentaje) / 100;
	}
	if($p_tipo_pago == 2) {
		$prestamo[0] = $p_monto;
		$amortizacion = ($p_monto / $p_tiempo);
		$total_intereses = 0;
		for($i = 1; $i <= $p_tiempo; $i++) {
			$prestamo[$i] = $prestamo[$i-1] - $amortizacion;
			$interes[$i] = (($prestamo[$i-1] * $p_porcentaje) / 100);
			$total_intereses += $interes[$i];
		}   
		$interes[0] = $total_intereses / $p_tiempo;
		$monto_pagar = ($p_monto + $total_intereses) / $p_tiempo;
	}
	return $monto_pagar;
}

?>
