<?php 
	include("includes/top_page.php"); 
?>
<div id="wrapper">		
    <div id="header">    	
    	<? include("includes/header.php"); ?>        
    </div>  
    <div id="menu">
    	<? 
switch ($_SESSION['session_rol']) {
    case "1":
        include("includes/menu.php");
        break;
    case "2":
        echo "i es una barra";
        break;
    case "3":
        echo "i es un pastel";
        break;
}

 ?>
    </div>	
    <div id="contenido">
    	<? include("includes/pages.php"); ?>        
        <br style="clear:both;" />
    </div>
    <div id="footer">   	   
	    <? include("includes/footer.php"); ?>        
    </div>
</div>
<? include("includes/bottom_page.php"); ?>
