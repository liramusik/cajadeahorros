<?php
session_start();
include("login_class.php");
$login=new login();
$login->inicia(3600, $_POST['user_login'], $_POST['password_login']);
?>
