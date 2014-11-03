<?php
/**
* Recoge los datos de una cookie y muestra el usuario
* en pantalla. No permite acceder en esta página si no es
* con el botón enviar del formulario en login.php.
* 
* @author Muñoz Godenir Christopher
* @version 1.2
* @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
*/

if (!isset ($_POST['enviar'])){
    header ("Location: index.php?page=login");
}
//$usuario = "";

if (isset ($_POST['user']) && isset ($_POST['pw'])) {
    $usuario = $_POST['user'];
    //$usuario = $_POST['user'];
    if (isset ($_POST['remember'])) {
        setcookie("usuario", $_POST['user']);
        setcookie("pw", $_POST['pw']);
    }
    
    else {
        setcookie("usuario", "", -1);
        setcookie("pw", "", -1);
    }
}        
    
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>proLogin</title>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <h2>Bienvenido <?php echo $usuario; ?></h2>
        <input type="button" value="Volver" 
               onclick="location.href = document.referrer; return false;" />
    </body>
</html>
