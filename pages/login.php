<?php
include("login_class.php");

$usuario = $_POST['user_login'];
$password = md5($_POST['password_login']);

$login=new login();
$login->inicia(3600, $usuario, $password);
?>
