<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$solicitud = $_GET['solicitud'];
	if($_SESSION['session_id_rol'] == 1) {
		include("ver-prestamos-admin.php");
	} else {
		include("ver-prestamos-usuarios.php");
	}
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
