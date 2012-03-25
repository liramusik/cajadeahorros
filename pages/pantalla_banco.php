<h1>Banco</h1>

<form action="pages/validar_usuario.php" method="post" id="banco" name="banco">
    <fieldset>
    <legend>Datos del banco</legend>
    <table>
    	<tr>
    		<td>
    			<label for="name_bank">Nombre : *</label><br>
    			<input type="text" name="name_bank" id="name_bank" title="Nombre del banco" pattern="[a-zA-Z][0-9]{3,}" maxlength="60" placeholder="Nombre del banco" autocomplete="off" required/>
    		</td>
    	<tr>
    	</tr>
    		<td>
    			<label for="tipo_bank">Tipo de cuenta : *</label>
    			<select name="select">
    				<option value="Option 1" selected>Corriente</option>
    				<option value="Option 2">Ahorro</option>
    			</select>
    		</td>
    		<td>
    			<label for="number_bank">Numero de cuenta : *</label><br>
    			<input type="number" name="number_bank" id="number_bank" title="Numero de cuenta" pattern="[0-9]{20,}" maxlength="40" placeholder="Numero de cuenta" autocomplete="off" required/>
    		</td>
    	<tr>
    </table>
    </fieldset>
    <p>
   <input type="submit" value="Siguiente" class="boton1"/>
</form>
