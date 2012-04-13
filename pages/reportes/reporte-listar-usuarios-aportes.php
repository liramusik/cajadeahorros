<?php 

include("../../conf/wkpdf.php");

if(!isset($listar_usuarios)) {
	include("../../conf/conexion.php");
}

$listar_usuarios = new conexion();
$listar_usuarios->setQuery("select nacionalidad, cedula, nombre, apellido, sum(monto) as total from tb_transacciones left join tb_usuarios on tb_transacciones.cedula_usuario=tb_usuarios.cedula left join tb_nacionalidad on tb_nacionalidad.id = tb_usuarios.id_nacionalidad where id_estatus_transaccion=2 and (id_rol=1 or id_rol=2 and estatus=true) group by nacionalidad, cedula;");
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

	."<h1>Listado Asociados</h1>"
       . "<table>"
       . "<thead>"
	       . "<tr>"
			. "<th>Cédula</th>"
			. "<th>Nombre y Apellido</th>"
			. "<th>Aporte</th>"
		. "</tr>"
	. "</thead>";
	while($rows = pg_fetch_object($listar_usuarios->getQuery())) {
		$pdf .= "<tr>"
		. "<td><div>" . $rows->nacionalidad . ".-" . $rows->cedula . "</div></td>"
		. "<td><div>" . $rows->nombre . " " . $rows->apellido . "</div></td>"
		. "<td><div>" . $rows->total . "</div></td>"
		. "</tr>";
	}
	$pdf.=
"</table>";

$html = $pdf;

$pdf = new WKPDF();
$pdf->set_html($html);
$pdf->render();
$pdf->output(WKPDF::$PDF_SAVEFILE, 'reporte-listar-usuarios-aportes.pdf');
print '<meta http-equiv="refresh" content="0; url=/tmp/reporte-listar-usuarios-aportes.pdf">';
?>
