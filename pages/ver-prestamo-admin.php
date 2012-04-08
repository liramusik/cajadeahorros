<script type="text/javascript">
	$(function() {
		$("#ver-prestamo-admin")
			.accordion({
				header: "> div > h3"
			})
			.sortable({
				axis: "y",
				handle: "h3",
				stop: function(event, ui) {
					ui.item.children("h3").triggerHandler("focusout");
				}
			});
	});
</script>


<?php
$x = new conexion();

$x->setQuery("select tb_solicitud_prestamo.id as id_solicitud, id_tipo_pago, cedula, nombre, apellido, monto, to_char(fecha, 'DD/MM/YYYY') as fecha, tiempo, porcentaje, observacion, respuesta, tb_estatus_solicitud_prestamo.id as id_estatus, tb_estatus_solicitud_prestamo.estatus from tb_solicitud_prestamo left join tb_estatus_solicitud_prestamo on tb_solicitud_prestamo.id_estatus_solicitud_prestamo = tb_estatus_solicitud_prestamo.id left join tb_usuarios on cedula_usuario = cedula where tb_solicitud_prestamo.id=$id");
while($rows = pg_fetch_object($x->getQuery())) {
	$id_solicitud = $rows->id_solicitud; 
	$pago = $rows->id_tipo_pago;
	$cedula = $rows->cedula;
	$nombre = $rows->nombre;
	$apellido = $rows->apellido;
	$monto = $rows->monto;
	$fecha = $rows->fecha;
	$tiempo = $rows->tiempo;
	$porcentaje = $rows->porcentaje;
	$observacion = $rows->observacion;
	$respuesta = $rows->respuesta;
	$id_estatus = $rows->id_estatus;
	$estatus = $rows->estatus;
}
?>
<div id="ver-prestamo-admin">
        <div class="group prestamo">
                <h3><a href="#">Préstamo</a></h3>
                <div>
			<?php include("prestamo-admin.php"); ?>
                </div>
	</div>
	<?php if($id_estatus == 2): ?>
		<div class="group registrar-pago">
			<h3><a href="#">Registrar Pago de Préstamo</a></h3>
			<div>
				<?php include("transacciones-admin.php"); ?>
			</div>
		</div>
		<div class="group listar-transacciones">
			<h3><a href="#">Listar Transacciones de Préstamo</a></h3>
			<div>
				<?php include("listar-transacciones-admin.php"); ?>
			</div>
		</div>
	<?php endif; ?>
</div>

<div id="listado-prestamo-transacciones">
</div>

<?php
unset($x);
?>
