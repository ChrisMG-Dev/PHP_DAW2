<?php
/**
 * Descripción
 *
 * @author Christopher Muñoz Godenir
 * @version 1.0
 * @license GNU GPL http://www.gnu.org/copyleft/gpl.html
 */

    $validado = true;

    $nombre = "";
    $telefono = "";
    $correo = "";
    $password = "";
    
    $nombreErr = "";
    $telefonoErr = "";
    $correoErr = "";
    $passwordErr = "";
    

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($_POST['nombre'])) {
            $nombreErr = "Introduzca su nombre";
            $validado = false;
        } else {
            $nombre = test_input($_POST['nombre']);   
            if (!preg_match("/^[a-zA-Z ]*$/", $nombre)) {
                $nombreErr = "Introduzca un nombre válido";
                $validado = false;
            }
        }
        
        if (empty($_POST['telefono'])) {
            $telefonoErr = "Introduzca su teléfono";
            $validado = false;
        } else {
            $telefono = test_input($_POST['telefono']);
            if (!preg_match("/^[9|6|7][0-9]{8}$/", $telefono)) {
                $telefonoErr = "Introduzca un número de teléfono válido";
                $validado = false;
            }
        }
        
        if (empty($_POST['correo'])) {
            $correoErr = "Introduzca su correo eletrónico";
            $validado = false;
        } else {
            $correo = test_input($_POST['correo']);   
            if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $correoErr = "Introduzca un correo electrónico válido";
                $validado = false;
            }
        }
        
        if (empty($_POST['password'])) {
            $passwordErr = "Introduzca una contraseña";
            $validado = false;
        } else {
            $password = test_input($_POST['password']);  
            if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/",
                    $password)) {
                $passwordErr = "Introduzca una contraseña que contenga al menos"
                        . " una mayúscula, minúscula y número";
                $validado = false;
            }
        }
        
        if ($validado) {
            header("Location: " . $_SERVER['PHP_SELF'] . '?page=demo/perfil');
            exit();
        }
    }
    
    function test_input($dato) {
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Formulario usuario</title>
        <style>
            label {
                display: inline-block;
                width: 100px;
                text-align: right;
                margin: 5px 15px 5px 5px;
            }
            
            input:invalid {
                border: 1px solid red;
                box-shadow: 0px 0px 6px red;
            }
            
            input:not([type=submit]):valid{
                border: 1px solid green;
                box-shadow: 0px 0px 6px green;
            }
            
            .error {
                color: red;
            }
            
            fieldset {
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <?php include("includes/independent_source.php"); ?>
        <form method="post" action="
            <?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>
              ">
            <fieldset>
                <p class="block">
                    <label>Nombre: </label>
                    <input type="text" name="nombre" 
                           title="Introduzca su nombre"
                           pattern="[a-zA-Z]{2,}"
                           value="<?php echo $nombre; ?>"
                           required 
                           />
                    <span class="error"><?php echo $nombreErr; ?></span>
                </p>
                <p class="block">
                    <label>Teléfono: </label>
                    <input type="text" name="telefono" 
                           title="Introduzca su número de teléfono
                           (+34)637393190"
                           pattern="^([\+][0-9]{2}[\s]?)?[0-9]{9,}$"
                           value="<?php echo $telefono; ?>"
                           required
                           />
                    <span class="error"><?php echo $telefonoErr; ?></span>
                </p>
                <p class="block">
                    <label>Correo: </label>
                    <input type="email" name="correo" 
                           title="Introduzca su email"
                           value="<?php echo $correo; ?>"
                           required
                           />
                    <span class="error"><?php echo $correoErr; ?></span>
                </p>
                <p class="block">
                    <label>Contraseña: </label>
                    <input type="password" name="password" 
                           title="Introduzca una contraseña"
                           pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$"
                           required
                           />
                    <span class="error"><?php echo $passwordErr; ?></span>
                </p>
            </fieldset>
            <br />
            <input type="submit" name="enviar" value="Enviar"/>
        </form>
    </body>
</html>

