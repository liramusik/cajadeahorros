<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	if(!isset($_POST['submit'])) {
		
		$cuenta = $_GET['cuenta'];

		$c->setQuery("select nombre, cuenta, id_tipo_cuenta from tb_cuentas left join tb_bancos on tb_cuentas.id_banco = tb_bancos.id left join tb_tipo_cuentas on tb_cuentas.id_tipo_cuenta = tb_tipo_cuentas.id where tb_cuentas.id=$cuenta");

		$tipo_cuentas= new connection();
		$tipo_cuentas->setQuery("select * from tb_tipo_cuentas");

		while($rows = pg_fetch_object($c->getQuery())) {
			$nombre = $rows->nombre;
			$cuenta = $rows->cuenta;
			$id_tipo_cuenta = $rows->id_tipo_cuenta;
		}
		include("formulario-modificar-cuentas.php");
		unset($tipo_cuentas);

	} else {
		$cuenta = $_POST['cuenta'];
		$buscar = new connection();
		$buscar->setQuery("select id_banco, id_tipo_cuenta from tb_cuentas where tb_cuentas.id =$cuenta");

		while($rows = pg_fetch_object($buscar->getQuery())) {
			$db_id_banco = $rows->nombre;
			$db_tipo_cuenta = $rows->id_tipo_cuenta;
		}


		$array_cuentas = array();
		$post_nombre = $_POST['nombre'];
		$post_tipo_cuenta = $_POST['tipo_cuenta'];
		$post_cuenta = $_POST['cuenta'];

		$array_cuentas = preg_split("/\,/", $_POST['bancos']);

		if(!in_array($post_nombre, $array_bancos)) {
			$actualizar_banco = new connection();
			$actualizar_banco->setQuery("update db_banco set nombre=$post_nombre where id=$db_id_banco;");
			if(!$actualizar_banco->getQuery()) {
				print "No se puede actualizar nombre el nonbre del banco por $post_nombre";
			} else {
				print "Se actualizo con exito el nombre del banco por $post_nombre";
			}
		} else {
				print "No se puede actualizar nombre del banco ya exite $post_nombre";
		}
			unset($actualizar_banco);
	

		$actualizar_cuenta  = new connection();
		if($db_cuenta != $post_cuenta) { 
                        $actualizar_cuenta->setQuery("update tb_cuenta set cuenta=$post_cuenta where id=$cuenta");
			if(!$actualizar_cuenta->getQuery()){
			       print "<p>No se pudo modificar la cuenta del Banco: $post_cuenta </p>";
			} else {    
			       print "<p>La cuenta del banco se actualizo con exito por : $post_cuenta </p>";
			}   		
		}

		if($db_tipo_cuenta != $post_tipo_cuenta) { 
                        $actualizar_cuenta->setQuery("update tb_cuenta set id_tipo_cuenta=$post_tipo_cuenta where =$id_tipo_cuenta");
			if(!$actualizar_cuenta->getQuery()){
			       print "<p>No se pudo modificar Nombre del Banco: $post_nombre_banco </p>";
			} else {    
			       print "<p>El nombre del banco se actualizo con exito por : $post_nombre_banco </p>";
			}   		
		}

			unset($actualizar_cuenta);


	}

?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios <a href="index.php">Regresar</a></div>
<?php endif; ?>
