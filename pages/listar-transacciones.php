<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	include("conexion.php");
	$cedula = $_GET['cedula'];
	$c = new conexion();
	if ($_SESSION['session_id_rol']==1) {
		$c->setQuery("select t.id, u.nombre, u.apellido, c.cuenta, b.nombre as banco, to_char(t.fecha,'DD/MM/YYYY') as fecha, tt.tipo, t.monto, t.deposito, e.estatus from tb_transacciones as t inner join (tb_cuentas as c left join tb_bancos as b on  c.id_banco = b.id) on t.id_cuenta = c.id left join tb_estatus_transacciones as e on  e.id = t.id_estatus_transaccion left join tb_usuarios as u on u.cedula = t.cedula_usuario left join tb_tipo_transacciones as tt on tt.id = t.id_tipo_transaccion;");
	} elseif($_SESSION['session_id_rol']==2) {
		$c->setQuery("select t.id, u.nombre, u.apellido, c.cuenta, b.nombre as banco, to_char(t.fecha,'DD/MM/YYYY') as fecha, tt.tipo, t.monto, t.deposito, e.estatus from tb_transacciones as t inner join (tb_cuentas as c left join tb_bancos as b on  c.id_banco = b.id) on t.id_cuenta = c.id left join tb_estatus_transacciones as e on  e.id = t.id_estatus_transaccion left join tb_usuarios as u on u.cedula = t.cedula_usuario left join tb_tipo_transacciones as tt on tt.id = t.id_tipo_transaccion where cedula=$cedula;");
	}
	?>
	<h1>Listado de Transacciones</h1>
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
				<th>Cuenta</th>
				<th>Banco</th>
				<th>Tipo</th>
				<th>Fecha</th>
				<th>Monto</th>
				<th>Deposito</th>
				<th>Estatus</th>
				<th>Acciones</th>
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
				<td>
				<?php if($rows->estatus == 'Pendiente'): ?>
					<div class="accion"><a href="<?php print "index.php?page=aprobar-transaccion&transaccion=" . $rows->id; ?>"><img src="img/aprobar-prestamo.png" title="Aceptado" alt="Aceptado"></a></div>
					<div class="accion"><a href="<?php print "index.php?page=rechazar-transaccion&transaccion=" . $rows->id; ?>"><img src="img/rechazar-prestamo.png" title="Rechazado" alt="Rechazado"></a></div>
				<?php elseif($rows->estatus == 'Aceptado'): ?>
                                        <div class="accion" style="opacity: .5;"><img src="img/aprobar-prestamo.png" /></div>
                                        <div class="accion" style="opacity: .5;"><img src="img/rechazar-prestamo.png" /></div>
                                <?php elseif($rows->estatus == 'Rechazado'): ?>
                                        <div class="accion" style="opacity: .5;"><img src="img/aprobar-prestamo.png" /></div>
                                        <div class="accion" style="opacity: .5;"><img src="img/rechazar-prestamo.png" /></div>
				<?php endif; ?>
				</td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
