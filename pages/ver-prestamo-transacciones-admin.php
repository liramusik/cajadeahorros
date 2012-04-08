<?php if(isset($_SESSION['session_usuario'])): ?>
<?php 
	$buscar_estatus = new conexion();
	$buscar_estatus->getEstatusSolicitudPrestamo();
?>

	<h1>Detalle de Préstamo</h1>
	<form action="index.php?page=ver-prestamo" method="post" id="solicitar-prestamo">
		<fieldset>
			<legend>Detalle del Préstamo</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="nombre">Nombre</label>
					</td>
					<td>
						<input id="nombre" name="nombre" type="text" value="<?php print $nombre . " " . $apellido; ?>" readonly="readonly" />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="estatus">Estatus</label>
					</td>
					<td>
						<select name="tipo" id="tipo">
							<?php while($rows = pg_fetch_object($buscar_estatus->getQuery())): ?>
								<option value="<?php print $rows->id; ?>" <?php ($id_estatus == $rows->id) ? print "selected" : print ""; ?>><?php print $rows->estatus; ?></option>
							<?php endwhile; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="monto">Monto Bs. </label>
					</td>
					<td>
						<input id="monto" name="monto" type="text" pattern="[0-9]{2,}" maxlength="5" value="<?php isset($monto) ? print $monto: ""; ?>" <?php isset($monto) ? print 'readonly="readonly"' : "" ?>  required />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="tiempo">Tiempo del préstamo (meses)</label>
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
						<input name="pago" type="radio" value="1" <?php if((isset($pago)) && ($pago != 1)) { print "disabled "; } if($pago == 1) { print "checked"; } ?> /> Pago de intereses<br />
						<input name="pago" type="radio" value="2" <?php if((isset($pago)) && ($pago != 2)) { print "disabled "; } if($pago == 2) { print "checked"; } ?> /> Pago por cuotas<br />
						<input name="pago" type="radio" value="3" <?php if((isset($pago)) && ($pago != 3)) { print "disabled "; } if($pago == 3) { print "checked"; } ?> /> Pago al final de cuotas + intereses
					</td>
				</tr>
				<tr>
					<td class="etiqueta observacion">
						<label for="observacion">Observación</label>
					</td>
					<td class="textarea">
						<textarea name="observacion" maxlength="250" cols="40" rows="5" ><?php print $observacion; ?></textarea>
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="respuesta">Respuesta</label>
					</td>
					<td class="textarea">
						<textarea name="respuesta" maxlength="250" cols="40" rows="5" ><?php print $respuesta; ?></textarea>
					</td>
				</tr>
			</table>
		</fieldset>
		<input name="porcentaje" type="hidden" value="<?php print $porcentaje; ?>" />
		<input class="boton1" type="submit" value="Enviar" />
	</form>
<?php else: ?>
        <div class="mensaje">Usted no posee privilegios  <a href="index.php">Regresar</a></div>
<?php endif; ?>
