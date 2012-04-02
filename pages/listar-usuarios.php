<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$c->setQuery("select * from tb_usuarios where estatus=true");
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
	<table id="listado" class="listado">
		<thead>
			<tr>
				<th rowspan="2">Nombre</th>
				<th rowspan="2">Apellido</th>
				<th rowspan="2">Teléfono</th>
				<th rowspan="2">Email</th>
				<th colspan="3" style="border-bottom: 0">Acciones</th>
			</tr>
			<tr>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="nombre"><span class="icon"></span><div><?php print $rows->nombre; ?></div></td>
				<td><div><?php print $rows->apellido; ?></div></td>
				<td><div><?php print $rows->telefono; ?></div></td>
				<td><div><?php print $rows->email; ?></div></td>
				<td><div><a href="<?php print "index.php?page=notificar&cedula=" . $rows->cedula; ?>"><img src="img/notificar.png" title="Notificar" alt="Notificar"></a></div></td>
				<td><div><a href="<?php print "index.php?page=modificar-usuarios&cedula=" . $rows->cedula; ?>"><img src="img/modificar.png" title="Modificar" alt="Modificar"></a></div></td>
				<td><div><a href="<?php print "index.php?page=deshabilitar-usuarios&cedula=" . $rows->cedula; ?>"><img src="img/deshabilitar.png" title="Deshabilitar" alt="Deshabilitar"></div></a></td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
