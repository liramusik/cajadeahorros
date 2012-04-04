<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	if(!isset($_POST['submit'])) {
		$listado_bancos = new connection();
		$listado_bancos->setQuery("select * from tb_bancos order by nombre;");
		$tipo_cuentas = new connection();
		$tipo_cuentas->setQuery("select * from tb_tipo_cuentas;");
		include("formulario-crear-cuentas.php");
	} else {
		$array_bancos = array();
		$nombre_banco = $_POST['nombre_banco'];
		$tipo_cuenta = $_POST['tipo_cuenta'];
		$cuenta = $_POST['cuenta'];

		$array_bancos = preg_split("/\,/", $_POST['bancos']);

		if(!in_array($nombre_banco, $array_bancos)) {
			$insertar_banco = new connection();
			$insertar_banco->setQuery("insert into tb_bancos values(default, '" . $nombre_banco . "' )");
			if(!$insertar_banco->getQuery()) {
				print "No se pudo insertar el banco";
			}
			unset($insertar_banco);
		}

		$buscar_cuenta = new connection();
		$buscar_cuenta->setQuery("select id from tb_bancos where nombre='" . $nombre_banco . "'");
		while($rows = pg_fetch_object($buscar_cuenta->getQuery())) {
			$id_banco = $rows->id;
		}

		$insertar_cuenta = new connection();
		$insertar_cuenta->setQuery("insert into tb_cuentas values(default, $id_banco, $tipo_cuenta, '" . $cuenta . "')");
		if(!$insertar_cuenta->getQuery()) {
			print '<div class="mensaje">Se ha generado un error <a href="index.php">Regresar</a></div>' . pg_last_error();
		} else {
			print '<div class="mensaje">La cuenta se ha registrado exitosamente <a href="index.php">Regresar</a></div>';
		}
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
