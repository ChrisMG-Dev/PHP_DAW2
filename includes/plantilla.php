<?php 
	include("includes/top_page.php"); 
	include("includes/header.php");        
	include("includes/menu.php"); 
	ob_start(); 
	echo("<div id=\"templatemo_main\">"); 
	include("includes/pages.php");              
	echo("</div>"); 
	ob_end_flush();
	include("includes/footer.php"); 
?>