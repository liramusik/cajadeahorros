<h1>configuracion caja de ahorro [Parte 1]</h1>

<form action="pages/validar_usuario.php" method="post" id="login" name="login">
    <fieldset>
        <legend>Datos de la caja de ahorro</legend>
    <table>
        <tr>
        	<td>
        		<label for="name_box">Nombre de la caja de ahorro : *</label><br>
        		<input type="text" name="name_box" id="name_box" title="name_box" maxlength="60" placeholder="Nombre de la caja de ahorro" autocomplete="off" required/>
        	</td>
        	<td>
        		<label for="rif">Rif : *</label><br>
        		<input type="rif" name="rif" id="rif" title="rif" maxlength="40" placeholder="Rif" autocomplete="off" required/>
        	</td>
        </tr>
        <tr>
        	<td>
        		<label for="representante">Representante legal : *</label><br>
        		<input type="representante" name="representante" id="representante" title="Representane Legal" maxlength="40" placeholder="Representante legal" autocomplete="off" required/>
        	</td>
        	<td>
        		<label for="cedula">Cedula : *</label><br>
        		<input type="cedula" name="cedula" id="cedula" title="Cedula de identidad" maxlength="40" placeholder="Cedula" autocomplete="off" required/>
        	</td>
        </tr>
        <tr>
        	<td>
        		<label for="direccion">Direccion fiscal : *</label><br>
        		<input type="direccion" name="direccion" id="direccion" title="Direccion Legal" maxlength="40" placeholder="Direccion legal" autocomplete="off" required/>
        	</td>
        </tr>
    </table>
    </fieldset>
    <p>
    <input type="submit" value="Siguiente" class="boton1"/>
   
</form>
