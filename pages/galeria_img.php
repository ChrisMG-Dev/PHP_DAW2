<?php
/**
 * Galería de imágenes subidas al servidor.
 * 
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */

// Formatos de imagen permitidos
define ("ALLOWED_FORMATS", "jpg,png,jpeg,gif");
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Galería</title>
        <style type="text/css">
            img {
                padding: 10px;
                border: 1px solid grey;
            }
        </style>
    </head>
    <body>
        <?php
            include("includes/source.php");
            
            $directory = "datos/fotos/";
            $images = array();
            
            // Busca imágenes con formatos válidos para visualizar
            foreach (explode(",",ALLOWED_FORMATS) as $format) {
                $images[] = glob($directory . "*." . $format);
            }

            echo "<div id='galeria' style='max-width: 960px;'>";
            
            // Muestra la imagen
            foreach ($images as $format) {
                foreach ($format as $singleImage){
                    echo "<img src='" . $singleImage . "' "
                            . "width='120px' height='120px'/>";          
                }
            }
            
            echo "</div>"
        ?>
    </body>
</html>

