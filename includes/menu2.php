<?php $cedula = $_SESSION['session_cedula']; ?>
<div id="menu-principal">
	<ul>
		<li>
			<a href="index.php">Inicio</a>
		</li>
		<li>
			<a href="index.php?page=modificar-usuarios&m_cedula=<?php print $cedula; ?>">Cuenta</a>
		</li>
		<li>
			<li><a href="index.php?page=listar-notificaciones">Notificaciones</a></li>
		</li>
		<li>
			<a href="#">Préstamo</a>
			<ul>
				<li>
					<a href="index.php?page=solicitud-prestamo">Solicitud de Préstamo</a>
				</li>
				<li>
					<a href="index.php?page=simulacion">Simulación</a>
				</li>
			</ul>
		</li>
	</ul>
</div>
