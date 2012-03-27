<?php

class conexion {
	private $hostname = "localhost";
	private $database = "db_cadeveher";
	private $username = "user_cadeveher";
	private $password = "123456";
	public $connect;
	public function conectar() {
		$this->connect = pg_connect("host=$this->hostname dbname=$this->database user=$this->username password=$this->password") or die ("Imposible conectarse al servidor " . pg_last_error());
	}
}
?>
