<?php
include("login_class.php");

$usuario = $_POST['usuario'];
$password = md5($_POST['password']);

$login = new login();
$login->inicia(3600, $usuario, $password);
?>
