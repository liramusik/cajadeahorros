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
		$this->query = "select id, tipo from tb_tipo_cuentas";
		$this->result = pg_query($this->connect, $this->query);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
        public function getListarTipoTransaccion() {
                $this->query = "select id, tipo from tb_tipo_transacciones";
                $this->result = pg_query($this->connect, $this->query);
                if(!$this->result) {
                        print "Error " . pg_last_error();
                }   
        }    
	public function getListarBancosEnCuentas() {
		$this->query = "select id_banco, nombre from tb_cuentas left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id group by id_banco, nombre;";
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
	public function getQuery() {
		return $this->result;
	}
}
?>
