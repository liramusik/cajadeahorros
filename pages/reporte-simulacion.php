<h1>Simulación de Préstamo</h1>

<div>Total préstamo Bs <?php print number_format($this->monto, 2, ",", "."); ?></div>

<script>
	$(document).ready(function() {
            $('#listado').dataTable({
                	"bJQueryUI": true, 
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": false,
			"bInfo": false,
			"bAutoWidth": false
		});
	});
	$(document).ready(function() {
		$('.solicitar').click(function() {
			var cedula = "<?php print $this->cedula; ?>";
			var monto = "<?php print $this->monto; ?>";
			var tiempo = "<?php print $this->tiempo; ?>";
			var tipo_pago = "<?php print $this->tipo_pago; ?>";
			var id_rol = "<?php print $this->id_rol; ?>";
			$("#contenido").load("includes/pages.php?page=solicitar-prestamo&cedula="+cedula+"&monto="+monto+"&tiempo="+tiempo+"&tipo_pago="+tipo_pago+"&id_rol="+id_rol);
		})
	});
</script>

<?php if($this->tipo_pago == 1): ?>
	<div>Para realizar la solicitud de préstamo en base a esta simulación, por favor haga clic <a class="solicitar" href="#">aquí</a></div>

	<table id="listado" class="listado">
		<thead>
			<th>No.</th>
			<th>Monto Bs.</th>
			<th>Interés Fijo</th>
			<th>Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<tr>
				<td><?php print $i; ?></td>
				<td><?php print number_format($prestamo[$i], 2, ",", "."); ?></td>
				<?php if($i == $this->tiempo): ?>
					<td><?php print number_format($prestamo[$i] + $interes[$i], 2, ",", "."); ?></td>
				<?php else: ?>
					<td><?php print number_format($interes[$i], 2, ",", "."); ?></td>
				<?php endif; ?>
				<td><?php print date("d/m/Y", $fecha[$i]); ?></td>
			</tr>
		<?php endfor; ?>
	</table>
<?php elseif($this->tipo_pago == 2): ?>
	<div>Para realizar la solicitud de préstamo en base a esta simulación, por favor haga clic <a class="solicitar" href="#">aquí</a></div>
	<table id="listado" class="listado">
		<thead>
			<th>No.</th>
			<th>Monto Bs.</th>
			<th>Interés</th>
			<th>Amortización</th>
			<th>Cuota</th>
			<th>Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<tr>
				<td><?php print $i; ?></td>
				<td><?php print number_format($prestamo[$i - 1], 2, ",", "."); ?></td>
				<td><?php print number_format($interes[0], 2, ",", "."); ?></td>
				<td><?php print number_format($amortizacion, 2, ",", "."); ?></td>
				<td><?php print number_format($cuota, 2, ",", "."); ?></td>
				<td><?php print date("d/m/Y", $fecha[$i]); ?></td>
			</tr>
		<?php endfor; ?>
	</table>
<?php elseif($this->tipo_pago == 3): ?>
	<?php
	$interes_total = 0;
	for($i = 1; $i <= $this->tiempo; $i++) {
		$interes_total += $interes[$i];
	}
	?>
	<div>Total Interés Bs. <?php print number_format($interes_total, 2, ",", "."); ?></div>
	<div>Para el día <?php print date("d/m/Y", $fecha[0]); ?>. Usted debe pagar un monto de Bs. <?php print number_format($this->monto + $interes_total, 2, ",", "."); ?></div>
	<div>Para realizar la solicitud de préstamo en base a esta simulación, por favor haga clic <a class="solicitar" href="#">aquí</a></div>
<?php endif; ?>
