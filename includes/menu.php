<?php
if(isset($_SESSION['session_usuario'])) {
	switch($_SESSION['session_id_rol']) {
		case 1:
			include("includes/menu1.php");
			break;
		case 2:
			include("includes/menu2.php");
			break;
		case 3:
			include("includes/menu2.php");
			break;
	}
}
?>
