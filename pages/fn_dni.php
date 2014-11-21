<?php

/* 
 * Programa que calcula la letra DNI en base al número introducido
 * por el usuario en un formulario
 * 
 * @author Christopher Muñoz Godenir
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
 */

    function getDniLetter ($dniNum) {
        
        $dniLetters = array ("T","R","W","A","G","M","Y"
            ,"F","P","D","X","B","N","J","Z","S","Q","V"
            ,"H","L","C", "K","E");
        
        return ($dniLetters[$dniNum % 23]);
    }

    if (isset ($_POST['enviar'])) {
        
        $dniNumber = intval ($_POST['dni']);
        
        if (is_int ($dniNumber) && $dniNumber != 0) {
            echo ("Su letra es de dni es " . getDniLetter ($dniNumber));
        }
        
        else {
            echo ("Error, el valor no cumple con el formato requerido");
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>DNI</title>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <form action="?page=fn_dni" method="post">
            <fieldset style="display: inline-block;">
                <label>Número DNI</label>
                <input type="text" pattern="[0-9]{8}" title="Ocho cifras" 
                       name="dni" required />
            </fieldset>
            <input type="submit" name="enviar" value="Enviar" />
        </form>
        <br />
    </body>
</html>

