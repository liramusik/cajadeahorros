<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php $cedula = $_SESSION['session_cedula']; ?>

	<?php
	if(isset($_GET['monto'])) { $monto = $_GET['monto']; }
	if(isset($_GET['tiempo'])) { $tiempo = $_GET['tiempo']; }
	if(isset($_GET['pago'])) { $pago = $_GET['pago']; }
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
						<input name="pago" type="radio" value="1" <?php if(isset($pago) and ($pago==1)) { print "checked "; print "readonly='readonly '"; } elseif(!isset($pago)) { print "checked "; } else { print "disabled"; } ?> /> Pago de intereses<br />
						<input name="pago" type="radio" value="2" <?php if(isset($pago) and ($pago==2)) { print "checked "; print "readonly='readonly '"; } elseif($pago == 1) { print "readonly='readonly'"; } ?> /> Pago de intereres, mas amortización a capital
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
