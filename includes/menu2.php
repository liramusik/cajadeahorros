<?php $cedula = $_SESSION['session_cedula']; ?>
<div id="menu-principal">
	<ul>
		<li>
			<a href="index.php">Inicio</a>
		</li>
		<li>
			<a href="index.php?page=modificar_usuarios&m_cedula=<?php print $cedula; ?>">Cuenta</a>
		</li>
		<li>
			<a href="index.php?page=simulacion">Simulación</a>
		</li>
	</ul>
</div>
