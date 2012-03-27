<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$db_hostname = "localhost";
	$db_database = "db_cadeveher";
	$db_username = "user_cadeveher";
	$db_password = "123456";

	$cedula = $_SESSION['session_cedula'];

	$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());

	if($_SESSION['session_id_rol'] == 1) {
		$query = "select id, fecha, asunto, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula order by fecha desc";
	} else {
		$query = "select id, fecha, asunto, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula where cedula=$cedula order by fecha desc";
	}

	$result = pg_query($db_connect, $query);
	if(!$result) {
		print "Error" . pg_last_error();
	}
	?>
	<h1>Listado de Usuarios</h1>
	<script>
		$(document).ready(function() {
			$('#listado').dataTable({
				"bLengthChange": false,
				"bInfo": false,
				"aaSorting": [[ 0, "desc" ]],
				"oLanguage": {
					"sSearch": "",
					"oPaginate": {
						"sPrevious": "Atras",
						"sNext": "Siguiente"
					}
				}
			});
		});
	</script>
	<div class="notificar-todos">
		<a href="index.php?page=notificar&n_cedula=all"><img src="img/notificar.png" title="Notificar a todos" alt="Notificar a todos"></a>
	</div>
	<table id="listado">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Asunto</th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($result)): ?>
			<tr>
				<td><?php print date("d-m-Y H:i", $rows->fecha); ?></td>
				<td><?php print $rows->nombre . " " . $rows->apellido; ?></td>
				<td><?php print $rows->email; ?></td>
				<td><a href="index.php?page=mostrar-notificacion&n_notificacion=<?php print $rows->id; ?>"><?php print $rows->asunto; ?></a></td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
