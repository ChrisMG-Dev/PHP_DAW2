<?php
    /**
     * Formulario que pide usuario y contraseña para abrir su perfil de
     * usuario
     * 
     * @author Muñoz Godenir Christopher
     * @version 1.0
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
     */
    
    if (!isset($_SESSION)) { 
        session_start(); 
    } 

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
        <style>
            #errorMsg {color: red;}
            label {width: 140px; display:inline-block;}
        </style>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <form action="?page=perfilIngreso" method="post">
            <fieldset style="display: inline-block;">
                <p>
                    <label>Usuario</label>
                    <input type="text" name="user" value=
                           "<?php echo($usuario) ?>" required />
                </p>
                <p>
                    <label>Contraseña</label>
                    <input type="password" name="pw"  value=
                           "<?php echo($pw) ?>" required />
                </p>
                <p>
                    <label>Recordar datos</label>
                    <input type="checkbox" name="remember" />
                </p>
                <p>        
                    <input type="submit" name="enviar" />
                </p>
                <span id="errorMsg"> 
                    <?php
                        if (isset ($_SESSION['loginError'])) {
                            echo $_SESSION['loginError'];
                        }
                    ?>
                </span>
            </fieldset>
        </form>
    </body>
</html>
