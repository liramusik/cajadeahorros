<?php
$cedula = $_GET['cedula'];
$monto = $_GET['monto'];
$tiempo = $_GET['tiempo'];
$tipo_pago = $_GET['tipo_pago'];
$id_rol = $_GET['id_rol'];

$fecha_actual = time();

$x = new conexion();
$x->setQuery("select porcentaje from tb_porcentajes where id_roles=$id_rol order by fecha desc limit 1;");
while($rows = pg_fetch_object($x->getQuery())) {
	$porcentaje = $rows->porcentaje;
}
unset($x);

class simulacion {
	private $cedula;
	private $monto;
	private $tiempo;
	private $tipo_pago;
	private $fecha;
	private $porcentaje;
	private $id_rol;
	public function __construct($p_cedula, $p_monto, $p_tiempo, $p_tipo_pago, $p_porcentaje, $p_fecha, $p_id_rol) {
		$this->cedula = $p_cedula;
		$this->monto = $p_monto;
		$this->tiempo = $p_tiempo;
		$this->tipo_pago = $p_tipo_pago;
		$this->fecha = $p_fecha;
		$this->porcentaje = $p_porcentaje;
		$this->id_rol = $p_id_rol;
	}
	public function generar() {
		if($this->tipo_pago == 1) {
			$this->intereses();
		} elseif($this->tipo_pago == 2) {
			$this->intereses_cuotas();
		} elseif($this->tipo_pago == 3) {
			$this->pago_final();
		}
	}
	private function intereses() {
		$fecha[0] = $this->fecha;
		$cuota[0] = ($this->monto / $this->tiempo);
		$amortizacion = 0;
		for($i = 1; $i <= $this->tiempo; $i++) {
			$prestamo[$i] = $this->monto;
			$interes[$i] = (($this->monto * $this->porcentaje) / 100);
			$fecha[$i] = strtotime("+1 month", $fecha[$i-1]);
		}
		$this->imprimir($prestamo, $interes, $amortizacion, $cuota, $fecha, $this->porcentaje);
	}
	private function intereses_cuotas() {
		$prestamo[0] = $this->monto;
		$fecha[0] = $this->fecha;
		$amortizacion = ($this->monto / $this->tiempo);
		$total_intereses = 0;
		for($i = 1; $i <= $this->tiempo; $i++) {
			$prestamo[$i] = $prestamo[$i-1] - $amortizacion;
			$interes[$i] = (($prestamo[$i-1] * $this->porcentaje) / 100);
			$total_intereses += $interes[$i];
			$fecha[$i] = strtotime("+1 month", $fecha[$i-1]);
		}
		$interes[0] = $total_intereses / $this->tiempo;
		$cuota = ($this->monto + $total_intereses) / $this->tiempo;
		$this->imprimir($prestamo, $interes, $amortizacion, $cuota, $fecha, $this->porcentaje);
	}
	private function pago_final() {
		$cuota[0] = ($this->monto / $this->tiempo);
		$amortizacion = 0;
		for($i = 1; $i <= $this->tiempo; $i++) {
			$prestamo[$i] = $this->monto;
			$interes[$i] = (($this->monto * $this->porcentaje) / 100);
		}
		$fecha[0] = strtotime("$this->tiempo month", $this->fecha);
		$this->imprimir($prestamo, $interes, $amortizacion, $cuota, $fecha, $this->porcentaje);
	}
	private function imprimir(&$prestamo, &$interes, $amortizacion, $cuota, &$fecha, $porcentaje) {
		include("reporte-simulacion.php");
	}
}

$sim = new simulacion($cedula, $monto, $tiempo, $tipo_pago, $porcentaje, $fecha_actual, $id_rol);
$sim->generar();

?>
