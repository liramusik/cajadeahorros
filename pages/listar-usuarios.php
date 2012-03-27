<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php if($_SESSION['session_id_rol'] == 1): ?>
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
		<h1>Listado de Usuarios</h1>
		<script>
			$(document).ready(function() {
				$('#listado').dataTable({
					"bLengthChange": false,
					"bInfo": false,
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
					<th>Nombre</th>
					<th>Apellido</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<?php while($rows = pg_fetch_object($result)): ?>
				<tr>
					<td><?php print $rows->nombre; ?></td>
					<td><?php print $rows->apellido; ?></td>
					<td><?php print $rows->telefono; ?></td>
					<td><?php print $rows->email; ?></td>
					<td><a href="<?php print "index.php?page=notificar&n_cedula=" . $rows->cedula; ?>"><img src="img/notificar.png" title="Notificar" alt="Notificar"></a></td>
					<td><a href="<?php print "index.php?page=modificar-usuarios&m_cedula=" . $rows->cedula; ?>"><img src="img/modificar.png" title="Modificar" alt="Modificar"></a></td>
					<td><a href="<?php print "index.php?page=deshabilitar-usuarios&d_cedula=" . $rows->cedula; ?>"><img src="img/deshabilitar.png" title="Deshabilitar" alt="Deshabilitar"></a></td>
				</tr>
			<?php endwhile; ?>
		</table>
	<?php endif; ?>
       <?php else: ?>
                <div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
