<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$cedula = $_SESSION['session_cedula'];
	$bancos = new conexion();
	$bancos->getListarBancosEnCuentas();
	$cuentas = new conexion();
	$cuentas->getListarCuentas();
	$tipo_transaccion = new conexion();
	$tipo_transaccion->getListarTipoTransaccion1y2();
	?>
	<script type="text/javascript">
		var bancos = [
			<?php
			while($rows = pg_fetch_object($bancos->getQuery())) {
			      print "{'id_banco':'$rows->id_banco','banco':'$rows->nombre'},";
			}
			?>
		];
		var cuentas = [
			<?php
			while($rows = pg_fetch_object($cuentas->getQuery())) {
				print "{'id_banco':'$rows->id_banco','id':'$rows->id','cuenta':'$rows->cuenta'},";
			}
			?>
		];
	</script>
	<script type="text/javascript" src="/cajadeahorros/js/validar-registrar-transaccion.js">
	</script>

	<h1>Registrar Transacciones</h1>
	<form action="pages/registrar-transacciones.php" method="post" id="crear-transaccion" class="form">
		<fieldset>
			<legend>Información</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="cedula">Cédula <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="cedula" id="cedula" value="<?php print $cedula; ?>" readonly="readonly" />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="bancos">Banco <span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="bancos" id="bancos">
							<option></option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="cuentas">Cuentas <span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="cuentas" id="cuentas">
							<option></option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="tipo">Tipo transacción <span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="tipo" id="tipo">
							<?php while($rows = pg_fetch_object($tipo_transaccion->getQuery())): ?>
								<option value="<?php print $rows->id; ?>" <?php ($rows->id == 1) ? print "selected" : print ""; ?>><?php print $rows->tipo; ?></option>
							<?php endwhile; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="fecha">Fecha <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="datetime" name="fecha" id="fecha" maxlength="40" placeholder="Fecha" autocomplete="on" required />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="monto">Monto Bs. <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="monto" id="monto" pattern="[0-9]{11,}" maxlength="20" placeholder="Monto Bs." autocomplete="on" required />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="deposito">Deposito <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="deposito" id="deposito" pattern="[0-9]{11,}" maxlength="20" placeholder="Depósito" autocomplete="on" required />
					</td>
				</tr>
			</table>
		</fieldset>
		<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
	</form>
<?php endif; ?>
