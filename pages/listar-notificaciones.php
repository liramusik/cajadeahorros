<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	if($_SESSION['session_id_rol'] == 1) {
		$c->setQuery("select id, fecha, asunto, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula order by fecha desc");
	} else {
		$c->setQuery("select id, fecha, asunto, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula where cedula=$cedula order by fecha desc");
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
	<div class="notificar-todos">Presione clic <a href="index.php?page=notificar&n_cedula=all">aquí</a> si desea notificar a todos los asociados</div>
	<table id="listado">
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
				<td><?php print date("d-m-Y H:i", $rows->fecha); ?></td>
				<td><?php print $rows->nombre . " " . $rows->apellido; ?></td>
				<td><?php print $rows->email; ?></td>
				<td><a href="index.php?page=ver-notificacion&notificacion=<?php print $rows->id; ?>"><?php print $rows->asunto; ?></a></td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
