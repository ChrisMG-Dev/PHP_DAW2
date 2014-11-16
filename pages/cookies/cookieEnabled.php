<?php
/**
 * Página que comprueba si el navegador permite crear cookies y decirselo
 * al usuario
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
        <title>Cookies Enabled</title>
        <script type="text/javascript" src="/pages/cookies/js/cookieenabled.js"></script>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <h1>Disponibilidad de los cookies: <span id="cookie"></span></h1>
    </body>
</html>