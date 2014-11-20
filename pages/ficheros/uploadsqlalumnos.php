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

    setlocale(LC_ALL,'es_ES.utf8');
    $host = "localhost";
    $uploaddir = '/var/www/prueba/uploads/';
    $result = array ();

    if (isset($_POST['subir'])) {
        $usuarios = array ();
        $uploadfile = $uploaddir . basename($_FILES['myFile']['name']);

        if (move_uploaded_file($_FILES['myFile']['tmp_name'], $uploadfile)) {
           // echo "File is valid, and was successfully uploaded.\n";
        } else {
           // echo "Possible file upload attack!\n";
        }



        $data = file($uploadfile) or die('Could not read file!');
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
                    if ($i == 1) {
                        break;
                    }

                    $apellido1 .= $sliced[$i] . " ";
                    $i++;
                    break;
                }
            }     
            
            $nombre = str_replace(" ", "", $nombre);
            $nombre = str_replace("-", "", $nombre);
            $apellido1 = str_replace(" ", "", $apellido1);
            $apellido1 = str_replace("-", "", $apellido1);

            if (isset($sliced[$i])) {
                $nombre = formatName($nombre, 2);
                $apellido2 = $sliced[$i];
                $apellido2 = str_replace(" ", "", $apellido2);
                $apellido2 = str_replace("-", "", $apellido2);
                $apellido2 = formatName($apellido2, 2);
                $apellido1 = formatName($apellido1, 2);
            }
            
            else {
                if (strlen ($apellido1) >= 4) {
                   $apellido1 = formatName($apellido1, 4);  
                   $nombre = formatName($nombre, 2);
                }
                
                else {
                   $apellido1 = formatName($apellido1, 2); 
                   $nombre = formatName($nombre, 4); 
                }
                
                $apellido2 = "";
            }
            
            $usuario = $apellido1 . $apellido2 . $nombre;
            $usuarios[] = $usuario;
        }
        
        $no_duplicated = array ();
        $repeticiones = array_count_values($usuarios);
        
        $nombres_unicos = array_unique($usuarios);
        
        for ($i = 0; $i < count($nombres_unicos); $i += 1) {
            if ($repeticiones[$usuarios[$i]] > 1) {
                for ($j = 0; $j < $repeticiones[$usuarios[$i]]; $j++) {
                    $no_duplicated[] = $usuarios[$i] . ($j + 1);                      
                }
            } else {
                $no_duplicated[] = $nombres_unicos[$i];
            }
        }
        
        $grupo = limpiar($_POST['prefijo']);
        
        foreach ($no_duplicated as $usuario) {
            $bd = $grupo . "_" . $usuario;
            $createUser = "CREATE USER '". $usuario
                . "'@'" . $host . "' IDENTIFIED BY '" 
                . $_POST['defaultPass'] . "';";

            $createDb = "CREATE DATABASE " . $bd . ";" 
                . "\n";

            $privileges = "GRANT ALL PRIVILEGES ON " . $bd . ".* TO '" 
            . $usuario . 
            "'@'localhost' IDENTIFIED BY '" 
            . $usuario . "';";

            $query = $createUser . "<br />" . $createDb . "<br />" 
                . $privileges . "<br />";
            
            
            


            $result[] = $query;      
        }
        
        header('Content-type: text/txt');
        header('Content-Disposition: attachment; filename="file.txt"');         
        
        $output = "";
        
        foreach ($result as $res) {
            $output .= $res;
        }
        
        print $output;
        
    }
    
    function formatName ($name, $letters) {
        $name = iconv ("UTF-8","ASCII//TRANSLIT",
            mb_substr (mb_strtolower ($name, "utf-8"),0,$letters, "utf-8"));  
        return $name;
    }
    
    function limpiar($string) {
        $string = str_replace(' ', '_', $string);
        return preg_replace('/[^A-Za-z0-9\_-]/', '', $string);
    }
    
    function get_duplicates( $array ) {
        return array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
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
        <form action="?page=ficheros/uploadsqlalumnos" method="post" 
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