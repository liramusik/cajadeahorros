<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$cedula = $_GET['cedula'];
	$id_rol = $_SESSION['session_id_rol'];

	if($id_rol == 1) {
		$c->setQuery("select id, to_char(fecha, 'DD/MM/YYYY HH:MI a.m.') as fecha, asunto, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula order by fecha desc");
	} else {
		$c->setQuery("select id, to_char(fecha, 'DD/MM/YYYY HH:MI a.m.') as fecha, asunto, nombre, apellido, email from tb_notificaciones left join tb_usuarios on cedula_usuario = cedula where cedula=$cedula order by fecha desc");
	}
	?>
	<h1>Listado de Notificaciones</h1>
	<script>
		$(document).ready(function() {
			$('#listado').dataTable({
				"bJQueryUI": true,
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
	<?php if($id_rol == 1): ?>
		<div class="notificar-todos">Presione clic <a href="#" id="all" class="notificar">aquí</a> si desea notificar a todos los asociados</div>
	<?php endif; ?>
	<table id="listado" class="listado">
		<thead>
			<tr>
				<th>Asunto</th>
				<th>Fecha</th>
				<th>Nombre y Apellido</th>
				<th>E-mail</th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="asunto"><span class="icon"></span><div class="asunto"><a href="#" id="<?php print $rows->id; ?>" class="ver-notificacion"><?php print $rows->asunto; ?></a></div></td>
				<td><div><?php print $rows->fecha; ?></div></td>
				<td><div><?php print $rows->nombre . " " . $rows->apellido; ?></div></td>
				<td><div><?php print $rows->email; ?></div></td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta página <a href="index.php">Regresar</a></div>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.ver-notificacion').click(function() {
			$('#contenido').load("includes/pages.php?page=ver-notificacion&id="+$(this).attr('id'));
		})
	});
	$(document).ready(function() {
		$('.notificar').click(function() {
			$('#contenido').load("includes/pages.php?page=notificar&cedula="+$(this).attr('id'));
		})
	});
</script>
