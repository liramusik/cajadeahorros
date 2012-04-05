<script type="text/javascript">
	var bancos = [
		<?php
		while($rows = pg_fetch_object($bancos->getQuery())) {
			print "{'id_banco':'$rows->id_banco','banco':'$rows->nombre'},";
		}
		?>
	];
	var cuentas = [
		<?php
		while($rows = pg_fetch_object($cuentas->getQuery())) {
			print "{'id_banco':'$rows->id_banco','id':'$rows->id','cuenta':'$rows->cuenta'},";
		}
		?>
	];
	$(document).ready(function() {
		var sbancos = '<option value=""></option>';
		$(bancos).each(function(i) {
			sbancos += '<option value="'+this.id_banco+'">'+this.banco+'</option>';
		});
		$('#bancos').html(sbancos);
                $('#bancos').change(function() {
                        var banco = $('#bancos').val();
                        var pcuentas = $.grep(cuentas,function(n,i) {
				return (n.id_banco == banco); 
			});
                        var scuentas = '<option value=""></option>';
                        $(pcuentas).each(function(i) {
                                scuentas += '<option value="'+this.id+'">'+this.cuenta+'</option>';
                        });
                        $('#cuentas').html(scuentas);
                });
	});
</script>
<h1>Registrar Interéses</h1>
<form action="index.php?page=registrar-intereses" method="post" id="registrar-interes">
	<fieldset>
		<legend>Registrar Interés</legend>
		<table>
			<tr>
				<td class="etiqueta">
					<label for="bancos">Banco <span class="obligatorio">*</span></label>
				</td>
				<td>
					<select name="bancos" id="bancos">
						<option></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="cuentas">Cuentas <span class="obligatorio">*</span></label>
				</td>
				<td>
					<select name="cuentas" id="cuentas">
						<option></option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="fecha">Fecha <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="datetime" name="fecha" id="fecha" maxlength="40" placeholder="Fecha" autocomplete="on" required />
				</td>
			</tr>
			<tr>
				<td class="etiqueta">
					<label for="monto">Monto <span class="obligatorio">*</span></label>
				</td>
				<td>
					<input type="text" name="monto" id="monto" maxlength="20" pattern="[0-9]{3,}" placeholder="Monto" autocomplete="on" required />
				</td>
			</tr>
		</table>
	</fieldset>
	<input id="submit" type="submit" value="Registrar" name="submit" class="boton1"/>
	<div id="message"></div>
</form>
