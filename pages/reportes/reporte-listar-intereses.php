<?php 
include("../../conf/wkpdf.php");
if(!isset($c)) {
	include("../../conf/conexion.php");
	$c = new conexion();
}
$c->setQuery("select nombre, tipo, cuenta, monto, to_char(fecha_interes, 'DD/MM/YYYY') as fecha  from tb_intereses left join tb_cuentas on tb_intereses.id_cuenta = tb_cuentas.id left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id left join tb_tipo_cuentas on tb_tipo_cuentas.id = tb_cuentas.id_tipo_cuenta;");
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
		padding: 0px 30px;       
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
	."<h2>Listado de Intereses</h2>"
       . "<table>"
       . "<thead>"
	       . "<tr>"
			. "<th>Banco</th>"
			. "<th>Tipo de Cuenta</th>"
			. "<th>Cuenta</th>"
			. "<th>Inter&eacute;s</th>"
			. "<th>Fecha</th>"
		. "</tr>"
	. "</thead>";
	while($rows = pg_fetch_object($c->getQuery())){
		$pdf.= "<tr>"
			. "<td class='banco'><span class='icon'></span><div class='banco'>". htmlentities($rows->nombre) ."</div></td>"
			. "<td><div>" . $rows->tipo ."</div></td>"
			. "<td><div>" . $rows->cuenta ."</div></td>"
			. "<td><div>" . $rows->monto ."</div></td>"
			. "<td><div>" . $rows->fecha ."</div></td>"
		. "</tr>";
	}
	$pdf.=
"</table>";

$html = $pdf;

$pdf = new WKPDF();
$pdf->set_html($html);
$pdf->render();
$pdf->output(WKPDF::$PDF_SAVEFILE, 'reporte-intereses.pdf');
?>
