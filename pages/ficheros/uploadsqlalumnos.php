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
    //$uploaddir = '/var/www/daw2/uploads/';
    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
    $result = array ();

    if (isset($_POST['subir'])) {
        
        if (!isset($_POST['prefijo']) || $_POST['prefijo'] == "") {
            header("location: index.php?page=ficheros/uploadsqlalumnos");
            $_SESSION['error'] = 1;           
        }
        
        if (!isset($_POST['defaultPass']) || $_POST['defaultPass'] == "") {
            header("location: index.php?page=ficheros/uploadsqlalumnos");
            $_SESSION['error'] = 2;
        }
        
        $usuarios = array ();
        $uploadfile = $uploaddir . basename($_FILES['myFile']['name']);
        
        if (pathinfo($uploadfile, PATHINFO_EXTENSION) != "txt") {
            header("location: index.php?page=ficheros/uploadsqlalumnos");
            $_SESSION['error'] = 0;
            exit;
        }

        move_uploaded_file($_FILES['myFile']['tmp_name'], $uploadfile);

        $data = file($uploadfile) or die('No se puede leer el archivo!');
        
        // Para reconocer los nombres compuestos
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
            
            // Existen nombres con guiones, estos se tratan como un solo nombre
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
        
        unlink($uploadfile);
        
        // Para usuarios no duplicados
        $no_duplicated = array ();
        
        // Número usuarios repetidos
        $repeticiones = array_count_values($usuarios);
        
        // Nombres que no se repiten
        $nombres_unicos = array_unique($usuarios);
        
        for ($i = 0; $i < count($nombres_unicos); $i += 1) {
            // Si un nombre es repetido...
            if ($repeticiones[$usuarios[$i]] > 1) {
                for ($j = 0; $j < $repeticiones[$usuarios[$i]]; $j++) {
                    $no_duplicated[] = $usuarios[$i] . ($j + 1);                      
                }
            } else {
                // Si no es repetido, entonces es único
                $no_duplicated[] = $nombres_unicos[$i];
            }
        }
        
        // Prefijo que se pondrá antes del nombre de usuario
        // E.J 2DAW1415
        $grupo = limpiar($_POST['prefijo']);
        
        // Generación de la query MySQL
        foreach ($no_duplicated as $usuario) {
            $bd = $grupo . "_" . $usuario;
            $createUser = "CREATE USER '". $usuario
                . "'@'" . $host . "' IDENTIFIED BY '" 
                . $_POST['defaultPass'] . "';\n";

            $createDb = "CREATE DATABASE " . $bd . ";" 
                . "\n";

            $privileges = "GRANT ALL PRIVILEGES ON " . $bd . ".* TO '" 
            . $usuario . 
            "'@'localhost' IDENTIFIED BY '" 
            . $usuario . "';\n";

            $query = $createUser . $createDb
                . $privileges;

            $result[] = $query;      
        }
      
        
        $output = "";
        
        foreach ($result as $res) {
            $output .= $res;
        }
        
        // Mandar archivo on-the-fly
  	header("Cache-Control: public");
	header("Content-Description: File Transfer");
        header('Content-type: text/plain');
        header('Content-Disposition: attachment; filename="query.txt"');
	header("Content-Transfer-Encoding: binary");
        ob_clean();
        flush();
        print $output;
        exit;
        
    }
    
    // Simplifica los carácteres UTF-8 a ASCII
    // E.J:     Ñ  ->  N, Ç ->  C
    function formatName ($name, $letters) {
        $name = iconv ("UTF-8","ASCII//TRANSLIT",
            mb_substr (mb_strtolower ($name, "utf-8"),0,$letters, "utf-8"));  
        return ($name);
    }
    
    // Limpia una cadena de carácteres especiales no deseados
    function limpiar($string) {
        $string = str_replace(' ', '_', $string);
        return (preg_replace('/[^A-Za-z0-9\_-]/', '', $string));
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Generación de MySql</title>
        <script type="text/javascript">
            function deleteError () {
                var h4 = document.getElementsByTagName("h4");
                h4[0].innerHTML = "";                
            }
        </script>
        <style>
            fieldset {
                display: inline-block;
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <h4 style='color:red;'>
        <?php
        
            if (isset($_SESSION['error'])) {
                if ($_SESSION['error'] == 0) {
                    echo "El archivo subido debe"
                    . " ser de texto";
                }
                
                else if ($_SESSION['error'] == 1) {
                    echo "Debe introducir un prefijo.";
                }
               
                else if ($_SESSION['error'] == 2) {
                    echo "Debe introducir una contraseña por defecto.";
                }
                
                unset ($_SESSION['error']);
            }
        ?>
        </h4>
        <form action="?page=ficheros/uploadsqlalumnos" method="post" 
              enctype="multipart/form-data" onsubmit="deleteError()">
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