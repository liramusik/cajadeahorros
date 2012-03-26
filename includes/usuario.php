<?php if(isset($_SESSION['session_usuario'])): ?>
	<div class="usuario">Usuario: <?php print $_SESSION['session_usuario']; ?> <a href="?page=logout">Cerrar Sesión</a></div>
<?php endif;?>
