<?php
/**
 * Descripcion
 * 
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
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
        <h2>Historial de navegación</h2>
        <a href="?page=logout">Logout</a>
        <ul>
            <?php
            if (isset ($_SESSION['historial'])) {
                foreach ($_SESSION['historial'] as $url) {
                    echo "<li>" . $url . "</li>";
                }
            }
            
            ?>
        </ul>
    </body>
</html>