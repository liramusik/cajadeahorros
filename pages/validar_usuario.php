<?
	$usuario = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	// archivos resqueridos
	require("../conf/conexion.php");
	require("../conf/sql.php");
	
	// datos del formulario de acceso

	
	// validacion de usuarios 
	$result=pg_query($conn,$login); 
	
	if ($result) {
	 	echo 'Usuario o Contrasena no validos';
  	}
	else{
		echo '1';	
	}
		
?>
