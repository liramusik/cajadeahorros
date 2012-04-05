<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	if($_SESSION['session_id_rol'] == 1) {
		$c->setQuery("select id, to_char(fecha, 'DD/MM/YYYY HH:MI a.m.') as fecha, asunto, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula order by fecha desc");
	} else {
		$c->setQuery("select id, to_char(fecha, 'DD/MM/YYYY HH:MI a.m.') as fecha, asunto, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula where cedula=$cedula order by fecha desc");
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
	<div class="notificar-todos">Presione clic <a href="index.php?page=notificar&cedula=all">aquí</a> si desea notificar a todos los asociados</div>
	<table id="listado" class="listado">
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Asunto</th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="fecha"><span class="icon"></span><div class="fecha"><a href="index.php?page=ver-notificacion&notificacion=<?php print $rows->id; ?>"><?php print $rows->fecha; ?></a></div></td>
				<td><div><?php print $rows->nombre . " " . $rows->apellido; ?></div></td>
				<td><div><?php print $rows->email; ?></div></td>
				<td><div><?php print $rows->asunto; ?></div></td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
