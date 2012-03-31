<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$db_hostname = "localhost";
	$db_database = "db_cadeveher";
	$db_username = "user_cadeveher";
	$db_password = "123456";

	$db_connect = pg_connect("host=$db_hostname dbname=$db_database user=$db_username password=$db_password") or die ("Imposible conectarse al servidor " . pg_last_error());

	$cedula = $_GET['cedula'];

	$query_usuarios = "select cedula, nombre, apellido, telefono, email, direccion, to_char(fecha_ingreso, 'DD-MM-YYYY') as fecha_ingreso, to_char(fecha_egreso, 'DD-MM-YYYY') as fecha_egreso, nacionalidad, id_rol, usuario from tb_usuarios left join tb_nacionalidad on id_nacionalidad = tb_nacionalidad.id left join tb_roles on id_rol = tb_roles.id where cedula=$cedula";
	$query_roles = "select * from tb_roles";

	$result_usuarios = pg_query($db_connect, $query_usuarios);
	if(!$result_usuarios) {
		print "Error" . pg_last_error();
	}

	$result_roles = pg_query($db_connect, $query_roles);
	if(!$result_roles) {
		print "Error" . pg_last_error();
	}

	while($rows = pg_fetch_object($result_usuarios)) {
		$cedula = $rows->cedula;
		$nombre = $rows->nombre;
		$apellido = $rows->apellido;
		$telefono = $rows->telefono;
		$email = $rows->email;
		$direccion = $rows->direccion;
		$fecha_ingreso = $rows->fecha_ingreso;
		$fecha_egreso = $rows->fecha_egreso;
		$nacionalidad = $rows->nacionalidad;
		$id_rol = $rows->id_rol;
		$usuario = $rows->usuario;
	}
	?>
	<?php if(($_SESSION['session_id_rol'] == 1) || ($_SESSION['session_cedula'] == $cedula)) : ?>
		<h1>Usuario</h1>

		<form action="pages/validar_usuario.php" method="post" id="usuario" name="usuario">
			<fieldset>
				<legend>Información personal</legend>
				<table>
					<tr>
						<td>
							<label for="tipe_user">Tipo de usuario: *</label>
							<?php if(($_SESSION['session_id_rol'] == 1)): ?>
								<select name="select">
									<?php while($rows = pg_fetch_object($result_roles)): ?>
										<option value="<?php print $rows->id; ?>" <?php ($id_rol == $rows->id) ? print "selected" : print ""; ?>><?php print $rows->descripcion; ?></option>
									<?php endwhile; ?>
								</select>
							<?php else: ?>
								<select name="select" readonly="readonly">
									<?php while($rows = pg_fetch_object($result_roles)): ?>
										<option value="<?php print $rows->id; ?>" <?php ($id_rol == $rows->id) ? print "selected" : print ""; ?>><?php print $rows->descripcion; ?></option>
									<?php endwhile; ?>
								</select>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>
							<label for="name_user">Nombre : *</label><br>
							<input type="text" name="name_user" id="name_user" title="Nombre"  pattern="[a-zA-Z ]{3,}" maxlength="40" placeholder="Nombre" autocomplete="off" value="<?php print $nombre; ?>" required />
						</td>
						<td>
							<label for="surname_user">Apellido : *</label><br>
							<input type="text" name="surname_user" id="surname_user" title="Apellido" pattern="[a-zA-Z ]{3,}" maxlength="40" placeholder="Apellido" autocomplete="off" value="<?php print $apellido; ?>" required />
						</td>
					</tr>
					<tr>
						<td>
							<label for="id_user">Cedula : *</label>        		
							<input type="number" name="nacionalidad" id="nacionalidad" title="Nacionalidad" size="1" maxlength="1" value="<?php print $nacionalidad; ?>" readonly="readonly" required />
							<input type="number" name="id_user" id="cedula" title="Cedula" pattern="[0-9]{3,}" size="8" maxlength="20" placeholder="Cedula" autocomplete="off" value="<?php print $cedula; ?>" readonly="readonly" required />
						</td>
						<td>
							<label for="phone_user">Telefono : *</label><br>
							<input type="number" name="phone_user" id="phone_user" title="Telefono" pattern="[0-9]{11,}" maxlength="40" placeholder="Telefono" autocomplete="off" value="<?php print $telefono; ?>"required/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="email_user">Correo electronico : *</label><br>
							<input type="email" name="email_user" id="email_user" title="Correo electronico del usuario" maxlength="40" placeholder="Correo electronico" autocomplete="off" value="<?php print $email; ?>" required/>
						</td>   
						<td>
							<label for="address_user">Direccion de habitacion : *</label><br>
							<input type="text" name="address_user" id="address_user" title="Direccion de habitacion" maxlength="40" placeholder="Direccion de habitacion" autocomplete="off" value="<?php print $direccion; ?>" required/>
						<td>
					</tr>
					<tr>
						<td>
							<label for="datein_user">Fecha de ingreso : *</label><br>
							<?php if(($_SESSION['session_id_rol'] == 1)): ?>
								<input type="number" name="datein_user" id="datein_user" title="Fecha de ingreso" maxlength="40" placeholder="Fecha de ingreso" autocomplete="off" value="<?php print $fecha_ingreso; ?>" required />
							<?php else: ?>
								<input type="number" name="datein_user" id="datein_user" title="Fecha de ingreso" maxlength="40" placeholder="Fecha de ingreso" autocomplete="off" value="<?php print $fecha_ingreso; ?>" readonly="readonly" required />
							<?php endif; ?>
						</td>
						<td>
							<label for="datexit_user">Fecha de egreso : *</label><br>
							<input type="number" name="datexit_user" id="datexit_user" title="Fecha de egreso" maxlength="40" placeholder="Fecho de egreso" autocomplete="off" value="<?php print $fecha_egreso; ?>" readonly="readonly" required />
						</td>
					</tr>
				</table>
			</fieldset>
			<fieldset class="informacion-cuenta" style="margin: 10px 0;">
				<legend>Información cuenta</legend>
				<table>
					<tr>
						<td>
							<label for="user_user">Usuario : *</label><br>
							<input type="text" name="user_user" id="user_user" title="Usuario" maxlength="40" placeholder="Usuario" autocomplete="off" value="<?php print $usuario; ?>" readonly="readonly" required/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="password_user">Contrasena : *</label><br>
							<input type="password" name="password_user" id="password_user" title="Contrasena" maxlength="40" placeholder="Contrasena" autocomplete="off" required/>
						</td>
						<td>
							<label for="confir_user">Confirmar contrasena : *</label><br>
							<input type="password" name="confir_user" id="confir_user" title="Confirmar contrasena" maxlength="40" placeholder="Confirmar contrasena" autocomplete="off" required/>
						</td>
					</tr>
				</table>
			</fieldset>
			<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
			<div id="message"></div>
		</form>
	<?php else: ?>
		<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
	<?php endif; ?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
