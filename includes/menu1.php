<div id="ui-accordion">
	<div class="group">
		<h3><a href="#">Bancos</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a href="#" id="crearcuentas">Crear</a></li>
				<li><span class="icon"></span><a href="index.php?page=listar-cuentas">Listar</a></li>
				<li><span class="icon"></span><a href="index.php?page=registrar-intereses">Intereses</a></li>
			</ul>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Usuarios</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a href="index.php?page=crear-usuarios">Crear</a></li>
				<li><span class="icon"></span><a href="index.php?page=listar-usuarios">Listar</a></li>
			</ul>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Notificaciones</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a href="index.php?page=listar-notificaciones">Listar</a></li>
			</ul>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Préstamos</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a href="index.php?page=solicitar-prestamo">Solicitar</a></li>
				<li><span class="icon"></span><a href="index.php?page=simulacion">Simulación</a></li>
				<li><span class="icon"></span><a href="index.php?page=listar-prestamos">Listar</a></li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#crearcuentas").click(function(){
		$("#contenido").load("includes/pages.php?page=crear-cuentas");
	});
</script>

