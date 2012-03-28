<script type="text/javascript">
    $(document).ready(function(){ // Script del Navegador 
	$("ul.subnavegador").not('.selected').hide();
	$("a.desplegable").click(function(e){
	    var desplegable = $(this).parent().find("ul.subnavegador");
	    $('.desplegable').parent().find("ul.subnavegador").not(desplegable).slideUp('slow');
	    desplegable.slideToggle('slow');
	    e.preventDefault();
	})
    });
</script>

<ul class="navegador">
	<li><a href="index.php">Inicio</a></li>
	<li><a href="index.php?page=listar-usuarios">Usuarios</a></li>
	<li><a href="index.php?page=listar-notificaciones">Notificaciones</a></li>
	<li>
		<a href="#" class="desplegable">Préstamo</a>
		<ul class="subnavegador">
			<li><a href="index.php?page=solicitud-prestamo">Solicitud de Préstamo</a></li>
			<li><a href="index.php?page=simulacion">Simulación</a></li>
		</ul>
	</li>
</ul>
