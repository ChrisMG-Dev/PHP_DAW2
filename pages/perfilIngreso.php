<?php
    /**
     * Página del perfil de un usuario, sus opciones de menú son creadas
     * según que tipo de usuario se trata.
     * 
     * @author Muñoz Godenir Christopher
     * @version 1.0
     * @license http://opensource.org/licenses/GPL-3.0 GNU GPL 3.0
     */

    if (!isset($_SESSION)) { 
        session_start (); 
    } 
    
    function getUserData() {
        if (isset ($_POST['user'])) {
            $user = $_POST['user'];
            $pw = $_POST['pw'];   
        }
        
        else if (isset ($_SESSION['usuario'][0])) {
            $user = $_SESSION['usuario'][0];
            $pw = $_SESSION['usuario'][1];
        }
        
        else {
            return (null);
        }
        
        $userData = array();
        $userData[] = $user;
        $userData[] = $pw;
        
        return ($userData);
    }
    
    function createOptionsBasedOnUserData ($userData) {
        if ($userData[0] == "admin" && $userData[1] == "admin") {
           $opciones = array(
                array(
                    "opcion" => "Dar de alta",
                    "url" => "?page=dardealta"
                ),
                array(
                    "opcion" => "Dar de baja",
                    "url" => "?page=dardebaja"
                )
            );
        }

        else if (($userData[0] == "usuario" && $userData[1] == "usuario")){
            $opciones = array(
                array(
                    "opcion" => "Editar mi perfil",
                    "url" => "?page=editarmiperfil"
                ),
                array(
                    "opcion" => "Enviar mensajes",
                    "url" => "?page=enviarmensajes"
                )
            );
        }
        
        else {
            return (null);
        }
        
        return ($opciones);
    }
    
    
    // Si se accede desde otro sitio que la página que la invoca
    if (!isset ($_POST['volver'])) {
        if (!isset ($_POST['enviar'])) {
            header ("Location: index.php?page=ingreso");
            exit;
        }
        
        else {
            $_SESSION['usuario'] = array ();
            $datosUsuario = getUserData();
            
            if ($datosUsuario != NULL) {

                $opciones = createOptionsBasedOnUserData($datosUsuario);
                
                if (is_null($opciones)) {
                    $_SESSION['loginError'] = "Este usuario no existe";
                    header ("Location: index.php?page=ingreso");
                    exit; 
                }
                
                // Recordar datos
                if (isset ($_POST['remember'])) {
                    setcookie("usuario", $datosUsuario[0]);
                    setcookie("pw", $datosUsuario[1]);
                }

                // Eliminar cookies
                else {
                    setcookie ("usuario", "", -1);
                    setcookie ("pw", "", -1);
                }
                
                $_SESSION['usuario'][0] = $datosUsuario[0];
                $_SESSION['usuario'][1] = $datosUsuario[1];

                // Descargar errores si existen
                if (isset ($_SESSION['loginError'])) {
                    unset($_SESSION['loginError']);
                }

            } // Fin comprobación de POST y usuarios
            
            // Cargar mensaje de error si el login es incorrecto
            else{
                $_SESSION['loginError'] = "No hay datos";
                header ("Location: index.php?page=ingreso");
                exit;
            }  
        }
        
        $usuario = getUserData();
    }
    
    else {
        $usuario = getUserData();
        
        // Opciones de usuarios válidos
        $opciones = createOptionsBasedOnUserData($usuario);
    }


?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Perfil</title>
    </head>
    <body>
        <?php include("includes/source.php"); ?>
        <h2>Usted es <?php echo $usuario[0]; ?></h2>
        <div id="opciones">
            <ul>
                <?php
                    if ($opciones != null) {
                        foreach ($opciones as $opcion) {
                            echo "<li><a href='" . $opcion['url'] . "'>"
                                    . $opcion['opcion'] . "</a></li>"; 
                        }
                    }

                ?>
            </ul>
        </div>
        <form action="?page=ingreso" method="post">
            <input type="submit" name="volver" value="Volver" 
                 />    
        </form>
    </body>
</html>
