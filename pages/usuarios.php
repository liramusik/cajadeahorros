<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$x = new conexion();
	$x->setQuery("select * from tb_roles;");
	$y = new conexion();
	$y->setQuery("select * from tb_nacionalidad;");
	?>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#crear-usuario").validate({
				rules: {
					nombre: {
						required: true,
						minlength: 3,
					},
					apellido: {
						required: true,
						minlength: 3,
					},
					cedula: {
						required: true,
						minlength: 7,
						digits: true
					},
					telefono: {
						required: true,
						minlength: 11,
						digits: true
					},
					email: {
						required: true,
						minlength: 15,
						email: true
					},
					direccion: {
						required: true,
						minlength: 15,
					},
					fecha_ingreso: {
						required: true,
						minlength: 10,
                    },
                    aporte_mensual: { 
                        required: true,
                        minlength: 2,
                        digits: true,
                        },
                    usuario: {
						required: true,
						minlength: 5,
					},
					password: {
						required: true,
						minlength: 5
					},
					confirmar_password: {
						required: true,
						minlength: 5,
						equalTo: "#password"
					}
				},
			});
		});
		$(document).ready(function() {
			$("#cedula").keydown(function(event) {
                    if(event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
                         return;
                    } else {
                        if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                            event.preventDefault(); 
                        }   
                    }
                });
            });
            $(document).ready(function() {
                $("#telefono").keydown(function(event) {
                    if(event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
                         return;
                    } else {
                        if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                            event.preventDefault(); 
                        }   
                    }
                });
            });
		$(document).ready(function() {
			$("#aporte_mensual").keydown(function(event) {
                    if(event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || (event.keyCode == 65 && event.ctrlKey === true) || (event.keyCode >= 35 && event.keyCode <= 39)) {
                         return;
                    } else {
                        if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                            event.preventDefault(); 
                        }   
                    }
                });
            });
		$(function() {
			$("#fecha_ingreso").datepicker({
                dateFormat: 'dd/mm/yy',
                    dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vier', 'Sab'],
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Séptiembre', 'Octubre', 'Noviembre', 'Diciembre']
			});
			$("#fecha_egreso").datepicker({
                dateFormat: 'dd/mm/yy',
                dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mier', 'Jue', 'Vier', 'Sab'],
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Séptiembre', 'Octubre', 'Noviembre', 'Diciembre']
			});
		});
		$(document).ready(function() { 
			var opciones = {
				success: mostrarRespuesta,
			};
			$('.form').ajaxForm(opciones);
			function mostrarRespuesta(responseText) {
				alert("Mensaje: " + responseText);
				$('.form').resetForm();
			}; 
		}); 
	</script>

	<h1>Crear Usuario</h1>
	<form action="pages/registrar-usuario.php" method="post" id="crear-usuario" class="form">
		<fieldset>
			<legend>Información personal</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="tipo">Tipo de usuario <span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="tipo" id="tipo">
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
						<label for="cedula">Cédula <span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="nacionalidad" id="nacionalidad" readonly="readonly">
							<?php while($rows = pg_fetch_object($y->getQuery())): ?>
								<option value="<?php print $rows->id; ?>" <?php ($rows->id == 1) ? print "selected" : print ""; ?>><?php print $rows->nacionalidad; ?></option>
							<?php endwhile; ?>
						</select>
						<input type="text" name="cedula" id="cedula" pattern="[0-9]{3,}" size="13" maxlength="8" placeholder="Cedula" autocomplete="on" required />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="telefono">Teléfono <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="telefono" id="telefono" pattern="[0-9]{11,}" maxlength="11" placeholder="Telefono" autocomplete="on" required />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="email">Correo electrónico <span class="obligatorio">*</span></label>
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
				</tr>
				<tr>
			        <td class="etiqueta">
						<label for="aporte_mensual">Aporte mensual <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="aporte_mensual" id="aporte_mensual" pattern="[0-9]{11,}" maxlength="10" placeholder="Aporte Mensual" autocomplete="off" required />
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
						<input type="password" name="password" id="password" maxlength="40" placeholder="Contraseña" autocomplete="off" required />
					</td>
				</tr>
				<tr>
					<td class="etiqueta">
						<label for="confirmar_password">Confirmar contraseña <span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="password" name="confirmar_password" id="confirmar_password" maxlength="40" placeholder="Confirmar Contraseña" autocomplete="off" required />
					</td>
				</tr>
			</table>
		</fieldset>
		<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
	</form>
<?php endif; ?>
