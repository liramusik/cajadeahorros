<h1>Usuario</h1>
<span class="obligatorio"><span class="obligatorio">*</span></span></label>

<form action="pages/validar_usuario.php" method="post" id="modificar-usuario">
	<fieldset>
		<legend>Información personal</legend>
		<table>
			<tr>
				<td class="etiqueta">
					<label for="tipo">Tipo de usuario: <span class="obligatorio">*</span></label>
				</td>
				<td>
					<?php if(($_SESSION['session_id_rol'] == 1)): ?>
						<select name="tipo">
							<?php while($rows = pg_fetch_object($x->getQuery())): ?>
								<option value="<?php print $rows->id; ?>" <?php ($id_rol == $rows->id) ? print "selected" : print ""; ?>><?php print $rows->descripcion; ?></option>
							<?php endwhile; ?>
						</select>
					<?php else: ?>
						<select name="tipo" readonly="readonly">
							<?php while($rows = pg_fetch_object($x->getQuery())): ?>
								<option value="<?php print $rows->id; ?>" <?php ($id_rol == $rows->id) ? print "selected" : print ""; ?>><?php print $rows->descripcion; ?></option>
							<?php endwhile; ?>
						</select>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="nombre">Nombre: <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="nombre" id="nombre" pattern="[a-zA-Z|(áéíóúñ)]{3,}" maxlength="40" placeholder="Nombre" autocomplete="off" value="<?php print $nombre; ?>" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="apellido">Apellido: <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="apellido" id="apellido" pattern="[a-zA-Z|(áéíóúñ)]{3,}" maxlength="40" placeholder="Apellido" autocomplete="off" value="<?php print $apellido; ?>" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="cedula">Cedula: <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="nacionalidad" id="nacionalidad" title="Nacionalidad" size="1" maxlength="1" value="<?php print $nacionalidad; ?>" readonly="readonly" required />
					<input type="text" name="cedula" id="cedula" title="Cedula" pattern="[0-9]{3,}" size="8" maxlength="20" placeholder="Cedula" autocomplete="off" value="<?php print $cedula; ?>" readonly="readonly" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="telefono">Telefono: <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="telefono" id="telefono" title="Telefono" pattern="[0-9]{11,}" maxlength="40" placeholder="Teléfono" autocomplete="off" value="<?php print $telefono; ?>" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="email">Correo electronico: <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="email" name="email" id="email" title="Correo electronico" maxlength="40" placeholder="Correo electronico" autocomplete="off" value="<?php print $email; ?>" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta direccion">
					<label for="direccion">Direccion de habitacion: <span class="obligatorio">*</span></label>
				</td>
				<td class="textarea">
					<textarea name="direccion" id="direccion" cols="40" rows="5" required ><?php print $direccion; ?></textarea>
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="fecha_ingreso">Fecha de ingreso: <span class="obligatorio">*</span></label>
				</td>
				<td>
					<?php if(($_SESSION['session_id_rol'] == 1)): ?>
						<input type="text" name="fecha_ingreso" id="fecha_ingreso" title="Fecha de ingreso" maxlength="40" placeholder="Fecha de ingreso" autocomplete="off" value="<?php print $fecha_ingreso; ?>" required />
					<?php else: ?>
						<input type="datetime" name="fecha_ingreso" id="fecha_ingreso_des" title="Fecha de ingreso" maxlength="40" placeholder="Fecha de ingreso" autocomplete="off" value="<?php print $fecha_ingreso; ?>" readonly="readonly" required />
					<?php endif; ?>
				</td>
			</tr>
			<?php if(($_SESSION['session_id_rol'] == 1)): ?>
				<tr>
					<td class="etiqueta">
						<label for="fecha_egreso">Fecha de egreso: </label>
					</td>
					<td>
						<input type="datetime" name="fecha_egreso" id="fecha_egreso" title="Fecha de egreso" maxlength="40" placeholder="Fecha de egreso" autocomplete="off" value="<?php print $fecha_egreso; ?>" />
					</td>
				</tr>
			<?php endif; ?>
		</table>
	</fieldset>
	<fieldset class="informacion-cuenta" style="margin: 10px 0;">
		<legend>Información cuenta</legend>
		<table>
			<tr>
				<td class="etiqueta">
					<label for="usuario">Usuario: <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="usuario" id="usuario" title="Usuario" maxlength="40" placeholder="Usuario" autocomplete="off" value="<?php print $usuario; ?>" readonly="readonly" required />
				</td>
			</tr>
			<tr>
				<td>
					<label for="password">Contraseña:</label>
				</td>
				<td>
					<input type="password" name="password" id="password" title="Contraseña" maxlength="40" placeholder="Contraseña" autocomplete="off" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="password">Confirmar contrasena: </label>
				</td>
				<td>
					<input type="password" name="confirmar_password" id="confirmar_password" title="Confirmar contraseña" maxlength="40" placeholder="Confirmar contraseña" autocomplete="off" />
				</td>
			</tr>
		</table>
	</fieldset>
	<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
	<div id="message"></div>
</form>
<?php unset($x); ?>
