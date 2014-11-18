<?php
/**
 * Descripcion
 * 
 * @author Muñoz Godenir Christopher
 * @version 1.0
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0 
 */

    if(!isset($_SESSION)) { 
        session_start(); 
    } 

  if (!isset ($_SESSION['usuario']) || ($_SESSION['usuario'][0] != "usuario" || 
          $_SESSION['usuario'][1] != "usuario")) {
      header ("Location: index.php?page=ingreso");
  }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <h2>Enviar mensajes - de <?php echo $_SESSION['usuario'][0] ?></h2>
        <?php ?>
    </body>
</html>