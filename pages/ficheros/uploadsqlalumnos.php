<?php
/**
 * Descripcion
 * 
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */
?>
<?php
        $file = 'datos/alumnos2.txt';
        $data = file($file) or die('Could not read file!');
        $tokens = array("de","la","del","las","los","mac","mc","van",
            "von","y","i","san","santa");
        $added = false;
        
        foreach ($data as $line) {
            list($apellidos, $nombre) = explode(",",$line);
            $sliced = explode(" ", $apellidos);
            $apellido1 = $sliced[0] . " ";

            for ($i = 1; $i < count($sliced); $i += 1) {
                $added = false;
                if (in_array($sliced[$i], $tokens)) {
                    $apellido1 .= $sliced[$i] . " ";
                    $added = true;
                } 
                else if (!$added) {
                    $apellido1 .= $sliced[$i] . " ";
                    break;
                }
            }                
            
            /*
            $apellido2 = $sliced[$i + 1];
            for ($i = $i + 1; $i < count($sliced); $i += 1) {
                do{
                    if (in_array($sliced[$i], $tokens)) {
                        $apellido2 .= $sliced[$i] . " ";
                    }                    
                } while (in_array($sliced[$i], $tokens));
                $apellido2 .= $sliced[$i];
            }
            
             * 
             */
            echo "Apellido1: " . $apellido1;
            echo "<br />";
            echo "Apellido2: " . $apellido2;
            echo "<br /><br />";
        }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php include("includes/source.php"); ?>   	
        <form action="?page=ficheros/uploadssqlalumnos.php" method="post" 
              enctype="multipart/form-data">
            <fieldset>
                <p>
                    <input type="file" name="myFile" required />
                </p>
                <p>
                    <label>Grupo</label>
                    <br />
                    <input type="text" placeholder="2DAW1415" name="prefijo" 
                           required />
                </p>
                <p>
                    <label>Contraseña por defecto</label>
                    <br />
                    <input type="text" value="usuario" name="defaultPass" 
                           required/>
                </p>
            </fieldset>
            <br /><input type="submit" name="subir" value="Subir" />
        </form>
    </body>
</html>