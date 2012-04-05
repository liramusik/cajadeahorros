<?php if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$c->setQuery("select tb_cuentas.id, nombre, tipo, cuenta from tb_cuentas left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id left join tb_tipo_cuentas on tb_cuentas.id_tipo_cuenta = tb_tipo_cuentas.id;");
	?>
	<h1>Listado de Cuentas</h1>
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
	<table id="listado" class="listado">
		<thead>
			<tr>
				<th>Banco</th>
				<th>Tipo de Cuenta</th>
				<th>Cuenta</th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="banco"><span class="icon"></span><div class="banco"><?php print $rows->nombre ?></div></td>
				<td><div><?php print $rows->tipo; ?></div></td>
				<td><div><?php print $rows->cuenta; ?></div></td>
				<td><div><a href="<?php print "index.php?page=modificar-modificar&cuenta=" . $rows->id; ?>"><img src="img/modificar.png" title="Modificar" alt="Modificar"></a></div></td>
				<td><div><a href="<?php print "index.php?page=deshabilitar-deshabilitar&cuenta=" . $rows->id; ?>"><img src="img/deshabilitar.png" title="Deshabilitar" alt="Deshabilitar"></a></div></td>
			</tr>
		<?php endwhile; ?>
	</table>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
