<?php $cedula = $_SESSION['session_cedula']; ?>
<ul class="navegador">
	<li><a href="index.php">Inicio</a></li>
	<li><a href="index.php?page=modificar-usuarios&cedula=<?php print $cedula; ?>">Cuenta</a></li>
	<li><a href="index.php?page=listar-notificaciones">Notificaciones</a></li>
	<li>
		<a href="#" class="desplegable">Préstamos</a>
		<ul class="subnavegador">
			<li><a href="index.php?page=solicitud-prestamo">Solicitar</a></li>
			<li><a href="index.php?page=simulacion">Simulación</a></li>
			<li><a href="index.php?page=listar-solicitud-prestamos">Listar</a></li>
		</ul>
	</li>
</ul>
