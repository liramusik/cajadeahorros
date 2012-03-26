<?php session_start(); ?>
<?php include("includes/top_page.php"); ?>
<div id="wrapper">	
	<div id="header">
		<? include("includes/header.php"); ?>
	</div>
	<div id="menu">
		<?php if(isset($_SESSION['session_usuario'])): ?>
			<div class="usuario">Usuario: <?php print $_SESSION['session_usuario']; ?> <a href="?page=logout">Cerrar Sesión</a></div>
		<?php endif;?>

	</div>
	<div id="contenido">
		<? include("includes/pages.php"); ?>
	</div>
	<div id="footer">
		<?php include("includes/footer.php"); ?>
	</div>
</div>
<?php include("includes/bottom_page.php"); ?>
