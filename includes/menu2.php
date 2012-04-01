<?php $cedula = $_SESSION['session_cedula']; ?>
<div id="ui-accordion">
	<div class="group">
		<h3><a href="#">Inicio</a></h3>
		<div>
			<a href="index.php">Inicio</a>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Cuenta</a></h3>
		<div>
			<a href="index.php?page=modificar-usuarios&cedula=<?php print $cedula; ?>">Cuenta</a>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Notificaciones</a></h3>
		<div>
			<a href="index.php?page=listar-notificaciones">Notificaciones</a>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Préstamos</a></h3>
		<div>
			<ul>
				<li><a href="index.php?page=solicitar-prestamo">Solicitar</a></li>
				<li><a href="index.php?page=simulacion">Simulación</a></li>
				<li><a href="index.php?page=listar-prestamos">Listar</a></li>
			</ul>
		</div>
	</div>
</div>
