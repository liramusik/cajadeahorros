<h1>Resultado de la Simulación</h1>
<table>
	<?php if($this->pago == 1): ?>
		<thead>
			<th class="t_cuota">Cuota</th>
			<th class="t_interes">Interés</th>
			<th class="t_fecha">Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<?php if($i % 2 == 0): ?>
				<tr class="odd">
					<td class="cuota"><?php print $i; ?></td>
					<td class="interes"><?php printf("%1\$.2f", $intereses[$i]); ?></td>
					<td class="fecha"><?php print date("d-m-Y", $fechas[$i]); ?></td>
				</tr>
			<?php else: ?>
				<tr class="even">
					<td class="cuota"><?php print $i; ?></td>
					<td class="interes"><?php printf("%1\$.2f", $intereses[$i]); ?></td>
					<td class="fecha"><?php print date("d-m-Y", $fechas[$i]); ?></td>
				</tr>
			<?php endif; ?>
		<?php endfor; ?>
	<?php elseif($this->pago == 2): ?>
		<thead>
			<th class="t_cuota">Cuota</th>
			<th class="t_interes">Interés</th>
			<th class="t_amortizacion">Amortización</th>
			<th class="t_fecha">Fecha de pago</th>
		</thead>
		<?php for($i = 1; $i <= $this->tiempo; $i++): ?>
			<?php if($i % 2 == 0): ?>
				<tr class="odd">
					<td class="cuota"><?php print $i; ?></td>
					<td class="interes"><?php printf("%1\$.2f", $intereses[$i]); ?></td>
					<td class="amortizacion"><?php printf("%1\$.2f", $amortizacion[$i]); ?></td>
					<td class="fecha"><?php print date("d-m-Y", $fechas[$i]); ?></td>
				</tr>
			<?php else: ?>
				<tr class="even">
					<td class="cuota"><?php print $i; ?></td>
					<td class="interes"><?php printf("%1\$.2f", $intereses[$i]); ?></td>
					<td class="amortizacion"><?php printf("%1\$.2f", $amortizacion[$i]); ?></td>
					<td class="fecha"><?php print date("d-m-Y", $fechas[$i]); ?></td>
				</tr>
			<?php endif; ?>
		<?php endfor; ?>
	<?php endif; ?>
</table>
<?php $total = $total_intereses + $this->monto; ?>
<div>Total de intereses a pagar <?php print $total_intereses; ?> Bs.</div>
<div>Total del préstamo <?php print $this->monto; ?> Bs.</div>
