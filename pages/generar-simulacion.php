<?php
$cedula = $_SESSION['session_cedula'];
$monto = $_POST['monto'];
$tiempo = $_POST['tiempo'];
$pago = $_POST['pago'];
$fecha_actual = time();

class simulacion {
	private $cedula;
	private $monto;
	private $tiempo;
	private $pago;
	private $fecha;
	public function __construct($p_cedula, $p_monto, $p_tiempo, $p_pago, $p_fecha) {
		$this->cedula = $p_cedula;
		$this->monto = $p_monto;
		$this->tiempo = $p_tiempo;
		$this->pago = $p_pago;
		$this->fecha = $p_fecha;
	}
	public function generar() {
		switch($this->pago) {
			case 1:
				$this->intereses_amortizacion();
				break;
			case 2:
				$this->intereses();
				break;
		}
	}
	private function intereses_amortizacion() {
	}
	private function intereses() {
		$intereses = array();
		$fechas = array();
		$fechas[0] = $this->fecha;
		for($i = 1; $i <= $this->tiempo; $i++) {
			$intereses[$i] = (($this->monto * 6) / 100);
			$fechas[$i] = strtotime("+1 month", $fechas[$i-1]);
		}
		$this->imprimir($intereses, $fechas);
	}
	private function imprimir(&$intereses, &$fechas) {
		print '<table>';
		for($i = 1; $i <= sizeof($intereses); $i++) {
			print '<tr>';
			print "<td>" . $i . "</td>";
			print "<td>" . $intereses[$i] . "</td>";
			print "<td>" . date("d-m-Y", $fechas[$i]) . "</td>";
			print '</tr>';
		}
		print '</table>';
	}
}

$sim = new simulacion($cedula, $monto, $tiempo, $pago, $fecha_actual);
$sim->generar();

?>
