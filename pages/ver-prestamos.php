<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$solicitud = $_GET['solicitud'];
	if($_SESSION['session_id_rol'] == 1) {
		$c->setQuery("select tb_solicitud_prestamo.id, cedula, nombre, apellido, monto, fecha, tb_estatus_solicitud_prestamo.estatus from tb_solicitud_prestamo left join tb_estatus_solicitud_prestamo on tb_solicitud_prestamo.id_estatus_solicitud_prestamo = tb_estatus_solicitud_prestamo.id left join tb_usuarios on cedula_usuario = cedula where tb_solicitud_prestamo.id=$solicitud");
		include("ver-prestamos-admin.php");
	} else {
		$cedula = $_SESSION['session_cedula'];
	}
	?>
	<h1>Detalles de Préstamo</h1>
	<h2></h2>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
