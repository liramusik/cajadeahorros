<?php
	
	// archivos resqueridos
	require("../conf/conexion.php");
	
class login {
// Inicia sesion
public function inicia($tiempo=3600, $usuario=NULL, $clave=NULL) { 
    if ($usuario==NULL && $clave==NULL) {
        // Verifica sesion
        if (isset($_SESSION['idusuario'])) {
            //echo "Estas logeado";
        } else {
            // Verifica cookie
            if (isset($_COOKIE['idusuario'])) {
                // Restaura sesion
                $_SESSION['idusuario']=$_COOKIE['idusuario'];
            } else {
                // Si no hay sesion regresa al login
                header( "Location: index.php" );
            }
        }
    } else {
        $this->verifica_usuario($tiempo, $usuario, $clave);
    }
}  
//  Verifica login
private function verifica_usuario($tiempo, $usuario, $clave) {
	
	$result = pg_query($conn,"SELECT usuario, password FROM tb_usuarios");

	while ($row = pg_fetch_row($result)) {
		
		if ($usuario==$row['usuario'] && $clave==$row['password']) {
		// Si la clave es correcta
		$idusuario=$this->codificar_usuario($usuario);
		setcookie("idusuario", $idusuario, time()+$tiempo);
		$_SESSION['idusuario']=$idusuario;
		header( "Location: ../index.php" );
	} else {
		// Si la clave es incorrecta
		header( "Location: index.php?error=1" );
	}
}
}
// Codifica idusuario
private function codificar_usuario($usuario) {
    return md5($usuario);
}
}
?>
