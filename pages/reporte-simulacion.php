<h1>Resultado de la Simulación</h1>
<table>
	<?php if($this->pago == 1): ?>
		<thead>
			<th>Cuota</th>
			<th>Interés</th>
			<th>Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<?php if($i % 2 == 0): ?>
				<tr class="odd">
					<td><?php print $i; ?></td>
					<td><?php print $intereses[$i]; ?></td>
					<td><?php print date("d-m-Y", $fechas[$i]); ?></td>
				</tr>
			<?php else: ?>
				<tr class="even">
					<td><?php print $i; ?></td>
					<td><?php print $intereses[$i]; ?></td>
					<td><?php print date("d-m-Y", $fechas[$i]); ?></td>
				</tr>
			<?php endif; ?>
		<?php endfor; ?>
	<?php elseif($this->pago == 2): ?>
		<thead>
			<th>Cuota</th>
			<th>Interés</th>
			<th>Amortización</th>
			<th>Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<?php if($i % 2 == 0): ?>
				<tr class="odd">
					<td><?php print $i; ?></td>
					<td><?php printf("%1\$.2f", $intereses[$i]); ?></td>
					<td><?php printf("%1\$.2f", $amortizacion[$i]); ?></td>
					<td><?php print date("d-m-Y", $fechas[$i]); ?></td>
				</tr>
			<?php else: ?>
				<tr class="even">
					<td><?php print $i; ?></td>
					<td><?php printf("%1\$.2f", $intereses[$i]); ?></td>
					<td><?php printf("%1\$.2f", $amortizacion[$i]); ?></td>
					<td><?php print date("d-m-Y", $fechas[$i]); ?></td>
				</tr>
			<?php endif; ?>
		<?php endfor; ?>
	<?php endif; ?>
</table>
<?php $total = $total_intereses + $this->monto; ?>
<div>Total de intereses a pagar <?php print $total_intereses; ?> Bs.</div>
<div>Total del préstamo <?php print $this->monto; ?> Bs.</div>
