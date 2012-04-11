<?php if(isset($_SESSION['session_usuario']) && ($_SESSION['session_id_rol'] == 1)): ?>
<?php
$seleccion = $_POST['litar-reporte'];
switch ($seleccion) {
    case 0:
	include('reporte-listar-socios.php');
	require('tmp/reporte-socios.pdf');
        break;
    case 1:
	include('reporte-listar-intereses.php');
	require('tmp/reporte-intereses.pdf');
        break;
    case 2:
        echo "i es igual a 2";
        break;
}
?>
<?php else: ?>
	<div class="mensaje">Usted no posee privilegios para ver esta página <a href="index.php">Regresar</a></div>
<?php endif; ?>
