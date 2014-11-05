<?php
 /**
 * Fecha y hora del último acceso
 *
 * @author Muñoz Godenir Christopher
 * @version 1.0
 */
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
    <?php include("includes/source.php"); ?>
        <h2>Último acceso al sitio</h2>
        <?php
            echo $_COOKIE['lastAccess'];
        ?>
    </body>
</html>

