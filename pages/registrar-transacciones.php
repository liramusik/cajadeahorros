<?php
include("../conf/conexion.php");

$cedula = $_POST['cedula'];
$tipo = $_POST['tipo'];
$banco = $_POST['bancos'];
$cuenta = $_POST['cuentas'];
$fechas = $_POST['fecha'];
$monto = $_POST['monto'];
$deposito = $_POST['deposito'];

$fecha_split = preg_split("/\//", $fechas);
$fecha = $fecha_split[2] . '-' . $fecha_split[1] . '-' . $fecha_split[0];

if($tipo == 1) {
	$buscar = new conexion();
	$buscar->setQuery("select aporte_mensual from tb_usuarios where cedula=$cedula");
	while($rows = pg_fetch_object($buscar->getQuery())) {
	 	$aporte = $rows->aporte_mensual;
	}
			
	if($monto >= $aporte) {		
		$excedente = $monto - $aporte;
		$monto = $monto - $excedente;
		if($excedente > 0) { 
			$insertar_excedente = new conexion();
			$insertar_excedente->setQuery("insert into tb_transacciones values(default, $cedula, $cuenta, 5, default, '" . $fecha . "', $excedente, $deposito);");
		}
		$insertar_transacciones = new conexion();
		$insertar_transacciones->setQuery("insert into tb_transacciones values(default, $cedula, $cuenta, $tipo, default, '" . $fecha . "' , $monto, $deposito);");
		print 'El deposito se ha realizado con exito';
	} else {
		print 'El deposito no se a realizado es menor que el aporte';	
	}
}
?>
