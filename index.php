<?php session_start(); ?>
<?php include("includes/top_page.php"); ?>
<div id="wrapper">	
	<div id="header">
		<? include("includes/header.php"); ?>
	</div>
	<div id="menu">
		<?php if(isset($_SESSION['session_usuario'])): ?>
			<div class="usuario">Usuario: <?php print $_SESSION['session_usuario']; ?></div>
		<?php endif; ?>
	</div>
	<div id="contenido">
		<?php
		if(!isset($_SESSION['session_usuario'])) {
			include("includes/pages.php");
		} else {
			include("includes/bienvenida.php");
		}
		?>
	</div>
	<div id="footer">
		<?php include("includes/footer.php"); ?>
	</div>
</div>
<?php include("includes/bottom_page.php"); ?>
