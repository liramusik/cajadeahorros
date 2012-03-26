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
				$this->intereses();
				break;
			case 2:
				$this->intereses_amortizacion();
				break;
		}
	}
	private function intereses() {
		$total_intereses = 0;
		$intereses = array();
		$fechas = array();
		$fechas[0] = $this->fecha;
		for($i = 1; $i <= $this->tiempo; $i++) {
			$intereses[$i] = (($this->monto * 6) / 100);
			$total_intereses += $intereses[$i];
			$fechas[$i] = strtotime("+1 month", $fechas[$i-1]);
		}
		$this->imprimir($intereses, $fechas, $total_intereses);
	}
	private function intereses_amortizacion() {

	}
	private function imprimir(&$intereses, &$fechas, $total_intereses) {
		print '<h1>Resultado de la Simulación</h1>';
		print '<table>';
		for($i = 1; $i <= sizeof($intereses); $i++) {
			print '<tr>';
			print "<td>" . $i . "</td>";
			print "<td>" . $intereses[$i] . "</td>";
			print "<td>" . date("d-m-Y", $fechas[$i]) . "</td>";
			print '</tr>';
		}
		print '</table>';
		$total = $total_intereses + $this->monto;
		print '<div>Total de intereses a pagar ' . $total_intereses . ' Bs.</div>';
		print '<div>Total del préstamo ' . $total . ' Bs. que deberá ser pagado el ' . date("d-m-Y", $fechas[sizeof($fechas) - 1]) . '</div>';
	}
}

$sim = new simulacion($cedula, $monto, $tiempo, $pago, $fecha_actual);
$sim->generar();

?>
