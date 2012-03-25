<h1>configuracion caja de ahorro [Parte 1]</h1>

<form action="pages/validar_usuario.php" method="post" id="config1" name="config1">
    <fieldset>
        <legend>Datos de la caja de ahorro</legend>
    <table>
        <tr>
        	<td>
        		<label for="name_box">Nombre de la caja de ahorro : *</label><br>
        		<input type="text" name="name_box" id="name_box" title="name_box"  pattern="[a-zA-Z][0-9]{3,}" maxlength="60" placeholder="Nombre de la caja de ahorro" autocomplete="off" required/>
        	</td>
        	<td>
        		<label for="rif_box">Rif : *</label><br>
        		<input type="text" name="rif_box" id="rif_box" title="Rif" pattern="[a-zA-Z][0-9]{3,}" maxlength="40" placeholder="Rif" autocomplete="off" required/>
        	</td>
        </tr>
        <tr>
        	<td>
        		<label for="master_box">Representante legal : *</label><br>
        		<input type="text" name="master_box" id="master_box" title="Representane Legal" pattern="[a-zA-Z][0-9]{3,}" maxlength="40" placeholder="Representante legal" autocomplete="off" required/>
        	</td>
        	<td>
        		<label for="id_box">Cedula : *</label><br>
        		<input type="number" name="id_box" id="id_box" title="Cedula de identidad" pattern="[0-9]{3,}" maxlength="40" placeholder="Cedula" autocomplete="off" required/>
        	</td>
        </tr>
        <tr>
        	<td>
        		<label for="address_box">Direccion fiscal : *</label><br>
        		<input type="text" name="address_box" id="address_box" title="Direccion Legal" pattern="[a-zA-Z][0-9]{3,}" maxlength="40" placeholder="Direccion legal" autocomplete="off" required/>
        	</td>
        </tr>
    </table>
    </fieldset>
    <p>
    <input type="submit" value="Siguiente" class="boton1"/>
   
</form>
