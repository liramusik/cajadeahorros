<?php if(isset($_SESSION['session_usuario'])): ?>

<?php
	$db_hostname = "localhost";
	$db_database = "db_cadeveher";
	$db_username = "user_cadeveher";
	$db_password = "123456";

	$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());

	$query = "select * from tb_usuarios where estatus=true";

	$result = pg_query($db_connect, $query);
	if(!$result) {
		print "Error" . pg_last_error();
	}
	?>

	<table>
		<?php while($rows = pg_fetch_object($result)): ?>
			<tr>
				<td><?php print $rows->nombre; ?></td>
				<td><?php print $rows->apellido; ?></td>
				<td><a href="<?php print "index.php?page=modificar_usuarios&m_cedula=" . $rows->cedula; ?>">Modificar</a></td>
				<td><a href="<?php print "index.php?page=listar_usuarios&d_cedula=" . $rows->cedula; ?>">Deshabilitar</a></td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php endif; ?>
