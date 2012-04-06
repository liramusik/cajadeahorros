<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)); ?>
<?php
		include("conexion.php");
		$cedula = $_SESSION['session_cedula'];
        	$bancos = new conexion();
        	$bancos->getListarBancosEnCuentas();
        	$cuentas = new conexion();
		$cuentas->getListarCuentas();
		$tipo_transaccion = new conexion();
		$tipo_transaccion->getListarTipoTransaccion();

?>
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


	<h1>Crear Transacciones</h1>
	<form action="pages/registrar-transacciones.php" method="post" id="crear-transaccion" class="form">
		<fieldset>
			<legend>Información</legend>
			<table>
				<tr>
					<td class="etiqueta">
						<label for="cedula">Cedula<span class="obligatorio">*</span></label>
					</td>
					<td>
					<input type="text" name="cedula" id="cedula" value="<?php print $cedula; ?>" readonly="readonly" />
					</td>
				</tr>
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
						<label for="tipo">Tipo transaccion<span class="obligatorio">*</span></label>
					</td>
					<td>
						<select name="tipo" id="tipo">
							<?php while($rows = pg_fetch_object($tipo_transaccion->getQuery())): ?>
								<option value="<?php print $rows->id; ?>" <?php ($rows->id == 1) ? print "selected" : print ""; ?>><?php print $rows->tipo; ?></option>
							<?php endwhile; ?>
						</select>
					</td>
				</tr>
                  		<tr>
					<td class="etiqueta">
						<label for="fecha">Fecha<span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="fecha" id="fecha"  maxlength="40" placeholder="Fecha" autocomplete="on" required />
					</td>
				</tr>
                  		<tr>
					<td class="etiqueta">
						<label for="monto">Monto<span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="monto" id="monto"  maxlength="40" placeholder="Monto" autocomplete="on" required />
					</td>
                       		</tr>
                  		<tr>
					<td class="etiqueta">
						<label for="deposito">Deposito<span class="obligatorio">*</span></label>
					</td>
					<td>
						<input type="text" name="deposito" id="deposito"  maxlength="40" placeholder="Deposito" autocomplete="on" required />
					</td>
                       		</tr>
			</table>
		</fieldset>
		<input id="submit" type="submit" value="Aceptar" name="submit" class="boton1"/>
	</form>
