<?php 
	$pagina = explode("/", $_GET['page']);
    echo ("<p><a ");
    #echo ("href=\"src/".$_GET['page'].".phps\" target=\"_blank\">");
    echo ("href=\"src/" . $pagina[count($pagina) - 1] . ".phps\" target=\"_blank\">");
    echo ("Ver código fuente</a></p>")
?>