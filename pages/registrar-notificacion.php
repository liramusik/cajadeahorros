<?php
$emails = preg_split("/\,/", $_POST['emails']);
$cedulas = preg_split("/\,/", $_POST['cedulas']);
$fecha = date("Y-m-d H:i:s", time());
$asunto = $_POST['asunto'];
$mensaje = $_POST['mensaje'];

include("../conf/conexion.php");
$notificar = new conexion();

for($i = 0; $i < sizeof($cedulas) - 1; $i++) {
	$cedula = $cedulas[$i];
	$notificar->setQuery("insert into tb_notificaciones values(default, $cedula, '" . $fecha . "', '" . $asunto . "','" . $mensaje . "')");
	if(!$notificar) {
		print "Ha ocurrido un error " . pg_last_error();
	} 
	if(!empty($emails[$i])) {
		mail($emails[$i], $asunto, wordwrap($mensaje));
	}
}
print "El mensaje ha sido enviado";
?>
