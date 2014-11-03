<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 3. Escribe una función que permita validar contraseñas seguras. 
 * Una contraseña segura debe tener una longitud mínima de 8 caracteres
 *  y contener al menos: Una letra minúscula, una letra mayúscula,
 *  un dígito y un carácter especial. Utilizar la función en un 
 * formulario de registro. 
 */

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Contraseña segura</title>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <form action="?page=fn_safe_pw" method="post">
            <fieldset style="display: inline-block;">
                <label>Contraseña</label>
                <input type="password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))
                       (?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$  " 
                       title="Al menos
                       1 mayúscula,
                       1 minúscula,
                       1 dígito,
                       1 carácter especial. 
                       Longitud mínima: 8" 
                       name="dni" required />
            </fieldset>
            <input type="submit" name="enviar" value="Enviar" />
        </form>
        <br />
    </body>
</html>

