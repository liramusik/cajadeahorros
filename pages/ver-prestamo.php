<?php
$id = $_GET['id'];
if($_SESSION['session_id_rol'] == 1) {
	include("ver-prestamo-admin.php");
} else {
	include("ver-prestamo-usuario.php");
}
?>
