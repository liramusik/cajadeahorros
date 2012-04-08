<?php if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)): ?>
	<script type="text/javascript">
		$(document).ready(function() { 
			var opciones = {
				success: mostrarRespuesta,
			};
			$('.form').ajaxForm(opciones);
			function mostrarRespuesta(responseText) {
				alert("Mensaje: " + responseText);
				$("#contenido").load("includes/pages.php?page=listar-cuentas");
			}; 
		}); 
	</script>

	<?php
	$c = new conexion();
	$c->setQuery("select tb_cuentas.id, nombre, tipo, cuenta from tb_cuentas left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id left join tb_tipo_cuentas on tb_cuentas.id_tipo_cuenta = tb_tipo_cuentas.id where estatus='t';");
	?>
	<h1>Listado de Cuentas</h1>
	<script>
		$(document).ready(function() {
			$('#listado').dataTable({
				"bLengthChange": false,
				"bJQueryUI": true,
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
				<th>Banco</th>
				<th>Tipo de Cuenta</th>
				<th>Cuenta</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="banco"><span class="icon"></span><div class="banco"><?php print $rows->nombre ?></div></td>
				<td><div><?php print $rows->tipo; ?></div></td>
				<td><div><?php print $rows->cuenta; ?></div></td>
				<td>
					<div class="accion"><a href="#" id="<?php print $rows->id; ?>" class="modificar"><img src="img/modificar.png" title="Modificar" alt="Modificar"></a></div>
					<div class="accion">
						<form action="pages/deshabilitar-cuenta.php" method="post" id="deshabilitar-cuenta" class="form">
							<input type="hidden" name="id" value="<?php print $rows->id; ?>" />
							<input type="submit" name="submit" id="boton-deshabilitar" />
						</form>
					</div>
				</td>
			</tr>
		<?php endwhile; ?>
	</table>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.modificar').click(function() {
				$('#contenido').load("includes/pages.php?page=modificar-cuenta&id="+$(this).attr('id'));
			})
		});
	</script>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios para ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
