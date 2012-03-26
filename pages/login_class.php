<?php
	
class login {
// Inicia sesion
public function inicia($tiempo, $usuario, $clave) { 
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
        $this->verifica_usuario($tiempo, $usuario, md5($clave));
    }
}  
//  Verifica login
private function verifica_usuario($tiempo, $usuario, $clave) {
	$db_hostname = "localhost";
	$db_database = "db_cadeveher";
	$db_username = "user_cadeveher";
	$db_password = "123456";

	$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());


	$result = pg_query($db_connect,"SELECT usuario, password, rol FROM tb_usuarios where usuario='" . $usuario. "'");

	while ($row = pg_fetch_object($result)) {
		$db_usuario = trim($row->usuario);
		$db_clave = trim(md5($row->password));
		$db_rol = $row->rol;
		
		if($usuario==$db_usuario && $clave==$db_clave) {
		// Si la clave es correcta
		$idusuario=$this->codificar_usuario($usuario,$db_rol);
		setcookie("cooke_usuario", $idusuario,"cooke_rol",$db_rol,time()+$tiempo);
		$_SESSION['session_usuario']=$idusuario;
		$_SESSION['session_rol']=$db_rol;
		header( "Location: index.php?page=usuario" );
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
