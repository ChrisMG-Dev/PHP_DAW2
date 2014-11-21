<?php

    if(isset($_GET['file'])) {
        if (isset($_GET['download']) && $_GET['download'] == "yes") {
            $fileName = $_GET['file'];
            
            header("Cache-Control: public");
            header("Content-Description: File Transfer");      
            header('Content-type: text/plain');
            header('Content-Disposition: attachment; filename="' 
                    . $fileName . '"');  
            header("Content-Transfer-Encoding: binary");
            
            $source = $_SERVER['DOCUMENT_ROOT'] . "/pages/" . $fileName;
            $source = file_get_contents($source);
            ob_clean();
            flush();
            print $source;
            exit;            
        }
        highlight_file($_SERVER['DOCUMENT_ROOT'] . "/pages/" . $_GET['file']);        
    }


    else {
        header("Location: about:blank");        
    }

      echo '<br />';
      echo '<div style="width: 50%;display: inline-block;margin: 20 auto;text-align: center">';
      echo '<br /><br /><a href="index.php?page=principal">Índice</a> &nbsp;&nbsp;'
            . '<a href="index.php?page=' 
            . str_replace(".php", "", $_GET['file']) 
            .'">Volver</a>';
      echo '</div>';
?>
