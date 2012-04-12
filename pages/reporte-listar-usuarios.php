<?php 
include("../conf/wkpdf.php");
include ("../conf/conexion.php");
if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)) {
	$c = new conexion();
	$c->setQuery("select cedula, nombre, apellido,  to_char(fecha_ingreso, 'DD/MM/YYYY') as fecha from tb_usuarios where id_rol = 2 or id_rol = 1 and estatus=true;");
	$x = new conexion();
	$x->setQuery("select sum(monto) as total from tb_intereses");
		while($ro = pg_fetch_object($x->getQuery())){
			$total=$ro->total;
		}
	$y = new conexion();
	$y->setQuery("select sum(monto) as capital from tb_transacciones where id_tipo_transaccion = 1 or id_tipo_transaccion = 2");
		while($ro = pg_fetch_object($y->getQuery())){
			$capital_general=$ro->capital;
		}

	$diez = $total * 0.1;
	$ochenta = $total * 0.8;


	$pdf = 
		"<style type='text/css'>"
		."table { 
			font-family:arial, sans-serif;
			font-size:11px;
			color:#333333;
			margin:0px;
		}"
		."th {
			border-bottom: 1px dashed #6699CC;
			font-size: 12px;
			font-weight: normal;
			padding: 2px 2px;
		}"
		."tr{
			padding: 2px 2px;	
		}"
		."td{
			padding: 0px 40px;	
		}"
		."h1 {
	        	color:#33170D;
	        	font-size:18px;
		}"
		."h2 {
			color:#33170D;
			font-size:12px;
			border-bottom:1px solid #FF9900;
			padding-bottom:10px;
		}"
		."h3 {
			color:#33170D;
			font-size:14px;
			border-bottom:1px solid #FF9900;
			padding-bottom:10px;
		}"

		."</style>"

		."<h1>CADEVEHER</h1>"
		."<table>"
		."<tr><td>10% Gastos de administracion:  $diez Bs. </td></tr>"
		."<tr><td>10% Reserva caja de ahorro: $diez Bs. </td></tr>"
		."<tr><td>Intereses a repartir: $ochenta Bs. </td></tr>"
		."<tr><td>Capital acumulado:  $capital_general Bs. </td></tr>"
		."</table>"
		."<h2>Listado Asociados</h2>"
	       . "<table>"
	       . "<thead>"
		       . "<tr>"
				. "<th>Nombre y  Apellido</th>"
				. "<th>fecha ingreso</th>"
				. "<th>Capital</th>"
				. "<th>Interes</th>"
				. "<th>Monto</th>"
				. "<th>Acumulado</th>"
			. "</tr>"
		. "</thead>";
		while($rows = pg_fetch_object($c->getQuery())){
			$capital = new conexion();
			$capital->getUsuarioCapital($rows->cedula);
			while($row = pg_fetch_object($capital->getQuery())){
				$interes = $capital_general / $capital;
				$interes = $interes * 100;
				$monto = $ochenta * $interes;
				$acumulado = $capital + $monto;
			$pdf.= "<tr>"
				. "<td><div>" . $rows->nombre ." " . $rows->apellido . "</div></td>"
				. "<td><div>" . $rows->fecha  . "</div></td>"
				. "<td><div>" . $row->capital  . "</div></td>"
				. "<td><div>" . $interes  . "</div></td>"
				. "<td><div>" . $monto  . "</div></td>"
				. "<td><div>" . $acumulado  . "</div></td>"
			. "</tr>";
				}
                }
                $pdf.=
	"</table>";
}

$html = $pdf;

$pdf = new WKPDF();
$pdf->set_html($html);
$pdf->render();
$pdf->output(WKPDF::$PDF_SAVEFILE, 'reporte-usuarios.pdf');
?>
