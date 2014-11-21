<?php

/* 
 * cargar fecha de nacimiento en una variable y calcular la edad
 * @author Muñoz Godenir Christopher
 */

   $fechaNacimiento = array(11,23,1990);
   $fechaActual = getdate();
   
   $edad = $fechaActual['year'] - $fechaNacimiento[2];
   
   if ($fechaActual['mon'] < $fechaNacimiento[0]) {
       $edad -= 1;
   }
   
   else if ($fechaNacimiento[0] == $fechaActual['mon']) {
       if ($fechaActual['mday'] < $fechaNacimiento[1]) {
           $edad -= 1;
       }
   }
   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Fecha de nacimiento</title>
    </head>
    <body>
        <p>
        <?php 
        if ($edad >= 0) {
            echo("Mi edad es: $edad");
        }
        else {
            echo('Fecha introducida inválida.');
        }
            ?>
        </p>
     <?php include("includes/independent_source.php"); ?>
     </body>
</html>


