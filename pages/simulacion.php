<?php $cedula = $_SESSION['session_cedula']; ?>
<script type="text/javascript">
	$(document).ready(function() { 
		$('#simular').submit(function(e){
			e.preventDefault();
			var cedula = $('#cedula').attr('value');
			var monto = $('#monto').attr('value');
			var tiempo = $('#tiempo').attr('value');
			var tipo_pago = $('input[type=radio]:checked').attr('value');
			var id_rol = $('#id_rol').attr('value');
			$("#contenido").load("includes/pages.php?page=generar-simulacion&cedula="+cedula+"&monto="+monto+"&tiempo="+tiempo+"&tipo_pago="+tipo_pago+"&id_rol="+id_rol);
		})
	}); 
</script>

<h1>Simulación</h1>
<form action="pages/generar-simulacion.php" method="post" id="simular">
	<fieldset>
		<legend>Datos de la Simulación</legend>
		<table id="listado">
			<tr>
				<td class="etiqueta">
					<label for="cedula">Cédula de Identidad</label>
				</td>
				<td>
					<input id="cedula" name="cedula" type="text" value="<?php print $cedula; ?>" readonly="readonly" />
					<input id="id_rol" name="id_rol" type="hidden" value="<?php print $_SESSION['session_id_rol']; ?>" readonly="readonly" />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="monto">Monto</label>
				</td>
				<td>
					<input id="monto" name="monto" type="text" pattern="[0-9]{2,}" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="tiempo">Tiempo del préstamo (meses)</label>
				</td>
				<td>
					<input id="tiempo" name="tiempo" type="text" pattern="[0-9]{1,}" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta pago">
					<label for="tipo_pago">Forma de pago</label>
				</td>
				<td>
					<input name="tipo_pago" type="radio" value="1" checked /> Pago de intereses<br />
					<input name="tipo_pago" type="radio" value="2" /> Pago por cuotas<br />
					<input name="tipo_pago" type="radio" value="3" /> Pago al final de cuotas + intereses
				</td>
			</tr>
		</table>
	</fieldset>
	<input id="enviar" class="boton1" type="submit" value="Generar simulación" />
</form>
