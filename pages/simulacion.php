<?php $cedula = $_SESSION['session_cedula']; ?>

<h1>Simulación</h1>
<form action="index.php?page=generar-simulacion" method="post">
	<fieldset>
		<legend>Datos de la Simulación</legend>
		<table>
			<tr>
				<td>
					<label for="cedula">Cédula de Identidad</label>
					<input name="cedula" type="text" value="<?php print $cedula; ?>" disabled />
				</td>
			</tr>
			<tr>
				<td>
					<label for="monto">Monto</label>
					<input name="monto" type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="tiempo">Tiempo</label>
					<input name="tiempo" type="text" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="pago">Forma de pago
						<input name="pago" type="radio" /> Pago de intereses
						<input name="pago" type="radio" /> Pago de intereres, mas amortización a capital
					</label>
				</td>
			</tr>
		</table>
	</fieldset>
	<input class="boton1" type="submit" value="Generar simulación" />
</form>
