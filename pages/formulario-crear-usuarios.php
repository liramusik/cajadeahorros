<h1>Crear Usuario</h1>
<form action="index.php?page=crear-usuarios" method="post" id="agregar-usuario">
	<fieldset>
		<legend>Información personal</legend>
		<table>
			<tr>
				<td class="etiqueta">
					<label for="tipo">Tipo de usuario <span class="obligatorio">*</span></label>
				</td>
				<td>
					<select name="tipo">
						<?php while($rows = pg_fetch_object($x->getQuery())): ?>
							<option value="<?php print $rows->id; ?>" <?php ($rows->id == 2) ? print "selected" : print ""; ?>><?php print $rows->descripcion; ?></option>
						<?php endwhile; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="nombre">Nombre <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="nombre" id="nombre" pattern="[a-zA-Z|(áéíóúñ)]{3,}" maxlength="40" placeholder="Nombre" autocomplete="on" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="apellido">Apellido <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="apellido" id="apellido" pattern="[a-zA-Z|(áéíóúñ)]{3,}" maxlength="40" placeholder="Apellido" autocomplete="on" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="cedula">Cedula <span class="obligatorio">*</span></label>
				</td>
				<td>
					<select name="nacionalidad" readonly="readonly">
						<?php while($rows = pg_fetch_object($y->getQuery())): ?>
							<option value="<?php print $rows->id; ?>" <?php ($rows->id == 1) ? print "selected" : print ""; ?>><?php print $rows->nacionalidad; ?></option>
						<?php endwhile; ?>
					</select>
					<input type="text" name="cedula" id="cedula" pattern="[0-9]{3,}" size="13" maxlength="8" placeholder="Cedula" autocomplete="on" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="telefono">Telefono <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="telefono" id="telefono" pattern="[0-9]{11,}" maxlength="11" placeholder="Telefono" autocomplete="on" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="email">Correo electronico <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="email" name="email" id="email" maxlength="40" placeholder="Email" autocomplete="on" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta direccion">
					<label for="direccion">Dirección <span class="obligatorio">*</span></label>
				</td>
				<td class="textarea">
					<textarea name="direccion" id="direccion" cols="40" rows="5" required ></textarea>
				<td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="fecha_ingreso">Fecha de ingreso <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="datetime" name="fecha_ingreso" id="fecha_ingreso" maxlength="40" placeholder="Fecha de ingreso" autocomplete="on" required />
				</td>
			</tr>
		</table>
	</fieldset>
	<fieldset class="informacion-cuenta" style="margin: 10px 0;">
		<legend>Información cuenta</legend>
		<table>
			<tr>
				<td class="etiqueta">
					<label for="usuario">Usuario <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="usuario" id="usuario" maxlength="40" placeholder="Usuario" autocomplete="on" required/>
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="password">Contraseña <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="password" name="password" id="password" maxlength="40" placeholder="Contrasena" autocomplete="off" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="confirmar_password">Confirmar contraseña <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="password" name="confirmar_password" id="confirmar_password" maxlength="40" placeholder="Confirmar Password" autocomplete="off" required />
				</td>
			</tr>
		</table>
	</fieldset>
	<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
	<div id="message"></div>
</form>
