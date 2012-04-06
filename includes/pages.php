<?php session_start(); ?>
<?php 
chdir("..");
include("conf/conexion.php");
$c = new conexion();
if(!isset($_SESSION['session_usuario'])){
	if (!isset($_GET['page'])) {
		include("pages/acceso.php");
	} else {
		include("pages/".$_GET['page'].".php");
	}
} else {
	if (!isset($_GET['page'])) {
		include("pages/bienvenida.php");
	} else {
		include("pages/".$_GET['page'].".php");
	}
}
?>
