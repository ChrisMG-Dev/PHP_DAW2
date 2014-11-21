<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 1</title>
        <style>
            table, th, td, tr{
                border: 1px black solid;
                border-collapse: collapse;
            }
            
            th{
                text-align: left;
                padding: 5px 5px 5px 5px;
            }
            
            td{
                padding: 5px 5px 5px 5px;
            }
            
            #cabecera {
                display: inline-block;
                padding-right: 10px;
                float: left;
            }
            
        </style>
    </head>
    <?php
        
    if ((isset ($_GET['red']) 
            && isset ($_GET['green'])) 
            && isset ($_GET['blue'])) {
        
        echo ("<body style='background-color: RGB(" . $_GET['red'] ."," 
                . $_GET['green'] . ", " . $_GET['blue'] . ");'");
    }
    
    else {
        echo ("<body>");
    }

    ?>
    <?php include("includes/independent_source.php"); ?>
        <div id="cabecera">
            <img height="128px"
                 width="128px" src="pages/img/IMG-20130323-WA0005.jpg"/>
        </div>
        <?php
        /* 
         *   1 - ficha personal
         *   2 - Script para calcular el área de un cuadrado cargando el valor 
         *      del lado en una variable
         *   3 - Script que escriba el resultado de la suma
         *          */
            $nombre = 'Christopher';
            $apellidos = 'Muñoz Godenir';
            $fecha_nac = '23/11/1990';
            $correo = 'chrismgdaw@gmail.com';
            $blog = 'http://alpha-developer.blogspot.com.es';
            $curso = '2º DAW';
            
            echo('<table>');
            echo("<th>Nombre</th><td>$nombre</td>");
            echo("<tr><th>Apellidos</th><td>$apellidos</td>");
            echo("<tr><th>Fecha de nacimiento</th><td>$fecha_nac</td>");
            echo("<tr><th>Correo electrónico</th><td>$correo</td>");
            echo("<tr><th>Blog</th><td><a href='$blog'>$blog</a></td>");
            echo('</table>');
        ?>
    </body>
</html>
