<h1>Iniciar sesion</h1>

<form action="index.php?page=login" method="post" id="login" name="login">
	<fieldset>
		<legend>Acceso</legend>
		<table>
			<tr>
				<td>
					<label for="usuario">Usuario <span class="obligatorio">*</span></label><br>
					<input type="text" name="usuario" id="usuario" title="Usuario" maxlength="60" placeholder="Usuario" autocomplete="off" required />
				</td>
			</tr>
			<tr>
				<td>
					<label for="password">Contraseña <span class="obligatorio">*</span></label><br>
					<input type="password" name="password" id="password" title="Contraseña" maxlength="40" placeholder="Contraseña" autocomplete="off" required />
				</td>	
			</tr>
		</table>
	</fieldset>
	<input type="submit" value="Siguiente" class="boton1"/>
</form>
<?php
if (isset($_GET['error'])) {
	echo '<b>Usuario o clave incorrecta</b>';
}
?>
