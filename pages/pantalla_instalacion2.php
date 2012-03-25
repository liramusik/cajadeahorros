<h1>Instalador de la Aplicacion [Parte 2]</h1>

<form action="pages/validar_usuario.php" method="post" id="login" name="login">
    <fieldset>
    	<legend>Información cuenta</legend>
    	<table>
    	<tr>
    		<td>
    			<label for="name_user">Nombre de usuario : *</label><br>
    			<input type="text" name="name_database" id="name_database" title="name_database" maxlength="60" placeholder="Nombre de usuario" autocomplete="off" required/>
    		</td>
    	</tr>
    	<tr>
		<td>
    			<label for="password">Contrasena : *</label><br>
    			<input type="password" name="password_database" id="password_database" title="Contrasena" maxlength="40" placeholder="Contrasena" autocomplete="off" required/>
    		</td>
    		<td>
    			<label for="conf_password">Confirmar contrasena: *</label><br>
    			<input type="password" name="password_database" id="password_database" title="Confirmar contrasena" maxlength="40" placeholder="Confirmar contrasena" autocomplete="off" required/>
    		<td>
    	<tr>	
    	</table>
    </fieldset>
    <p>
    <table>
    	<tr>
    		<td>
    			<input type="submit" value="Volver" class="boton1"/>
    		</td>
    		<td>
    			<input type="submit" value="Finalizar" class="boton1"/>
    		</td>
    	</tr>
    </table>
</form>
