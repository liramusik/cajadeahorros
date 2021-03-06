<?php if(isset($_SESSION['session_usuario'])): ?>
	<script type="text/javascript">
		$(document).ready(function() { 
			var opciones = {
				success: mostrarRespuesta,
			};
			$('.form').ajaxForm(opciones);
			function mostrarRespuesta(responseText) {
				alert("Mensaje: " + responseText);
				$("#contenido").load("includes/pages.php?page=listar-prestamos&cedula=<?php print $_SESSION['session_cedula']; ?>");
			}; 
		}); 
	</script>
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
				"bJQueryUI": true, 
				"bLengthChange": false,
				"bInfo": false,
				"aaSorting": [[ 0, "desc" ]],
				"oLanguage": {
					"sEmptyTable": "No hay datos disponibles en la tabla",
					"sZeroRecords": "No se han encontrado registros",
					"sSearch": "Filtrar Búsqueda",
					"oPaginate": {
						"sPrevious": "Átras",
						"sNext": "Siguiente"
					}
				}
			});
		});
	</script>
	<table id="listado" class="listado">
		<thead>
			<tr>
				<th>Solicitud No.</th>
				<th>Nombre y Apellido</th>
				<th>Monto Bs.</th>
				<th>Fecha</th>
				<th>Estatus del Préstamo</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="solicitud"><span class="icon"></span><div class="solicitud"><?php printf("%05d", $rows->id); ?></div></td>
				<td><div><?php print $rows->nombre . " " . $rows->apellido; ?></div></td>
				<td><div><?php printf("%.2f", $rows->monto); ?></div></td>
				<td><div><?php print $rows->fecha; ?></div></td>
				<td><div><?php print $rows->estatus; ?></div></td>
				<td>
					<?php if($_SESSION['session_id_rol']==1): ?>
						<div class="accion" title="Aceptar">
							<form action="pages/aceptar-prestamo.php" method="post" id="aceptar-prestamo" class="form">
								<input type="hidden" name="id" value="<?php print $rows->id; ?>" />
								<input type="submit" name="submit" id="boton-aceptar" />
							</form>
						</div>
						<div class="accion" title="Rechazar" alt="Rechazar">
							<form action="pages/rechazar-prestamo.php" method="post" id="rechaza-prestamo" class="form">
								<input type="hidden" name="id" value="<?php print $rows->id; ?>" />
								<input type="submit" name="submit" id="boton-rechazar" />
							</form>
						</div>
						<div class="accion" title="Ver" alt="Ver" ><a href="#" id="<?php print $rows->id; ?>" class="ver-prestamo"><img src="img/ver.png"></a></div>
					<?php endif; ?>
				</td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta página <a href="index.php">Regresar</a></div>
<?php endif; ?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.ver-prestamo').click(function() {
			$('#contenido').load("includes/pages.php?page=ver-prestamo&id="+$(this).attr('id'));
		})
	});
</script>
