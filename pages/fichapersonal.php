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
        </style>
    </head>
    <body
        <div id="cabecera" style="float: left; display: inline; ">
            <img style="padding-top: 15px; padding-right: 15px;" height="128px"
                 width="128px" src="img/IMG-20130323-WA0005.jpg"/>
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
            
            echo('<table style="float: right";>');
            echo("<th>Nombre</th><td>$nombre</td>");
            echo("<tr><th>Apellidos</th><td>$apellidos</td>");
            echo("<tr><th>Fecha de nacimiento</th><td>$fecha_nac</td>");
            echo("<tr><th>Correo electrónico</th><td>$correo</td>");
            echo("<tr><th>Blog</th><td><a href='$blog'>$blog</a></td>");
            echo('</table>');
        ?>
        <br /><br />
        <?php include("includes/independent_source.php"); ?>
    </body>
</html>
