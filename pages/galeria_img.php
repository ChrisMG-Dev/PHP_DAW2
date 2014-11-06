<?php
/**
 * Galería de imágenes subidas al servidor.
 * 
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <?php
        
            $directory = "datos/fotos/";

            #$images = glob($directory . "*.jpg");
            $images = glob($directory . "*.png");
            #$images[] = glob($directory . "*.jpeg");
            #$images[] = glob($directory . "*.gif");

            //print each file name
            foreach ($images as $image) {
              echo "<img src='" . $image . "'/>";
            }
        ?>
    </body>
</html>

