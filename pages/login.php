<?php
    /**
     * Formulario que pide usuario y contraseña para
     * almacenarlos en una cookie posteriormente y ser capaz
     * de recuperar los datos de dicho cookie si es existente
     * 
     * @author Muñoz Godenir Christopher
     * @version 1.1
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
     */
    $usuario = "";
    $pw = "";
    
    if (isset ($_COOKIE["usuario"]) && isset ($_COOKIE["pw"])) {
        $usuario = $_COOKIE['usuario'];
        $pw = $_COOKIE['pw'];
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <title>formCookie</title>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <form action="?page=proLogin" method="post">
            <fieldset>
                <p>
                    <label>Usuario</label>
                    <input type="text" name="user" value=
                           "<?php echo($usuario) ?>" required />
                </p>
                <p>
                    <label>Contraseña</label>
                    <input type="text" name="pw"  value=
                           "<?php echo($pw) ?>" required />
                </p>
                <p>
                    <label>Recordar datos</label>
                    <input type="checkbox" name="remember" checked />
                </p>
                <p>        
                    <input type="submit" name="enviar" />
                </p>
            </fieldset>
        </form>
    </body>
</html>
