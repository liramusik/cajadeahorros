<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$n->setQuery("select tb_solicitud_prestamo.id, cedula, nombre, apellido, monto, fecha, tb_estatus_solicitud_prestamo.estatus from tb_solicitud_prestamo left join tb_estatus_solicitud_prestamo on tb_solicitud_prestamo.id_estatus_solicitud_prestamo = tb_estatus_solicitud_prestamo.id left join tb_usuarios on cedula_usuario = cedula order by fecha desc;");
	?>
		<h1></h1>
		<script>
			$(document).ready(function() {
				$('#listado').dataTable({
					"bLengthChange": false,
					"bInfo": false,
					"aaSorting": [[ 3, "asc" ]],
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
					<td><a href="index.php?page=evaluar-solicitud&solicitud=<?php print $rows->id; ?>"><?php printf("No.- %05d", $rows->id); ?></a></td>
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
