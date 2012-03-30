<?php
class connection {
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
	public function __destruct() {
		pg_close($this->connect);
	}
	public function setQuery($str) {
		$this->result = pg_query($this->connect, $str);
		if(!$this->result) {
			print "Error " . pg_last_error();
		}
	}
	public function getQuery() {
		return $this->result;
	}
}
?>
