<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$c->setQuery("select cedula, nombre, apellido, telefono, email, usuario, descripcion from tb_usuarios left join tb_roles on tb_usuarios.id_rol = tb_roles.id where estatus=true");
	?>
	<h1>Listado de Usuarios</h1>
	<script>
		$(document).ready(function() {
			$('#listado').dataTable({
				"bLengthChange": false,
				"bInfo": false,
				"oLanguage": {
                   			"sEmptyTable": "No hay datos disponibles en la tabla",
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
				<th rowspan="2">Nombre y Apellido</th>
				<th rowspan="2">Usuario</th>
				<th rowspan="2">Rol</th>
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
				<td class="nombre"><span class="icon"></span><div><?php print $rows->nombre . " " . $rows->apellido; ?></div></td>
				<td><div><?php print $rows->usuario; ?></div></td>
				<td><div><?php print $rows->descripcion; ?></div></td>
				<td><div><?php print $rows->telefono; ?></div></td>
				<td><div><?php print $rows->email; ?></div></td>
				<td><div><a href="<?php print "index.php?page=notificar&cedula=" . $rows->cedula; ?>"><img src="img/notificar.png" title="Notificar" alt="Notificar"></a></div></td>
				<td><div><a href="<?php print "index.php?page=modificar-usuarios&cedula=" . $rows->cedula; ?>"><img src="img/modificar.png" title="Modificar" alt="Modificar"></a></div></td>
				<td><div><a href="<?php print "index.php?page=deshabilitar-usuarios&cedula=" . $rows->cedula; ?>"><img src="img/deshabilitar.png" title="Deshabilitar" alt="Deshabilitar"></a></div></td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
