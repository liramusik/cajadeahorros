<h1>Simulación de Préstamo</h1>

<div>Total préstamo Bs <?php print number_format($this->monto, 2, ",", "."); ?></div>

<script>
	$(document).ready(function() {
		$('#listado').dataTable({
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": false,
			"bSort": false,
			"bInfo": false,
			"bAutoWidth": false
		});
	});
</script>

<?php if($this->tipo_pago == 1): ?>
	<div>Para realizar la solicitud de préstamo en base a esta simulación, por favor haga clic <a href="index.php?page=solicitar-prestamo&monto=<?php print $this->monto; ?>&tiempo=<?php print $this->tiempo; ?>&pago=<?php print $this->pago; ?>&porcentaje=<?php print $porcentaje; ?>">aquí</a></div>
	<table id="listado" class="listado">
		<thead>
			<th>No.</th>
			<th>Préstamo</th>
			<th>Interes Fijo</th>
			<th>Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<tr>
				<td><?php print $i; ?></td>
				<td><?php print number_format($prestamo[$i], 2, ",", "."); ?></td>
				<td><?php print number_format($interes[$i], 2, ",", "."); ?></td>
				<td><?php print date("d/m/Y", $fecha[$i]); ?></td>
			</tr>
		<?php endfor; ?>
	</table>
<?php elseif($this->tipo_pago == 2): ?>
	<div>Para realizar la solicitud de préstamo en base a esta simulación, por favor haga clic <a href="index.php?page=solicitar-prestamo&monto=<?php print $this->monto; ?>&tiempo=<?php print $this->tiempo; ?>&pago=<?php print $this->pago; ?>&porcentaje=<?php print $porcentaje; ?>">aquí</a></div>
	<table id="listado" class="listado">
		<thead>
			<th>No.</th>
			<th>Préstamo</th>
			<th>Interés</th>
			<th>Cuota</th>
			<th>Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<tr>
				<td><?php print $i; ?></td>
				<td><?php print number_format($prestamo[$i - 1], 2, ",", "."); ?></td>
				<td><?php print number_format($interes[$i], 2, ",", "."); ?></td>
				<td><?php print number_format($cuota[$i], 2, ",", "."); ?></td>
				<td><?php print date("d/m/Y", $fecha[$i]); ?></td>
			</tr>
		<?php endfor; ?>
	</table>
<?php elseif($this->tipo_pago == 3): ?>
	<?php
	for($i = 1; $i <= $this->tiempo; $i++) {
		$interes_total += $interes[$i];
	}
	?>
	<div>Total Interés Bs. <?php print number_format($interes_total, 2, ",", "."); ?></div>
	<div>Para el día <?php print date("d/m/Y", $fecha[0]); ?>. Usted debe pagar un monto de Bs. <?php print number_format($this->monto + $interes_total, 2, ",", "."); ?></div>
	<div>Para realizar la solicitud de préstamo en base a esta simulación, por favor haga clic <a href="index.php?page=solicitar-prestamo&monto=<?php print $this->monto; ?>&tiempo=<?php print $this->tiempo; ?>&pago=<?php print $this->pago; ?>&porcentaje=<?php print $porcentaje; ?>">aquí</a></div>
<?php endif; ?>
