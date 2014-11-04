<?php
/**
 * Muestra al usuario un contador indicando las veces que ha entrado en esta
 * página
 * 
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */
    if (!isset ($_COOKIE['counter'])) {
        setcookie("counter", 1);
    }
    
    else {
        setcookie("counter", intval($_COOKIE['counter']) + 1);
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Visitas de la páginas</title>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
            <h2>Usted a entrado <span id="contadorVisita">
            <?php 
                if (!isset ($_COOKIE['counter'])) {
                    echo "1";
                }
                else {
                   echo $_COOKIE['counter'] + 1; 
                }
                
            ?>
            </span> vez/veces en esta página</h2>
            <input type="button" 
                   onclick="document.cookie=
                               'counter=;expires=Wed; 01 Jan 1970';
                       location.href = document.referrer; return false; " 
                       value="Eliminar Cookie"/>
    </body>
</html>
