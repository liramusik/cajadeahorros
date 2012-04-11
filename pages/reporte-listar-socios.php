<?php 
include("../conf/wkpdf.php");
if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)) {
	$c = new conexion();
	$c->setQuery("select cedula, nombre, apellido,  to_char(fecha_ingreso, 'DD/MM/YYYY') as fecha from tb_usuarios where id_rol = 2 or id_rol = 1 and estatus=true;");
        $i++;

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
		."<h2>Listado Asociados</h2>"
	       . "<table>"
	       . "<thead>"
		       . "<tr>"
				. "<th>Nombre y  Apellido</th>"
				. "<th>fecha ingreso</th>"
				. "<th>Capital</th>"
			. "</tr>"
		. "</thead>";
		while($rows = pg_fetch_object($c->getQuery())){
			$capital = new conexion();
			$capital->getUsuarioCapital($rows->cedula);
				while($row = pg_fetch_object($capital->getQuery())){
			$pdf.= "<tr>"
				. "<td><div>" . $i++ . " " . $rows->nombre ." " . $rows->apellido . "</div></td>"
				. "<td><div>" . $rows->fecha  . "</div></td>"
				. "<td><div>" . $row->capital  . "</div></td>"
				. "<td><div>" . $rows->interes  . "</div></td>"
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
$pdf->output(WKPDF::$PDF_SAVEFILE, 'reporte-asociados.pdf');
?>
