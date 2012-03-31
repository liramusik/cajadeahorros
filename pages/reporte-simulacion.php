<h1>Resultado de la Simulación</h1>

<?php $total = $total_intereses + $this->monto; ?>
<h2>Total de intereses a pagar <?php print $total_intereses; ?> Bs.</h2>
<h3>Total del préstamo <?php print $this->monto; ?> Bs.</h3>
<h4>Para realizar la solicitud de préstamo en base a esta simulación, por favor haga clic <a href="index.php?page=solicitud-prestamo&monto=<?php print $this->monto; ?>&tiempo=<?php print $this->tiempo; ?>&pago=<?php print $this->pago; ?>">aquí</a></h4>

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

<table id=listado>
	<?php if($this->pago == 1): ?>
		<thead>
			<th class="t_cuota">Cuota</th>
			<th class="t_interes">Interés</th>
			<th class="t_fecha">Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<tr>
				<td class="cuota"><?php print $i; ?></td>
				<td class="interes"><?php printf("%1\$.2f", $intereses[$i]); ?></td>
				<td class="fecha"><?php print date("d/m/Y", $fechas[$i]); ?></td>
			</tr>
		<?php endfor; ?>
	<?php elseif($this->pago == 2): ?>
		<thead>
			<th class="t_cuota">Cuota</th>
			<th class="t_interes">Interés</th>
			<th class="t_amortizacion">Amortización</th>
			<th class="t_fecha">Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<tr>
				<td class="cuota"><?php print $i; ?></td>
				<td class="interes"><?php printf("%1\$.2f", $intereses[$i]); ?></td>
				<td class="amortizacion"><?php printf("%1\$.2f", $amortizacion[$i]); ?></td>
				<td class="fecha"><?php print date("d/m/Y", $fechas[$i]); ?></td>
			</tr>
		<?php endfor; ?>
	<?php endif; ?>
</table>
