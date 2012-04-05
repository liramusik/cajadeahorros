<?php
$cedula = $_SESSION['session_cedula'];
$monto = $_POST['monto'];
$tiempo = $_POST['tiempo'];
$pago = $_POST['pago'];
$fecha_actual = time();

$rol = $_SESSION['session_id_rol'];
$x = new connection();
$x->setQuery("select porcentaje from tb_porcentajes where id_roles=$rol order by fecha desc limit 1;");
while($rows = pg_fetch_object($x->getQuery())) {
	$porcentaje = $rows->porcentaje;
}
unset($x);

class simulacion {
	private $cedula;
	private $monto;
	private $tiempo;
	private $pago;
	private $fecha;
	private $porcentaje;
	public function __construct($p_cedula, $p_monto, $p_tiempo, $p_pago, $p_porcentaje, $p_fecha) {
		$this->cedula = $p_cedula;
		$this->monto = $p_monto;
		$this->tiempo = $p_tiempo;
		$this->pago = $p_pago;
		$this->fecha = $p_fecha;
		$this->porcentaje = $p_porcentaje;
	}
	public function generar() {
		if($this->pago == 1) {
			$this->intereses();
		} elseif($this->pago == 2) {
			$this->intereses_cuotas();
		} elseif($this->pago == 3) {
			$this->pago_final();
		}
	}
	private function intereses() {
		$fecha[0] = $this->fecha;
		$cuota[0] = ($this->monto / $this->tiempo);
		for($i = 1; $i <= $this->tiempo; $i++) {
			$prestamo[$i] = $this->monto;
			$interes[$i] = (($this->monto * $this->porcentaje) / 100);
			$fecha[$i] = strtotime("+1 month", $fecha[$i-1]);
		}
		$this->imprimir($prestamo, $interes, $cuota, $fecha, $this->porcentaje);
	}
	private function intereses_cuotas() {
		$prestamo[0] = $this->monto;
		$cuota[0] = ($this->monto / $this->tiempo);
		$fecha[0] = $this->fecha;
		for($i = 1; $i <= $this->tiempo; $i++) {
			$prestamo[$i] = $prestamo[$i-1] - $cuota[0];
			$interes[$i] = (($prestamo[$i-1] * $this->porcentaje) / 100);
			$cuota[$i] = $cuota[0] + $interes[$i];
			$fecha[$i] = strtotime("+1 month", $fecha[$i-1]);
		}
		$this->imprimir($prestamo, $interes, $cuota, $fecha, $this->porcentaje);
	}
	private function pago_final() {
		$cuota[0] = ($this->monto / $this->tiempo);
		for($i = 1; $i <= $this->tiempo; $i++) {
			$prestamo[$i] = $this->monto;
			$interes[$i] = (($this->monto * $this->porcentaje) / 100);
		}
		$fecha[0] = strtotime("$this->tiempo month", $this->fecha);
		$this->imprimir($prestamo, $interes, $cuota, $fecha, $this->porcentaje);
	}
	private function imprimir(&$prestamo, &$interes, &$cuota, &$fecha, $porcentaje) {
		include("pages/reporte-simulacion.php");
	}
}

$sim = new simulacion($cedula, $monto, $tiempo, $pago, $porcentaje, $fecha_actual);
$sim->generar();

?>
