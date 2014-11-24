<html>
    <head>
        <meta charset="utf-8" >
    </head>
    <body>
        <?php
            echo '<div style="display: inline-block;margin: '
                . '0 auto 10 auto;text-align: left">';
            echo '<a href="index.php?page=' 
                . str_replace(".php", "", $_GET['file']) 
                .'">Volver</a>'
                . ' &nbsp;&nbsp; | &nbsp;&nbsp;'
                . '<a href="index.php?page=principal">Índice</a>';
            echo '</div>';
            
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
                    exit();            
               }

                highlight_file_with_line_numbers($_SERVER['DOCUMENT_ROOT'] 
                       . "/pages/" . $_GET['file']);        

           }


           else {
               header("Location: about:blank");        
           }
            echo '<br />';
            echo '<div style="display: inline-block;margin: '
                . '20 auto;text-align: left">';
            echo '<div style="display: inline-block;margin: '
            . '0 auto 10 auto;text-align: left">';
            echo '<a href="index.php?page=' 
                . str_replace(".php", "", $_GET['file']) 
                .'">Volver</a>'
                . ' &nbsp;&nbsp; | &nbsp;&nbsp;'
                . '<a href="index.php?page=principal">Índice</a>';
            echo '</div>';

           function highlight_file_with_line_numbers($file) { 
               //Strip code and first span
               $code = substr(highlight_file($file, true), 36, -15);
               //Split lines
               $lines = explode('<br />', $code);
               //Count
               $lineCount = count($lines);
               //Calc pad length
               $padLength = strlen($lineCount);

               //Re-Print the code and span again
               echo "<code><span style=\"color: #000000\">";

               //Loop lines
               foreach($lines as $i => $line) {
                   //Create line number
                   $lineNumber = str_pad($i + 1,  $padLength, '0'
                           , STR_PAD_LEFT);
                   //Print line
                   echo sprintf('<br><span style="color: #999999">%s '
                           . '| </span>%s'
                           , $lineNumber, $line);
               }

               //Close span
               echo "</span></code>";
           }
       ?>
       
    </body>
</html>
