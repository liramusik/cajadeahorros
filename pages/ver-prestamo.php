<?php
$id = $_GET['id'];
if($_SESSION['session_id_rol'] == 1) {
	include("ver-prestamos-admin.php");
} else {
	include("ver-prestamos-usuarios.php");
}
?>
