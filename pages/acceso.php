<h1>Instalador de la Aplicacion</h1>

<form action="pages/validar_usuario.php" method="post" id="login" name="login">
    <fieldset>
        <label for="usuario">Nombre de la Base de Datos :</label><br>
        <input type="text" name="name_database" id="name_database" title="name_database" maxlength="60" placeholder="Nombre de la Base de Datos" autocomplete="off" required/>
        <p>
        <label for="Clave">Direccion de IP del servidor de la BD :</label><br>
        <input type="text" name="ip_database" id="ip_database" title="ip_database" maxlength="40" placeholder="Direccion de IP del servidor de la BD" autocomplete="off" required/>
        <p>
        <label for="Clave">Usuario de la BD :</label><br>
        <input type="text" name="user_database" id="user_database" title="user_database" maxlength="40" placeholder="Usuario de la BD" autocomplete="off" required/>
        <p>
        <label for="Clave">Contrasena de la BD :</label><br>
        <input type="password" name="password_database" id="password_database" title="password_database" maxlength="40" placeholder="Contrasena de la BD" autocomplete="off" required/>
        <p>
         <label for="Clave">Confirmar contrasena de la BD :</label><br>
        <input type="password" name="password_database" id="password_database" title="password_database" maxlength="40" placeholder="Confirmar contrasena de la BD" autocomplete="off" required/>
        <p>
        <input type="submit" value="Siguiente" class="boton1"/>
         <div id="message"></div>
    </fieldset>
   
</form>
