<?php
/**
 * Programa que permite la creación de un script en el servidor
 * para la inserción de usuarios y bbdd.
 * 
 * AAaan_1daw - bdAAaann_1daw
 * AA: Dos primeras letras del primer apellido.
 * aa: Dos primeras letras del segundo apellido.
 * n: Inicial del nombre.
 * 
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */

function formatUserName($username, $inicialNombre = 1) {
    
    $usernameFormat = iconv ("UTF-8","ASCII//TRANSLIT",
            mb_substr (mb_strtolower ($username[1], "utf-8"),0,2, "utf-8"));
    $usernameFormat .= iconv ("UTF-8","ASCII//TRANSLIT",
            mb_substr (mb_strtolower ($username[2], "utf-8"),0,2, "utf-8"));
    $usernameFormat .= iconv ("UTF-8","ASCII//TRANSLIT",
            mb_substr (mb_strtolower ($username[0], "utf-8"),
                    0,$inicialNombre, "utf-8"));
    $usernameFormat .= "_1daw";
    
    return ($usernameFormat);
}

setlocale(LC_ALL,'es_ES.utf8');

// Los datos de los alumnos son recogidos
$alumnos = fopen("datos/alumnos.txt", "rb");

// Destino
$output = "datos/miscript.sql";

// El nombre de usuarios de los alumnos AAaan_1daw
$usuarioAlumnos = array ();

// La base de datos del alumno AAaann_1daw
$usuarioDb = array ();

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>SQL Alumnos</title>
        <style type="text/css">
            ul {
                list-style: none;
            }
            
            li:nth-child(3n+4) {
                margin-top: 20px;
            }
            .button{
                text-decoration:none; text-align:center; 
                padding:11px 32px; 
                border:none; 
                -webkit-border-radius:13px;
                -moz-border-radius:13px; 
                border-radius: 13px; 
                font:18px Arial, Helvetica, sans-serif; 
                font-weight:bold; 
                color: #1f1712; 
                background-color:#e68609; 
                background-image: 
                    -moz-linear-gradient(top, #e68609 0%, #573f26 100%); 
                background-image: 
                    -webkit-linear-gradient(top, #e68609 0%, #573f26 100%); 
                background-image: 
                    -o-linear-gradient(top, #e68609 0%, #573f26 100%); 
                background-image: 
                    -ms-linear-gradient(top, #e68609 0% ,#573f26 100%); 
                filter: progid:DXImageTransform.Microsoft.gradient(
                    startColorstr='#573f26', endColorstr='#573f26',
                    GradientType=0 ); 
                background-image:
                    linear-gradient(top, #e68609 0% ,#573f26 100%);   
                -webkit-box-shadow:
                    0px 0px 2px #bababa, inset 0px 0px 1px #ffffff; 
                -moz-box-shadow:
                    0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;  
                box-shadow:
                    0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;  
            }
            
            .button:hover{
                padding:11px 32px; 
                border:none; 
                -webkit-border-radius:13px;
                -moz-border-radius:13px; 
                border-radius: 13px; 
                font:18px Arial, Helvetica, sans-serif; 
                font-weight:bold; 
                color:#E5FFFF; 
                background-color:#94744a; 
                background-image: -moz-linear-gradient(
                    top, #94744a 0%, #ad865c 100%); 
                background-image:
                    -webkit-linear-gradient(top, #94744a 0%, #ad865c 100%); 
                background-image:
                    -o-linear-gradient(top, #94744a 0%, #ad865c 100%); 
                background-image:
                    -ms-linear-gradient(top, #94744a 0% ,#ad865c 100%); 
                filter: progid:DXImageTransform.Microsoft.gradient(
                    startColorstr='#ad865c', endColorstr='#ad865c',
                    GradientType=0 ); 
                background-image:
                    linear-gradient(top, #94744a 0% ,#ad865c 100%);   
                -webkit-box-shadow:
                    0px 0px 2px #bababa, inset 0px 0px 1px #ffffff; 
                -moz-box-shadow:
                    0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;  
                box-shadow:
                    0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;  
            }
        </style>
        <script type="text/javascript">
            
            window.onload = function() {
                document.getElementById("showContent").onclick 
                        = cambiarVisibilidad;
            }
            
            function cambiarVisibilidad() {
                var contenido = document.getElementById("hiddenContent");
                var boton = document.getElementById("showContent");
                if (contenido.style.display === "none") {
                    contenido.style.display = "block";
                    boton.value = "Ocultar contenido";
                }
                
                else {
                    contenido.style.display = "none";
                    boton.value = "Mostrar contenido";
                }
            }
        </script>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <h2>Generación de script</h2>
<?php

// Si existe el fichero
if ($alumnos) {
    
    // Recoge línea y verifica si existe
    while (($buffer = fgets($alumnos)) !== false) {
        
        $buffer = explode(",", $buffer);
        
        // Crea un nombre de usuario y de bd
        $nombre = formatUserName($buffer);
        $db = formatUserName($buffer, 2);
        
        $usuarioAlumnos[] = $nombre;
        $usuarioDb[] = $db;
    }
    
    if (!feof($alumnos)) {
        echo "Error: fgets() da error\n";
    }
    
    $query = "";
    
    // Nombre de la tabla
    $tablaUsuarios = "UsuariosDAW";
    
    // Nombre de la columna
    $columnaUsuarios = "usuario";
    
    for ($i = 0; $i < count ($usuarioAlumnos); $i += 1) {
        
        $dbUsuarios = "bd" . $usuarioDb[$i];
        $query .= "INSERT INTO " . $tablaUsuarios 
                . "(" . $columnaUsuarios . ") ";
        $query .= "VALUES (" . $usuarioAlumnos[$i] . ");\n";
        $query .= "CREATE DATABASE " . $dbUsuarios . ";" 
            . "\nGRANT ALL PRIVILEGES ON " . $dbUsuarios . ".* TO '" 
            . $usuarioAlumnos[$i] . "'@'localhost' IDENTIFIED BY '" 
            . $usuarioAlumnos[$i] . "';";
        
        if (count ($usuarioAlumnos) != $i) {
            $query .= "\n";
        }
    }
    
    // Presentación de los datos en el HTML
    if (file_put_contents($output, $query) !== false) {
        $htmlOutput = explode(";", file_get_contents($output));
        echo "<h3>Script generado con éxito!</h3>";
        echo "<input id='showContent' type='button' "
            . "value='Mostrar contenido' class='button'/>&nbsp;&nbsp;";
        echo "<a href='/datos/miscript.sql'><input type='button' "
            . "value='Descargar' class='button'>"
            . "</a></input>"
            . "<br /><br />";
        echo "<div id='hiddenContent' style='display: none;'>";
        echo "<ul>";
        
        foreach ($htmlOutput as $line) {
            echo "<li>" .$line . "<br /></li>";
        }
        
        echo "</ul></div>";
    }
    
    else {
        echo "<h3>Se ha producido un error en la creación del script</h3>";
    }
    
    fclose($alumnos);
}
?>
    </body>
</html>

