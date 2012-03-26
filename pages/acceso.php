<h1>Iniciar sesion</h1>

<form action="index.php?page=login" method="post" id="login" name="login">
	<fieldset>
		<legend>Acceso</legend>
		<table>
			<tr>
				<td>
					<label for="user_login">Usuario :</label><br>
					<input type="text" name="user_login" id="user_login" title="Usuario" maxlength="60" placeholder="Usuario" autocomplete="off" required/>
				</td>
			</tr>
			<tr>
				<td>
					<label for="password_login">Contrasena :</label><br>
					<input type="password" name="password_login" id="password_login" title="contrasena" maxlength="40" placeholder="Password" autocomplete="off" required/>
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
