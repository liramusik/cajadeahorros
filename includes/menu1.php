<div id="ui-accordion">
	<div class="group">
		<h3><a href="#">Bancos</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="cuentas">Crear</a></li>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-cuentas">Listar</a></li>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="intereses">Intereses</a></li>
			</ul>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Usuarios</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="usuarios">Usuarios</a></li>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-usuarios">Listar</a></li>
			</ul>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Notificaciones</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-notificaciones">Listar</a></li>
			</ul>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Préstamos</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="solicitar-prestamo">Solicitar</a></li>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="simulacion">Simulación</a></li>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-prestamos">Listar</a></li>
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".ajaxmenu").click(function() {
			var page = $(this).attr("title");
			$("#contenido").load("includes/pages.php?page="+page);
		});
	});    
</script>

