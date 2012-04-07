<?php $cedula = $_SESSION['session_cedula']; ?>
<script type="text/javascript">
	$(document).ready(function() { 
		var opciones = {
			success: redireccionar,
		};
		$('.form').ajaxForm(opciones);
		function redireccionar(parametros) {
		}; 
	}); 
</script>

<h1>Simulación</h1>
<form action="index.php?page=generar-simulacion" method="post" id="simular">
	<fieldset>
		<legend>Datos de la Simulación</legend>
		<table id="listado">
			<tr>
				<td class="etiqueta">
					<label for="cedula">Cédula de Identidad</label>
				</td>
				<td>
					<input id="cedula" name="cedula" type="text" value="<?php print $cedula; ?>" readonly="readonly" />
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
					<label for="pago">Forma de pago</label>
				</td>
				<td>
					<input name="pago" type="radio" value="1" checked /> Pago de intereses<br />
					<input name="pago" type="radio" value="2" /> Pago por cuotas<br />
					<input name="pago" type="radio" value="3" /> Pago al final de cuotas + intereses
				</td>
			</tr>
		</table>
	</fieldset>
	<input class="boton1" type="submit" value="Generar simulación" />
</form>
