<?php if(isset($_SESSION['session_usuario']) and ($_SESSION['session_id_rol'] == 1)): ?>
	<?php
	$solicitud = $_GET['v_solicitud'];
	$n->setQuery("select tb_solicitud_prestamo.id, cedula, nombre, apellido, monto, fecha, tb_estatus_solicitud_prestamo.estatus from tb_solicitud_prestamo left join tb_estatus_solicitud_prestamo on tb_solicitud_prestamo.id_estatus_solicitud_prestamo = tb_estatus_solicitud_prestamo.id left join tb_usuarios on cedula_usuario = cedula where tb_solicitud_prestamo.id=$solicitud");
	?>
	<?php endif; ?>
	<?php else: ?>
                <div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
