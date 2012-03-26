<?php
if (!isset($_GET['page'])) {
    include("pages/acceso.php");
} else {
    include("pages/".$_GET['page'].".php");
}
?>
