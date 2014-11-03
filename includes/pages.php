<?php
	if (!isset($_GET['page'])) {
	    include("pages/principal.php");
	} else {
	    include("pages/".$_GET['page'].".php");
	}
?>
