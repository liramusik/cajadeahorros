<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	if($_SESSION['session_id_rol'] == 1) {
		$c->setQuery("select tb_solicitud_prestamo.id, cedula, nombre, apellido, monto, fecha, tb_estatus_solicitud_prestamo.estatus from tb_solicitud_prestamo left join tb_estatus_solicitud_prestamo on tb_solicitud_prestamo.id_estatus_solicitud_prestamo = tb_estatus_solicitud_prestamo.id left join tb_usuarios on cedula_usuario = cedula order by fecha desc;");
	} else {
		$cedula = $_SESSION['session_cedula'];
		$c->setQuery("select tb_solicitud_prestamo.id, cedula, nombre, apellido, monto, fecha, tb_estatus_solicitud_prestamo.estatus from tb_solicitud_prestamo left join tb_estatus_solicitud_prestamo on tb_solicitud_prestamo.id_estatus_solicitud_prestamo = tb_estatus_solicitud_prestamo.id left join tb_usuarios on cedula_usuario = cedula where cedula=$cedula");
	}
	?>
	<h1>Listado General de Préstamos</h1>
	<script>
		$(document).ready(function() {
			$('#listado').dataTable({
				"bLengthChange": false,
				"bInfo": false,
				"aaSorting": [[ 3, "desc" ]],
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
				<th>Solicitud</th>
				<th>Nombre</th>
				<th>Monto</th>
				<th>Fecha</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($n->getQuery())): ?>
			<tr>
				<td><a href="index.php?page=ver-solicitud&solicitud=<?php print $rows->id; ?>"><?php printf("No.- %05d", $rows->id); ?></a></td>
				<td><?php print $rows->nombre . " " . $rows->apellido; ?></td>
				<td><?php print $rows->monto; ?></td>
				<td><?php print date("d-m-Y H:i", $rows->fecha); ?></td>
				<td><?php print $rows->estatus; ?></td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
