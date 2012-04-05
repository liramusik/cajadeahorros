<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	if(!isset($_POST['submit'])) {
		$bancos = new connection();
		$bancos->setQuery("select id_banco, nombre from tb_cuentas left join tb_bancos on tb_bancos.id = tb_cuentas.id_banco");
		$cuentas = new connection();
		$cuentas->setQuery("select id, id_banco, cuenta from tb_cuentas;");
		include("formulario-registrar-interes.php");
		unset($bancos);
		unset($cuentas);
	} else {
		$cuentas = $_POST['cuentas'];
		$fecha = $_POST['fecha'];
		$monto = $_POST['monto'];

		$fecha_split = preg_split("/\//", $fecha);
		$fecha = $fecha_split[2] . '-' . $fecha_split[1] . '-' . $fecha_split[0];

		$hora = date("H:i:s", time());

		$fecha .= " " . $hora;

		$interes = new connection();
		$interes->setQuery("insert into tb_intereses values(default, $cuentas, '" . $fecha . "', $monto)");
		if(!$interes->getQuery()) {
			print '<div class="mensaje">Ha ocurrido un error inesperado <a href="index.php">Regresar</a></div>' . pg_last_error();
		} else {
			print '<div class="mensaje">La inserción se ha realizado con éxito, <a href="index.php">Regresar</a></div>';
		}
		unset($interes);
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>