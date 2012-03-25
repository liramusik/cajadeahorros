<?php 
	include("includes/top_page.php"); 
?>
<div id="wrapper">		
    <div id="header">    	
    	<? include("includes/header.php"); ?>        
    </div>  
    <div id="menu">
    	<? switch ($_SESSION['rol']) {
    case 0:
    	    include("includes/menu.php");
        break;
    case 1:
    	    include("includes/menu1.php");
        break;
    case 2:
    	    include("includes/menu2.php");
        break;
        } ?>
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