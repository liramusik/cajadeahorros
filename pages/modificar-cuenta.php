<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	if(!isset($_POST['submit'])) {
		$cuenta = $_GET['cuenta'];

		$c->setQuery("select tb_cuentas.id, nombre, cuenta, id_tipo_cuenta from tb_cuentas left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id left join tb_tipo_cuentas on tb_cuentas.id_tipo_cuenta = tb_tipo_cuentas.id where tb_cuentas.id=$cuenta");

		$tipo_cuentas = new connection();
		$tipo_cuentas->setQuery("select * from tb_tipo_cuentas");

		while($rows = pg_fetch_object($c->getQuery())) {
			$id_cuenta = $rows->id;
			$nombre = $rows->nombre;
			$cuenta = $rows->cuenta;
			$id_tipo_cuenta = $rows->id_tipo_cuenta;
		}
		include("formulario-modificar-cuentas.php");
		unset($tipo_cuentas);
		unset($c);

	} else {
		$id_cuenta = $_POST['id_cuenta'];

		$buscar = new connection();
		$buscar->setQuery("select id_banco, id_tipo_cuenta, cuenta from tb_cuentas where id=$id_cuenta");

		while($rows = pg_fetch_object($buscar->getQuery())) {
			$db_id_banco = $rows->id_banco;
			$db_tipo_cuenta = $rows->id_tipo_cuenta;
			$db_cuenta = $rows->cuenta;
		}

		$array_bancos = array();
		$post_nombre_banco = $_POST['nombre_banco'];
		$post_tipo_cuenta = $_POST['tipo_cuenta'];
		$post_cuenta = $_POST['cuenta'];

		$array_bancos = preg_split("/\,/", $_POST['bancos']);

		if(!in_array($post_nombre_banco, $array_bancos)) {
			$actualizar_banco = new connection();
			$actualizar_banco->setQuery("update tb_bancos set nombre='" . $post_nombre_banco . "' where id=$db_id_banco;");
			if(!$actualizar_banco->getQuery()) {
				print "No se puede actualizar nombre el nonbre del banco por $post_nombre_banco";
			}
		}
		unset($actualizar_banco);

		if(($db_cuenta != $post_cuenta) || ($db_tipo_cuenta !=$post_tipo_cuenta)) { 
			$actualizar = new connection();
                        $actualizar->setQuery("update tb_cuentas set cuenta='" . $post_cuenta . "', id_tipo_cuenta=$post_tipo_cuenta where id=$id_cuenta");
			if(!$actualizar->getQuery()) {
			       print "<p>No se pudo modificar la cuenta del Banco: $post_cuenta </p>";
			}
		}
		unset($actualizar);
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
