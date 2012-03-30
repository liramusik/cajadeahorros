<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$n->setQuery("select * from tb_usuarios where estatus=true");
	?>
	<h1>Listado de Usuarios</h1>
	<script>
		$(document).ready(function() {
			$('#listado').dataTable({
				"bLengthChange": false,
				"bInfo": false,
				"oLanguage": {
					"sSearch": "Filtrar usuarios",
					"oPaginate": {
						"sPrevious": "Atras",
						"sNext": "Siguiente"
					}
				}
			});
		});
	</script>
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
		<?php while($rows = pg_fetch_object($n->getQuery())): ?>
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
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
