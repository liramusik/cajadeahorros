<?php
$cedula = $_SESSION['session_cedula'];
$monto = $_POST['monto'];
$tiempo = $_POST['tiempo'];
$pago = $_POST['pago'];
$observacion = $_POST['observacion'];
$fecha_actual = time();
$query = "INSERT INTO tb_solicitud_prestamo (cedula_usuario, monto, fecha, tiempo, observacion) VALUES ('$cedula','$monto','$fecha_actual','$tiempo','$observacion')";
?>
