<?php if(isset($_SESSION['session_usuario'])): ?>
	<?php
	$solicitud = $_GET['solicitud'];
	if($_SESSION['session_id_rol'] == 1) {
		$c->setQuery("");
	} else {
		$c->setQuery("");
		$cedula = $_SESSION['session_cedula'];
	}
	while($rows = pg_fetch_object($c->))
	?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios ver esta pagina <a href="index.php">Regresar</a></div>
<?php endif; ?>
