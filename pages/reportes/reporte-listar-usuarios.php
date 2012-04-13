<?php 

include("../../conf/wkpdf.php");

if(!isset($listar_usuarios)) {
	include("../../conf/conexion.php");
}

$listar_usuarios = new conexion();
$listar_usuarios->setQuery("select nacionalidad, cedula, nombre, apellido, descripcion, aporte_mensual, to_char(fecha_ingreso, 'DD/MM/YYYY') as fecha_in, to_char(fecha_ingreso, 'DD/MM/YYYY') as fecha_out, estatus from tb_usuarios left join tb_nacionalidad on tb_usuarios.id_nacionalidad = tb_nacionalidad.id left join tb_roles on tb_usuarios.id_rol = tb_roles.id;");
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
			. "<th>Tipo de Usuario</th>"
			. "<th>Aporte Mensual</th>"
			. "<th>Fecha de Ingreso</th>"
			. "<th>Fecha de Egreso</th>"
			. "<th>Estatus</th>"
		. "</tr>"
	. "</thead>";
	while($rows = pg_fetch_object($listar_usuarios->getQuery())) {
		$pdf .= "<tr>"
		. "<td><div>" . $rows->nacionalidad . ".-" . $rows->cedula . "</div></td>"
		. "<td><div>" . $rows->nombre . " " . $rows->apellido . "</div></td>"
		. "<td><div>" . $rows->descripcion . "</div></td>"
		. "<td><div>" . $rows->aporte_mensual . "</div></td>"
		. "<td><div>" . $rows->fecha_in . "</div></td>"
		. "<td><div>" . $rows->fecha_out . "</div></td>";
		if($rows->estatus == true) {
			$pdf .= "<td><div>Activo</div></td>";
		} else {
			$pdf .= "<td><div>Inactivo</div></td>";
		}
		$pdf .= "</tr>";
	}
	$pdf.=
"</table>";

$html = $pdf;

$pdf = new WKPDF();
$pdf->set_html($html);
$pdf->render();
$pdf->output(WKPDF::$PDF_SAVEFILE, 'reporte-listar-usuarios.pdf');
print '<meta http-equiv="refresh" content="0; url=/tmp/reporte-listar-usuarios.pdf">';
?>
