<?php session_start(); ?>
<?php
$seleccion = @$_POST['listar_reporte'];
switch ($seleccion) {
    case 0:
    	include('reporte-listar-usuarios.php');
	print '<meta http-equiv="refresh" content="0; url=/tmp/reporte-usuarios.pdf">'; 
        break;
    case 1:
	include('reporte-listar-intereses.php');
	print '<meta http-equiv="refresh" content="0; url=/tmp/reporte-intereses.pdf">'; 
        break;
    case 2:
        echo "i es igual a 2";
        break;
}
?>
