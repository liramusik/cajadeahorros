<h1>Configuracion caja de ahorro [Parter 2]</h1>

<form action="pages/validar_usuario.php" method="post" id="confi2" name="config2">
    <fieldset>
    <legend>Datos de la caja de ahorro</legend>
    <table>
        <tr>
        	<td> 
        		<label for="phone_box">Telefono caja de ahorro : *</label><br>
        		<input type="number" name="phone_box" id="phone_box" title="Telefono caja de ahorro" pattern="[0-9]{11,}" maxlength="60" placeholder="Telefono de la caja de ahorro" autocomplete="off" required/>
        	</td>
        </tr>
        <tr>
        	<td>
        		<label for="phone_master">Telefono representante legal : *</label><br>
        		<input type="number" name="phone_master" id="phone_master" title="Telefono representante legal" pattern="[0-9]{11,}" maxlength="40" placeholder="Telefono del representante legal" autocomplete="off" required/>
        	</td>
        	<td>
        		<label for="mail_master">Correo del representante legal : *</label><br>
        		<input type="email" name="mail_master" id="mail_master" title="Correo del representante legal" maxlength="40" placeholder="Correo representante legal" autocomplete="off" required/>
        	</td>
        </tr>
        <tr>
        	<td>
        		<label for="logo">Logo de la caja de ahorro : *</label><br>
        		<input type="text" name="logo" id="logo" title="Logo de la caja de ahorro" maxlength="40" placeholder="Logo de la caja de ahorro" autocomplete="off" required/>
        	</td>
        	<td>
        		<input type="submit" value="examinar" class="boton1"/>
        	</td>
        </tr>
    </table>
    </fieldset>
    <p>
    <table>
        <tr>
        	<td> 
        		<input type="submit" value="SIGUIENTE" class="boton1"/>
        	<td>
        </tr>
    <table>
</form>
