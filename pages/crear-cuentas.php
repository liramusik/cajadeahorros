<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	if(!isset($_POST['submit'])) {
		$listado_bancos = new connection();
		$listado_bancos->setQuery("select * from tb_bancos;");
		$tipo_cuentas = new connection();
		$tipo_cuentas->setQuery("select * from tb_tipo_cuentas;");
		include("formulario-crear-cuentas.php");
	} else {
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
