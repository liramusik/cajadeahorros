<?php 
include("../conf/wkpdf.php");
if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)) {
	$c = new conexion();
	$c->setQuery("select tb_cuentas.id, nombre, tipo, cuenta, monto, to_char(fecha_interes,'DD/MM/YYYY') as fecha from tb_cuentas left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id left join tb_tipo_cuentas on tb_cuentas.id_tipo_cuenta = tb_tipo_cuentas.id left join tb_intereses on tb_cuentas.id = tb_intereses.id_cuenta;");
	$pdf = 
		"<style type='text/css'>"
		."table { 
			border: 1px solid green;
			}"
		."</style>"

		."<h1>Listado de Intereses</h1>"
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
}

$html = $pdf;

$pdf = new WKPDF();
$pdf->set_html($html);
$pdf->render();
$pdf->output(WKPDF::$PDF_SAVEFILE, 'reporte-intereses.pdf');
?>
