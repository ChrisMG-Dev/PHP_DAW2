<?php
/**
 * Formulario que permite la subida de imágenes en el servidor.
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
        <title>Ficheros - Galeria Fotos</title>
        <script type="text/javascript">
            function checkSize() {
                
                var max_size = parseInt(document.
                        getElementById("maxSize").value);
                
                var input = document.getElementById("upload");

                if(input.files && input.files.length === 1) {           
                    if (input.files[0].size > max_size) {
                        
                        document.getElementById("errorMsg").innerHTML =
                                "El tamaño no puede ser superior a " + 
                                (((max_size) / 1024)/1024).toFixed(2) + "MB.";
                        return false;
                    }
                }
                
                return true;
            }
        </script>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <?php 
            $max_filesize = (intval (ini_get ('upload_max_filesize'))
                    * 1024 * 1024);
        ?>
        <form action="?page=upload_img" method="post"
              enctype="multipart/form-data" onsubmit="return checkSize();">
            <fieldset style="display: inline-block;">
                <input id="maxSize" type="hidden" 
                       name="MAX_FILE_SIZE" value="
                           <?php echo $max_filesize ?>" />
                Selecciona la imagen a subir:
                <input id="upload" type="file" name="fileToUpload"
                       id="fileToUpload" />
                <br />
                <span id="errorMsg" style="color: red;"></span>
                <br />
                <input type="submit" value="Subir imagen" name="subir">
            </fieldset>
        </form>
        <br />
        <a href="?page=galeria_img" target="_blank">
            <input type="button" value="Ver galería" name="vergaleria" />
        </a>
    </body>
</html>