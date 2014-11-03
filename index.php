<?php
	ob_start ();

	include ("includes/top_page.php");
	include ("includes/header.php");
	include ("includes/menu.php");

	echo ("<div id=\"templatemo_main\">");

	include ("includes/pages.php");

	echo ("</div>"); 

	include ("includes/footer.php"); 

	$file_content = ob_get_contents ();
	ob_end_clean ();
	echo $file_content;
?>
