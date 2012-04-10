<?php
class conexion {
	public $hostname = 'localhost';
	public $database = 'db_cadeveher';
	public $username = 'user_cadeveher';
	public $password = '123456';
	public function setConnection($hostname, $database, $username, $password) {
		$this->hostname = $hostname;
		$this->database = $database;
		$this->username = $username;
		$this->password = $password;
	}
	public function __construct() {
		$this->connect = pg_connect("host=$this->hostname dbname=$this->database user=$this->username password=$this->password")
			or die ("Imposible conectarse al servidor " . pg_last_error());
	}
	public function setQuery($str) {
		$this->result = pg_query($this->connect, $str);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getListarCuentas() {
		$this->query = "select * from tb_cuentas;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getListarNombreBancos() {
		$this->query = "select id, nombre from tb_bancos";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getListarTipoCuentas() {
		$this->query = "select * from tb_tipo_cuentas";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
        public function getListarTipoTransaccion() {
                $this->query = "select * from tb_tipo_transacciones";
                $this->result = pg_query($this->connect, $this->query);
                if(!$this->result) {
                        print "Error " . pg_last_error();
                }   
        }    
	public function getListarBancosEnCuentas() {
		$this->query = "select id_banco, nombre from tb_cuentas left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id where estatus=true group by id_banco, nombre;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getBuscarUsuario($cedula) {
		$this->query = "select * from tb_usuarios where cedula=$cedula;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getBuscarUsuarios() {
		$this->query = "select * from tb_usuarios where estatus='t';";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getRoles() {
		$this->query = "select * from tb_roles;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getEstatusSolicitudPrestamo() {
		$this->query = "select * from tb_estatus_solicitud_prestamo;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getModificarUsuario($cedula) {
		$this->query = "select cedula, nombre, apellido, telefono, email, direccion, aporte_mensual, to_char(fecha_ingreso, 'DD/MM/YYYY') as fecha_ingreso, to_char(fecha_egreso, 'DD/MM/YYYY') as fecha_egreso, nacionalidad, id_rol, usuario from tb_usuarios left join tb_nacionalidad on id_nacionalidad = tb_nacionalidad.id left join tb_roles on id_rol = tb_roles.id where cedula=$cedula";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getBuscarBancoEnCuenta($id) {
		$this->query = "select tb_cuentas.id, nombre, cuenta, id_tipo_cuenta from tb_cuentas left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id left join tb_tipo_cuentas on tb_cuentas.id_tipo_cuenta = tb_tipo_cuentas.id where tb_cuentas.id=$id;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getTienePrestamos($cedula) {
		$this->query = "select count(id) as total from tb_solicitud_prestamo where id_estatus_solicitud_prestamo=2 and cedula_usuario=$cedula;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getIdPrestamoUsuario($cedula) {
		$this->query = "select id from tb_solicitud_prestamo where id_estatus_solicitud_prestamo=2 and cedula_usuario=$cedula;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getTotalCuotas($id) {
		$this->query = "select count(*) as total from tb_prestamo where id_solicitud_prestamo=$id;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getDetallePrestamo($id) {
		$this->query = "select * from tb_solicitud_prestamo where id=$id;";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}

	}
	public function getQuery() {
		return $this->result;
	}
}
?>
