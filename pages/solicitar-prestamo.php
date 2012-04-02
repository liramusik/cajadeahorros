<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$cedula = $_SESSION['session_cedula'];
	if(isset($_GET['monto'])) { $monto = $_GET['monto']; }
	if(isset($_GET['tiempo'])) { $tiempo = $_GET['tiempo']; }
	if(isset($_GET['pago'])) { $pago = $_GET['pago']; }
	if(isset($_GET['porcentaje'])) {
		$porcentaje = $_GET['porcentaje'];
	} else {
		$rol = $_SESSION['session_id_rol'];
		$x = new connection();
		$x->setQuery("select porcentaje from tb_porcentajes where id_roles=$rol order by fecha desc limit 1;");
		while($rows = pg_fetch_object($x->getQuery())) {
			$porcentaje = $rows->porcentaje;
		}
		unset($x);
	}
	?>

	<h1>Solicitar Préstamo</h1>
	<form action="index.php?page=generar-solicitud" method="post" id="solicitar-prestamo">
		<fieldset>
			<legend>Solicitud de Préstamo</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="cedula">Cédula de Identidad</label>
					</td>
					<td>
						<input id="cedula" name="cedula" type="text" pattern="[0-9]{3,}" value="<?php print $cedula; ?>" readonly="readonly" />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="monto">Monto</label>
					</td>
					<td>
						<input id="monto" name="monto" type="text" pattern="[0-9]{2,}" maxlength="5" value="<?php isset($monto) ? print $monto: ""; ?>" <?php isset($monto) ? print 'readonly="readonly"' : "" ?>  required />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="tiempo">Tiempo</label>
					</td>
					<td>
						<input id="tiempo" name="tiempo" type="text" pattern="[0-9]{1,}" maxlength="2" value="<?php isset($tiempo) ? print $tiempo : ""; ?>" <?php isset($tiempo) ? print 'readonly="readonly"' : "" ?> required />
					</td>
				</tr>
				<tr>
					<td class="etiqueta pago">
						<label for="pago">Forma de pago</label>
					</td>
					<td>
						<input name="pago" type="radio" value="1" <?php if(isset($pago) and ($pago==1)) { print "checked "; print "readonly='readonly '"; } elseif(!isset($pago)) { print "checked "; } else { print "disabled"; } ?> /> Pago de intereses<br />
						<input name="pago" type="radio" value="2" <?php if(isset($pago) and ($pago==2)) { print "checked "; print "readonly='readonly '"; } elseif(isset($pago) && ($pago == 1)) { print "readonly='readonly'"; } ?> /> Pago de intereres, mas amortización a capital
					</td>
				</tr>
				<tr>
					<td class="etiqueta observacion">
						<label for="observacion">Observación</label>
					</td>
					<td class="textarea">
						<textarea name="observacion" maxlength="250" cols="40" rows="5"></textarea>
					</td>
				</tr>
			</table>
		</fieldset>
		<input name="porcentaje" type="hidden" value="<?php print $porcentaje; ?>" />
		<input class="boton1" type="submit" value="Enviar" />
	</form>
<?php else: ?>
        <div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
