<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	if(!isset($_POST['submit'])) {
		$bancos = new connection();
		$bancos->setQuery("select id_banco, nombre from tb_cuentas left join tb_bancos on tb_bancos.id = tb_cuentas.id_banco");
		$cuentas = new connection();
		$cuentas->setQuery("select id, id_banco, cuenta from tb_cuentas;");
		include("formulario-registrar-interes.php");
	} else {
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
