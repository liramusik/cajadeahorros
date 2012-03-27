<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php $cedula = $_SESSION['session_cedula']; ?>

	<?php
	$monto = $_GET['monto'];
	$tiempo = $_GET['tiempo'];
	$pago = $_GET['pago'];
	?>

	<h1>Solicitud de Préstamo</h1>
	<form action="index.php?page=generar-solicitud" method="post" id="prestamo">
		<fieldset>
			<legend>Solicitud de Préstamo</legend>
			<table>
				<tr>
					<td>
						<label for="cedula">Cédula de Identidad</label>
					</td>
					<td>
						<input name="cedula" type="number" pattern="[0-9]{3,}" value="<?php print $cedula; ?>" readonly="readonly"/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="monto">Monto</label>
					</td>
					<td>
					<input name="monto" type="number" pattern="[0-9]{2,}" value="<?php print $monto; ?>" <?php isset($monto) ? print 'readonly="readonly"' : "" ?>  required/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="tiempo">Tiempo</label>
					</td>
					<td>
						<input name="tiempo" type="number" pattern="[0-9]{1,}" value="<?php print $tiempo; ?>" <?php isset($tiempo) ? print 'readonly="readonly"' : "" ?> required/>
					</td>
				</tr>
				<tr>
					<td>
						<label for="pago">Forma de pago</label>
					</td>
					<td>
						<input name="pago" type="radio" value="1" <?php if(isset($pago) and ($pago==1)) { print "checked"; } elseif(!isset($pago)) { print "checked"; } ?> /> Pago de intereses<br />
						<input name="pago" type="radio" value="2" <?php if(isset($pago) and ($pago==2)) { print "checked"; } ?> /> Pago de intereres, mas amortización a capital
					</td>
				</tr>
				<tr>
					<td>
						<label for="observacion">Observación</label>
					</td>
					<td>
						<textarea name="observacion" maxlength="250"></textarea>
					</td>
				</tr>
			</table>
		</fieldset>
		<input class="boton1" type="submit" value="Enviar" />
	</form>
<?php else: ?>
        <div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
