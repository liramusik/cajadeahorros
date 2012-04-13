<?php
	
class login {
	public function inicia($tiempo, $usuario, $clave) { 
		if(($usuario==NULL) && ($clave==NULL)) {
			if(isset($_SESSION['session_usuario'])) {
			} else {
				if(isset($_COOKIE['cookie_usuario'])) {
					$_SESSION['session_usuario'] = $_COOKIE['cookie_usuario'];
				} else {
					header( "Location: index.php" );
				}
			}
		} else {
			$this->verifica_usuario($tiempo, $usuario, $clave);
		}
	}  

	private function verifica_usuario($tiempo, $usuario, $clave) {
		$db_hostname = "localhost";
		$db_database = "db_cadeveher";
		$db_username = "user_cadeveher";
		$db_password = "123456";

		$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());

		$result = pg_query($db_connect,"SELECT cedula, nombre, apellido, usuario, password, id_rol, estatus FROM tb_usuarios where usuario='" . $usuario . "'");

		while($rows = pg_fetch_object($result)) {
			$db_cedula = $rows->cedula;
			$db_usuario = $rows->usuario;
			$db_nombre = $rows->nombre;
			$db_apellido = $rows->apellido;
			$db_password = $rows->password;
			$db_id_rol = $rows->id_rol;
			$db_estatus = $rows->estatus;
		}

		if($db_estatus != "f"){
			if(($usuario == $db_usuario) && ($clave==$db_password)) {
				$_SESSION['session_cedula'] = $db_cedula;
				$_SESSION['session_usuario'] = $db_usuario;
				$_SESSION['session_nombre'] = $db_nombre;
				$_SESSION['session_apellido'] = $db_apellido;
				$_SESSION['session_id_rol'] = $db_id_rol;

				setcookie("cookie_usuario", $db_usuario, time() + $tiempo);
				header("Location: ../index.php?page=bienvenida");
			} else {
				header("Location: ../index.php?error=1");
			}
		} else {
			print "Usted no tiene privilegios para ingresar a la aplicación";
		} 
		
	}
}
?>
