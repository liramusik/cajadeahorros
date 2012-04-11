<?php if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$c = new conexion();
	$c->setQuery("select nombre, tipo, cuenta, monto, to_char(fecha_interes, 'DD/MM/YYYY') as fecha  from tb_intereses left join tb_cuentas on tb_intereses.id_cuenta = tb_cuentas.id left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id left join tb_tipo_cuentas on tb_tipo_cuentas.id = tb_cuentas.id_tipo_cuenta;");
	//$suma = new conexion();
	//$suma->setQuery("select sum(monto) as suma from tb_cuentas left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id left join tb_tipo_cuentas on tb_cuentas.id_tipo_cuenta = tb_tipo_cuentas.id left join tb_intereses on tb_cuentas.id = tb_intereses.id_cuenta;");
	?>
	<h1>Listado de Intereses</h1>
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
				<th>Nombre del Banco</th>
				<th>Tipo de Cuenta</th>
				<th>Cuenta No.</th>
				<th>Monto Bs.</th>
				<th>Fecha</th>
			</tr>
		</thead>
		<?php while($rows = pg_fetch_object($c->getQuery())): ?>
			<tr>
				<td class="banco"><span class="icon"></span><div class="banco"><?php print $rows->nombre ?></div></td>
				<td><div><?php print $rows->tipo; ?></div></td>
				<td><div><?php print $rows->cuenta; ?></div></td>	
				<td><div><?php print number_format($rows->monto, 2, ",", "."); ?></div></td>	
				<td><div><?php print $rows->fecha; ?></div></td>
			</tr>
		<?php endwhile; ?>
	<?php /*
			<tr>
		<?php while($row = pg_fetch_object($suma->getQuery())): ?>
				<td><div></div></td>
				<td><div></div></td>	
				<td><div><?php print "Total: "; ?></div></td>
				<td><div><?php print number_format($rows->suma, 2, ",", "."); ?></div></td>
				<td><div></div></td>
		<?php endwhile; ?>
	</tr> 
	 */?>
	</table>
	<? include('reporte-listar-intereses.php'); ?>
	<div><a href="tmp/reporte-intereses.pdf">Imprimir PDF</a></div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.modificar').click(function() {
				$('#contenido').load("includes/pages.php?page=modificar-cuenta&id="+$(this).attr('id'));
			})
		});
	</script>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios para ver esta página <a href="index.php">Regresar</a></div>
<?php endif; ?>
