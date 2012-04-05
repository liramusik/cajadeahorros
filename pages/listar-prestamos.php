<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	if($_SESSION['session_id_rol'] == 1) {
		$c->setQuery("select tb_solicitud_prestamo.id, cedula, nombre, apellido, monto, to_char(fecha, 'DD/MM/YYYY') as fecha, tb_estatus_solicitud_prestamo.estatus from tb_solicitud_prestamo left join tb_estatus_solicitud_prestamo on tb_solicitud_prestamo.id_estatus_solicitud_prestamo = tb_estatus_solicitud_prestamo.id left join tb_usuarios on cedula_usuario = cedula order by fecha desc;");
	} else {
		$cedula = $_SESSION['session_cedula'];
		$c->setQuery("select tb_solicitud_prestamo.id, cedula, nombre, apellido, monto, to_char(fecha, 'DD/MM/YYYY') as fecha, tb_estatus_solicitud_prestamo.estatus from tb_solicitud_prestamo left join tb_estatus_solicitud_prestamo on tb_solicitud_prestamo.id_estatus_solicitud_prestamo = tb_estatus_solicitud_prestamo.id left join tb_usuarios on cedula_usuario = cedula where cedula=$cedula");
	}
	?>
	<h1>Listado General de Préstamos</h1>
	<script>
		$(document).ready(function() {
			$('#listado').dataTable({
				"bLengthChange": false,
				"bInfo": false,
				"aaSorting": [[ 0, "desc" ]],
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
				<th rowspan="2">Solicitud</th>
				<th rowspan="2">Nombre</th>
				<th rowspan="2">Monto</th>
				<th rowspan="2">Fecha</th>
				<th rowspan="2">Estatus</th>
				<th colspan="3">Acciones</th>
			</tr>
			<tr>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="solicitud"><span class="icon"></span><div class="solicitud"><a href="index.php?page=ver-prestamos&solicitud=<?php print $rows->id; ?>"><?php printf("No.- %05d", $rows->id); ?></a></div></td>
				<td><div><?php print $rows->nombre . " " . $rows->apellido; ?></div></td>
				<td><div><?php printf("%.2f", $rows->monto); ?></div></td>
				<td><div><?php print $rows->fecha; ?></div></td>
				<td><div><?php print $rows->estatus; ?></div></td>
				<?php if($rows->estatus == 'Pendiente'): ?>
					<td><div><a href="index.php?page=aprobar-prestamo&prestamo=<?php print $rows->id; ?>"><img src="img/aprobar-prestamo.png" /></a></div></td>
					<td><div><a href="index.php?page=rechazar-prestamo&prestamo=<?php print $rows->id; ?>"><img src="img/rechazar-prestamo.png" /></a></div></td>
					<td><div><a href="index.php?page=editar-prestamo&prestamo=<?php print $rows->id; ?>"><img src="img/modificar-prestamo.png" /></a></div></td>
				<?php elseif($rows->estatus == 'Aprobado'): ?>
					<td><div style="opacity: .5;"><img src="img/aprobar-prestamo.png" /></div></td>
					<td><div style="opacity: .5;"><img src="img/rechazar-prestamo.png" /></div></td>
					<td><div><a href="index.php?page=editar-prestamo&prestamo=<?php print $rows->id; ?>"><img src="img/modificar-prestamo.png" /></a></div></td>
				<?php elseif($rows->estatus == 'Rechazado'): ?>
					<td><div style="opacity: .5;"><img src="img/aprobar-prestamo.png" /></div></td>
					<td><div style="opacity: .5;"><img src="img/rechazar-prestamo.png" /></div></td>
					<td><div style="opacity: .5;"><img src="img/modificar-prestamo.png" /></div></td>
				<?php elseif($rows->estatus == 'Pagado'): ?>
					<td><div style="opacity: .5;"><img src="img/aprobar-prestamo.png" /></div></td>
					<td><div style="opacity: .5;"><img src="img/rechazar-prestamo.png" /></div></td>
					<td><div style="opacity: .5;"><img src="img/modificar-prestamo.png" /></div></td>
				<?php endif; ?>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
