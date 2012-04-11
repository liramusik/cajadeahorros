<div id="ui-accordion">
	<div class="group">
		<h3><a href="#">Bancos</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="cuentas">Añadir Cuentas</a></li>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="intereses">Registrar Intereses</a></li>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-cuentas">Listar Cuentas</a></li>
                <li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-intereses">Listar Intereses</a></li>
			</ul>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Usuarios</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="usuarios">Añadir</a></li>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-usuarios">Listar</a></li>
			</ul>
		</div>
	</div>
	<div class="group">
		<h3><a href="#">Reportes y Notificaciones</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-notificaciones">Listar Notificaciones</a></li>
                        </ul>
			<ul>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-reportes">Reportes</a></li>
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
	<div class="group">
		<h3><a href="#">Transacciones</a></h3>
		<div>
			<ul>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="transacciones">Registrar</a></li>
				<li><span class="icon"></span><a class="ajaxmenu" href="#" title="listar-transacciones">Listar</a></li>
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

