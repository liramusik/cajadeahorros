<?php if(isset($_SESSION['session_usuario'])): ?>
	<script type="text/javascript">
		$(document).ready(function() { 
			var opciones = {
				success: mostrarRespuesta,
			};
			$('.form').ajaxForm(opciones);
			function mostrarRespuesta(responseText) {
				alert("Mensaje: " + responseText);
				$("#contenido").load("includes/pages.php?page=listar-transacciones&cedula=<?php print $_SESSION['session_cedula']; ?>");
			}; 
		}); 
	</script>
	<?php
	if(!isset($_GET['cedula'])) {
		$cedula = $_SESSION['session_cedula'];
	} else {
		$cedula = $_GET['cedula'];
	}
	$c = new conexion();
	if($_SESSION['session_id_rol'] == 1) {
		$c->setQuery("select t.id, u.nombre, u.apellido, c.cuenta, b.nombre as banco, to_char(t.fecha,'DD/MM/YYYY') as fecha, tt.tipo, t.monto, t.deposito, e.estatus from tb_transacciones as t inner join (tb_cuentas as c left join tb_bancos as b on  c.id_banco = b.id) on t.id_cuenta = c.id left join tb_estatus_transacciones as e on  e.id = t.id_estatus_transaccion left join tb_usuarios as u on u.cedula = t.cedula_usuario left join tb_tipo_transacciones as tt on tt.id = t.id_tipo_transaccion;");
	} elseif($_SESSION['session_id_rol'] == 2) {
		$c->setQuery("select t.id, u.nombre, u.apellido, c.cuenta, b.nombre as banco, to_char(t.fecha,'DD/MM/YYYY') as fecha, tt.tipo, t.monto, t.deposito, e.estatus from tb_transacciones as t inner join (tb_cuentas as c left join tb_bancos as b on  c.id_banco = b.id) on t.id_cuenta = c.id left join tb_estatus_transacciones as e on  e.id = t.id_estatus_transaccion left join tb_usuarios as u on u.cedula = t.cedula_usuario left join tb_tipo_transacciones as tt on tt.id = t.id_tipo_transaccion where cedula=$cedula;");
	}
	?>
	<h1>Listado de Transacciones</h1>
	<script>
		$(document).ready(function() {
			$('#listado').dataTable({
				"bJQueryUI": true,
				"aaSorting": [[ 4, "desc" ]],
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
				<th>Cuenta</th>
				<th>Banco</th>
				<th>Tipo</th>
				<th>Fecha</th>
				<th>Monto</th>
				<th>Deposito</th>
				<th>Estatus</th>
				<?php if($_SESSION['session_id_rol'] == 1): ?>
					<th>Acciones</th>
				<?php endif; ?>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="nombre"><span class="icon"></span><div><?php print $rows->nombre . " " . $rows->apellido; ?></div></td>
				<td><div><?php print substr($rows->cuenta,-8); ?></div></td>
				<td><div><?php print $rows->banco; ?></div></td>
				<td><div><?php print $rows->tipo; ?></div></td>
				<td><div><?php print $rows->fecha; ?></div></td>
				<td><div><?php print $rows->monto; ?></div></td>
				<td><div><?php print $rows->deposito; ?></div></td>
				<td><div><?php print $rows->estatus; ?></div></td>
				<?php if($_SESSION['session_id_rol']==1): ?>
					<td>
						<div class="accion">
							<form action="pages/aceptar-transaccion.php" method="post" id="aceptar-transaccion" class="form">
								<input type="hidden" name="id" value="<?php print $rows->id; ?>" />
								<input type="submit" name="submit" id="boton-aceptar" />
							</form>
						</div>
						<div class="accion">
							<form action="pages/rechazar-transaccion.php" method="post" id="rechazar-transaccion" class="form">
								<input type="hidden" name="id" value="<?php print $rows->id; ?>" />
								<input type="submit" name="submit" id="boton-rechazar" />
							</form>
						</div>
					</td>
				<?php endif; ?>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
