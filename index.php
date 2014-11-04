<?php
    session_start();
    
    if (!isset ($_SESSION['historial'])) {
        $_SESSION['historial'] = array ();
    }
    
    else {
        if (isset ($_SERVER['HTTP_REFERER'])) {
            $_SESSION['historial'][] = $_SERVER['HTTP_REFERER'];
        }
        
        else {
            $_SESSION['historial'][] = "HTTP_REFERER no disponible";
        }
    }
     
    
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
