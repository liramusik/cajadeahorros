<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$c->setQuery("select cedula, nombre, apellido, telefono, email, usuario, descripcion from tb_usuarios left join tb_roles on tb_usuarios.id_rol = tb_roles.id where estatus=true");
	?>
	<h1>Listado de Usuarios</h1>
	<script>
		$(document).ready(function() {
			$('#listado').dataTable({
				"bJQueryUI": true,
				"bLengthChange": false,
				"bInfo": false,
				"oLanguage": {
           			"sEmptyTable": "No hay datos disponibles en la tabla",
					"sZeroRecords": "No se han encontrado registros",
					"sSearch": "Filtrar Búsqueda",
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
				<th>Nombre y Apellido</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Teléfono</th>
				<th>Email</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="nombre"><span class="icon"></span><div><?php print $rows->nombre . " " . $rows->apellido; ?></div></td>
				<td><div><?php print $rows->usuario; ?></div></td>
				<td><div><?php print $rows->descripcion; ?></div></td>
				<td><div><?php print $rows->telefono; ?></div></td>
				<td><div><?php print $rows->email; ?></div></td>
				<td>
					<div class="accion"><a href="#" id="<?php print $rows->cedula; ?>" class="notificar"><img src="img/notificar.png" title="Notificar" alt="Notificar"></a></div>
					<div class="accion"><a href="#" id="<?php print $rows->cedula; ?>" class="modificar"><img src="img/modificar.png" title="Modificar" alt="Modificar"></a></div>
					<?php if($_SESSION['session_cedula'] != $rows->cedula): ?>
						<div class="accion"><a href="<?php print "index.php?page=deshabilitar-usuarios&cedula=" . $rows->cedula; ?>"><img src="img/deshabilitar.png" title="Deshabilitar" alt="Deshabilitar"></a></div>
					<?php else: ?>
						<div class="accion"><a href="#"><img src="img/deshabilitar.png" title="Deshabilitar" alt="Deshabilitar"></a></div>
					<?php endif; ?>
				</td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.notificar').click(function() {
			$('#contenido').load("includes/pages.php?page=notificar&cedula="+$(this).attr('id'));
		})
	});
	$(document).ready(function() {
		$('.modificar').click(function() {
			$('#contenido').load("includes/pages.php?page=modificar-usuario&cedula="+$(this).attr('id'));
		})
	});
</script>
