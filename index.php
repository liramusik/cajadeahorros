<?php include("includes/top_page.php"); ?>
<div id="wrapper">	
	<div id="header">
		<? include("includes/header.php"); ?>
	</div>
	<div id="menu">
		<?php include("includes/usuario.php"); ?>
	</div>
	<div id="content">
		<div id="menu-izquierdo">
			<?php include("includes/menu.php"); ?>
		</div>
		<div id="contenido">
			<?php #include("includes/pages.php"); ?>
		</div>
		<div style="clear: both"></div>
	</div>
	<div id="footer">
		<?php include("includes/footer.php"); ?>
	</div>
</div>
<?php include("includes/bottom_page.php"); ?>

<script type="text/javascript">
    $("#contenido").load("includes/pages.php");
</script>
