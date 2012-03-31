<script>
	$(document).ready(function() {
		$("#ui-accordion")
			.accordion({
				header: "> h3"
			})
			.sortable({
				axis: "y",
				handle: "h3",
				stop: function(event, ui) {
					ui.item.children( "h3" ).triggerHandler( "focusout" );
				}
			});
	});
</script>
<div id="ui-accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons">
	<h3 class="ui-accordion-header ui-helper-reset ui-state-active ui-corner-top"><a href="#">Inicio</a></h3>
	<div>
		<a href="index.php">Inicio</a>
	</div>
	<h3 class="ui-accordion-header ui-helper-reset ui-state-active ui-corner-top"><a href="#">Usuarios</a></h3>
	<div>
		<a href="index.php?page=listar-usuarios">Usuarios</a>
	</div>
	<h3 class="ui-accordion-header ui-helper-reset ui-state-active ui-corner-top"><a href="#">Notificaciones</a></h3>
	<div>
		<a href="index.php?page=listar-notificaciones">Notificaciones</a>
	</div>
	<h3 class="ui-accordion-header ui-helper-reset ui-state-active ui-corner-top"><a href="#">Préstamos</a></h3>
	<div>
		<ul>
			<li><a href="index.php?page=solicitud-prestamo">Solicitar</a></li>
			<li><a href="index.php?page=simulacion">Simulación</a></li>
			<li><a href="index.php?page=listar-prestamos">Listar</a></li>
		</ul>
	</div>
	</div>
</div>
