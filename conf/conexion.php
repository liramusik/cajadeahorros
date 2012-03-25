<?
$db_hostname = "localhost";
$db_database = "db_cadeveher";
$db_username = "user_cadeveher";
$db_password = "123456";

$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());
?>
